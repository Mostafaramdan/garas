<?php

namespace App\Http\Controllers\Apis\Helper;

use  App\Http\Controllers\Apis\Controllers\index;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Hash;
use Validator;
use App\Models\tokens;

class generalHelp extends index
{
	public static $itemPerPAge=10;

	public static function base64_image($image_string,$folderName)
	{
		if(!$image_string)return null;
			// CHECK IF FOLDER EXIST
			$folderPath="uploads/{$folderName}/";
		if (!file_exists( $folderPath))
					mkdir( $folderPath, 0777, true);
			// START MAKE IMAGE
		$extension = ( explode('/', explode(':', substr($image_string, 0, strpos($image_string, ';')))[1])[1]);
		$extension =Str::contains($extension,'+')? explode('+',$extension)[0] : $extension ;
		$path =Str::random(16).'.'.$extension ;
		$file = fopen( $folderPath.$path, "wb") ;

		fwrite($file, base64_decode(explode(',',$image_string)[1]));
		fclose($file);
		return "/".$folderPath.$path;
	}
	public static function uploadPhoto($image,$folderName)
    {
		$folderPath="uploads/{$folderName}//";
		if (!file_exists( $folderPath))
					mkdir( $folderPath, 0777, true);
			$img_name = Str::random(30) .now()->timestamp.'.' . $image->getClientOriginalExtension();//generate new name
			$image->move( public_path('uploads/'.$folderName) , $img_name);//move function accept 2para('destnation','filename')
			return '/'.$folderPath.$img_name;
	}

	public static function chkifSendTwominute($session)
    {
		$now= (Carbon::parse('now')->subMinutes(2))->format('Y-m-d H:i:s');
		return	($session->created_at <= $now)?true:false;
	}

	public static function getAccount($api_token=null,$email=null,$phone=null,$tmpToken=null,$tmp_phone=null,$tmp_email=null)
    {
		$models=self::$providers;
		if($api_token){
			$key   = 'apiToken';
			$value = $api_token;
			$token = tokens::where('apiToken',request()->apiToken)->first();
			if($token)
				foreach($models as $model){
					$account= $token->{Str::singular((new $model)->table)};
					if($account){
						request()->request->add(['account'=>$account]);
						return $account;
					}
				}
			else
				return null;

		}
		elseif($email){
			$key   = 'email';
			$value = $email;
		}elseif($phone){
			$key   = 'phone';
			$value = $phone;
		}elseif($tmpToken){
			$session=sessions::where('tmp_token',$tmpToken)->first();
			if($session==null)return null;
			foreach($models as $model)
				if($session->$model!=null)
					return $session->$model;
		}elseif($tmp_phone != null){
			$session=sessions::where('tmp_phone',$tmp_phone)->first();
			if($session==null)return null;
			foreach($models as $model)
				if($session->$model!=null)
					return $session->$model;
		}elseif($tmp_email != null){
			$session=sessions::where('tmp_email',$tmp_email)->first();
			if($session==null)return null;
			foreach($models as $model)
				if($session->$model!=null)
					return $session->$model;
		}else{
			return null;
		}
		for($i=0;$i<count($models);$i++){
			$tableName=$models[$i];
			$record=$tableName::where($key,$value)->first();
			if($record != null) break;
		}
		return $record;
	}

	public static function RandomXDigits ($Digits=6)
    {
        return rand(pow(10, $Digits-1), pow(10, $Digits)-1);
	}

	public static function UniqueRandomXDigits ($Digits=6,$column,$models=[])
    {
        $code= rand(pow(10, $Digits-1), pow(10, $Digits)-1);
		!$models ? $models=self::$providers: null;
        for($i=0;$i<count($models);$i++){
            $model='\App\Models\\'.$models[$i];
            if($model::where($column,$code)->count() != 0){
                $code= rand(pow(10, $Digits-1), pow(10, $Digits)-1);
                $i=0;
            }
        }
        return $code;
	}

	public static function UniqueRandomXChar ($Chars=69,$column,$models=[])
    {
		$code= Str::random($Chars);
		$models=$models??self::$providers;
		for($i=0;$i<count($models);$i++){
			$model=$models[$i];
			if($model::where($column,$code)->count() != 0){
				$code= Str::random($Chars);
				$i=0;
			}
		}
		return $code;
	}

	public static function HashPassword ($Password)
    {
			return Hash::make($Password);
	}

	public static function login($record,$password)
    {
		$check=	Hash::check($password,$record->password)  ;
		if($check){
            $token = self::UniqueRandomXChar(69,'apiToken');
            tokens::create([
                'apiToken'=>$token,
                $record->getTable().'_id'=>$record->id,
                'created_at'=>date('Y-m-d H:i:s')
            ]);
            return $token;
		}
		return $check;
	}

