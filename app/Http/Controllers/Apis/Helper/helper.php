<?php

namespace App\Http\Controllers\Apis\Helper;
 use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Apis\Controllers\index;
use App\Models\admins;
use App\Models\app_settings;
use App\Models\notifications;
use App\Models\notify_users as notify;
use App\Models\sessions;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Hash;
use Validator;
use DB;

class helper extends generalHelp
{
	public static function validateAccount(){
		if(self::$account == null ){
			if(request()->has('phone')){
				$code=415;
 			}elseif(request()->has('email')){
				$code=416;
			}elseif(request()->has('tmpToken')){
				$code=417;
			}elseif(request()->has('apiToken')){
				$code=403;
			}else{
				return 404;
			}
		}else{
			if(self::$account->deleted_at!= null){
				$code= 418;
			}elseif(self::$account->is_active == 0){
				$code=402;
			}elseif(self::$account->is_verified == 0){
				$code=419;
		   }else{
			   return null;
		   }
		}
		return [
			'status'=>$code,
			'message'=>self::$messages['validateAccount']["{$code}"]
		];
	}

	public static function newNotify($targets,$message_ar,$message_en,$orderId=null,$type=null,$productId=null,$categoryId=null,$notificationId=null){
		if(!$notificationId){
			$notification   =   notifications::createUpdate([
									'content_ar'=>$message_ar,
									'content_en'=>$message_en,
									'type'    =>$type,
									'orders_id'    =>$orderId,
									'products_id'    =>$productId,
									'categories_id'    =>$categoryId
									]);
		}
		foreach($targets as $user){
			$notify =   notify::createUpdate([
							'notifications_id'=>$notificationId??$notification->id,
							$user->getTable()."_id" =>$user->users_id??$user->id,
							'orders_id' =>$orderId,
							'is_seen'         =>0,
							'type'            =>$type
						]);
			self::sendFCM( $notify ,'user');
		}
		return $notificationId??$notification->id;
	}

	public static function sendSms($phone,$code)
    {

		$url = 'https://www.experttexting.com/ExptRestApi/sms/json/Message/Send?username=abubakar177&api_key=anczut3t3eczpgj&api_secret=uaopvznumfovs86&from=DEFAULT&to='.Str::replaceFirst('00','', $phone).'&text='.$code.'&type=unicode&encode=utf8';
		// $url = 'https://www.experttexting.com/ExptRestApi/sms/json/Message/Send?username=abubakar177&api_key=anczut3t3eczpgj&api_secret=uaopvznumfovs86&from=DEFAULT&to=201114228487&text=hi mostafa&type=text&encode=utf8';
		// file_get_contents($url);
		$response =self::get_web_page($url)['content'] ;
	}
	public static function get_web_page( $url, $cookiesIn = '' )
	{
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => true,     //return headers in addition to content
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_SSL_VERIFYPEER => true,     // Validate SSL Cert
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_COOKIE         => $cookiesIn
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $rough_content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header_content = substr($rough_content, 0, $header['header_size']);
        $body_content = trim(str_replace($header_content, '', $rough_content));
        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($pattern, $header_content, $matches);
        $cookiesOut = implode("; ", $matches['cookie']);

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['headers']  = $header_content;
        $header['content'] = $body_content;
		$header['cookies'] = $cookiesOut;
		return $header;		
	}
	public static function translateStatus($status)
    {

        $array = [
			"ar"=>[
				"waiting"=>" انتظار",
				"accepted"=>"موافقة",
				"onProgress"=>"قيد التنفيذ ",
				"delivered"=>"تم التسليم",
				"rejected"=>"مرفوض ",

			],
			"en"=>[
				"waiting"=>"waiting",
				"accepted"=>"accepted",
				"onProgress"=>"onProgress",
				"delivered"=>"delivered",
				"rejected"=>"rejected",
			]
		];
		return $array[self::$lang][$status];

	}
	
    public static function get($records)
    {
        $totalPages=ceil($records->count()/self::$itemPerPage);
        $records = $records->forPage(request()->page+1,self::$itemPerPage)->get();
        $status = $records->count()?200:204;
        return [$records,$totalPages,$status ];
    }

}
