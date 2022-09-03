<?php
	use Illuminate\Support\Facades\Auth;
	use App\Models\schools;
	use Illuminate\Support\Str;
	require_once('Authentication.php');

	function AuthLogged()
	{
		return Authentication::getAuth();

	}

	function SetAuth($auth){

		return Authentication::setAuth($auth);

	}


	function UniqueRandomXDigits ($Digits,$column=null,$tables=[])
	{
		$Digits=$Digits??5;
		$code= rand(pow(10, $Digits-1), pow(10, $Digits)-1);
		for($i=0;$i<count($tables??[]);$i++){ 
			$model='\App\Models\\'.$tables[$i];
			if($model::where($column,$code)->count() != 0){
				$code= rand(pow(10, $Digits-1), pow(10, $Digits)-1);
				$i=0;
			}
		}	
		return $code;
	}
	
	function permissionInfo($module)
	{
		$myPermissions=[];
		if (str_contains($module['permissions'],'r')){
			$myPermissions[]=['bg'=>'secondary','input'=>$module['name'].'-read','display'=>__('read')];
		}                                                                           
		if (str_contains($module['permissions'],'c')){
			$myPermissions[]=['bg'=>'primary','input'=>$module['name'].'-create','display'=>__('create')];
		}                                                                           
		if (str_contains($module['permissions'],'u')){
			$myPermissions[]=['bg'=>'success','input'=>$module['name'].'-update','display'=>__('update')];
		}                                                                           
		if (str_contains($module['permissions'],'d')){
			$myPermissions[]=['bg'=>'danger','input'=>$module['name'].'-delete','display'=>__('delete')];
		}                     
		return $myPermissions;
	}
	
	function createImage($img,$folderPath)
    {
		if(!$img)return null;
		$folderPath="uploads/{$folderPath}/";
		if (!file_exists( $folderPath)) 
					mkdir( $folderPath, 0777, true);
					
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.'.$image_type;
        file_put_contents($file, $image_base64);
		return $file;
    }

	function uploadPhoto($image,$folderName)
	{
		if(!$image) return ;
		$folderPath="uploads/{$folderName}/";
		if (!file_exists( $folderPath)) 
					mkdir( $folderPath, 0777, true);
		//   $img_name = str::random(30) .now()->timestamp.'.' . $image->getClientOriginalExtension();//generate new name
			$img_name = str::random(30) .now()->timestamp.'.' . $image->getClientOriginalExtension();//generate new name
			$image->move( public_path('uploads/'.$folderName) , $img_name);//move function accept 2para('destnation','filename')
			return '/uploads/'.$folderName.'/'.$img_name;  
					
	}  