    public static function loginBySocialToken ($record)
	{
		$record->apiToken=self::UniqueRandomXChar(69,'apiToken');
		$record->save();
		return true;
	}

	public static function changePassword()
	{
		$account=index::$account;
		$account->password= self::HashPassword(index::$request->newPassword);
		$account->save();
	}

	public static function updatePassword()
	{
		if (Hash::check(request()->oldPassword ,self::$account->password ) == false) {
			return false;
		}else{
			index::$account->password= self::HashPassword(index::$request->newPassword);
			self::$account->save();
			return true;
		}
	}

	public static function setAccountByession()
	{
		$key=request()->has('phone')?'tmp_phone':'tmp_email';
		$value=request()->has('phone')?request()->phone:request()->email;
		$seeions = $session=sessions::where($key,request()->phone)->first();

		if(!$seeions) return null;
		foreach(self::$providers as $provider){
			$account=$seeions->$provider;
			if($account){
				index::$account=$account;
				index::$lang=$account->lang??'ar';
				return true;
			}
		}
	}

	public static function validator ($Request, $Rules, $Messages,$messagesLang){
		$validator = Validator::make($Request, $Rules, $Messages);

		$code=null;
		if ($validator->fails()) {
			$code = $validator->errors()->first();
		}

		$validator = Validator::make($Request, $Rules, $messagesLang);
		if ($validator->fails()) {
			$message = $validator->errors()->first();
		}
		if($code!=null)
			return ['status'=>(int)$code,'message'=>$message];
	}

	public static function validateDash ($Request, $Rules, $Messages){
		$validator = Validator::make($Request, $Rules, $Messages);
		if ($validator->fails()) {
			$code = $validator->errors();
		}

		$validator = Validator::make($Request, $Rules, $messagesLang);
		if ($validator->fails()) {
			$message = $validator->errors()->first();
		}
		if($code!=null)
			return ['status'=>(int)$code,'message'=>$message];
	}

	public static function showAllErrors ($Request, $Rules, $Messages,$messagesLang){
		$validator = Validator::make($Request, $Rules, $Messages);
		$code=null;
		if ($validator->fails()) {
			$code = $validator->errors();
		}

		$validator = Validator::make($Request, $Rules, $messagesLang);
		if ($validator->fails()) {
			$message = $validator->errors();
		}
		if($code!=null)
			return ['status'=>$code,'message'=>$message];
	}

	public static function distance($lat1, $lon1, $lat2, $lon2) {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		//$unit = strtoupper($unit);

		return ($miles * 1.609344);

	}

	public static function isExpiredSession($session,$minutes){
		$now= (Carbon::parse('now')->subMinutes($minutes));
		return $session->created_at < $now ?true : false ;
	}

	public static function sendFCM($pushNotify,$target) {
		$url = 'https://fcm.googleapis.com/fcm/send';
		$offers_id=null;
		$products_id=null;
		if( $pushNotify->notifications->products_id){
			if( $pushNotify->notifications->product->in_offer_now){
				$offers_id = $pushNotify->notifications->products_id;
			}else{
				$products_id= $pushNotify->notifications->products_id;
			}
		}
		$fields = [
			"to" => $pushNotify->$target->fireBaseToken,
			"notification" => [
				"title" =>"Igreen",
				"body" => $pushNotify->notifications['content_'.$pushNotify->$target->lang],
				"icon" => "myicon",
				"sound" => "notify.mp3"
			],
			"data"=>[
				"productId" =>  $products_id,
				"offerId" => $offers_id,
				"categoryId" =>  $pushNotify->notifications->categories_id,
				"orderId" =>  $pushNotify->notifications->orders_id,
				"type" => $pushNotify->notifications->type,
			],
		];
		$fields = json_encode ( $fields );
		$key = 'AAAALLByHOc:APA91bGsTfep_Wsdt4VAFXeO38EF1RJuyGYoGJadlwycy1WG6V8EmMgLxIMNInZTHlCq8bbdsjsdHhKBBm2FXmzO8LTYkG05g9a47B6o9oAy4EIWnHYwOyWLYrAg2z_S5h1QTcUlWirU';
		$headers = [
			'Authorization: key='.$key,
			'Content-Type: application/json'
		];
		$ch = curl_init();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		// if( $pushNotify->$target->fireBaseToken== "dHpoIRKR1sQ:APA91bEIFKSSsNmjyBnUijZc5FughaJBTxyFIPbZJnX5Uf0VIpLLg_J8AS4Q7pugN0FCk8OlNArY4bHqlUG0M9w0viFdsAfva7-t3VVsOS2T9Epew9LcI3jujC7Is4tibdil2pa_VP4z" ){

			// dd($result);
		// }
	}

	public static function deleteFile($path){
		File::delete($_SERVER['DOCUMENT_ROOT'].$path); // Value is not URL but directory file path
	}
}
