<?php

namespace App\Http\Controllers\Apis\Controllers;

use App\Http\Controllers\Apis\Helper\helper ;
use App\Models\teachers;
use App\Models\students;
use App\Models\GeneralModel;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 *
 *
 * APIs for register
 */

class index extends Controller
{
    public static   $account,$request,$secondAccount,$isSendMessage=false,$itemPerPage=20,
                    $className,$classRules,$lang,$providers=[students::class,teachers::class],$messages,$messagesAll;

    function __construct(Request $request){

        if($request->has('phone'))
            $request->offsetSet('phone',Str::replaceFirst('+', '00',$request->phone ));

        self::setAccount($request);
        self::setClassName();
        self::setClassRules();
        self::setLang();
        $messages=include "lang.php";
        self::$messages=$messages[self::$lang];
        request()->request->add(['messages'=>$messages[self::$lang]]);
        self::$messagesAll=$messages;
    }

    public static function index()
    {
        $rules = self::$classRules::rules(request());
        if($rules)
            abort(response( $rules,400));
        $api = self::$className::api();
            return response()->json($api );
    }

    public static function setAccount($request){

        if(request()->header('apiToken')){
            request()->request->add(['apiToken'=>request()->header('apiToken')]);
        }
        if($request->has('apiToken') ){
            self::$account=helper::getAccount($request->apiToken,null,null);
        }
        elseif($request->has('phone')){
            self::$account=helper::getAccount(null,null,$request->phone);
        }
        elseif($request->has('email')){
            self::$account=helper::getAccount(null,$request->email,null);
        }
        elseif($request->has('tmpToken')){
            self::$account=helper::getAccount(null,null,null,$request->tmpToken);
        }
    }

  
    public static function setClassName(){
        $requestName=request()->segment(2);
        self::$className= 'App\Http\Controllers\Apis\Controllers\\'.$requestName.'\\'.$requestName.'Controller';
    }

    public static function setClassRules(){
        $requestName=request()->segment(2);
        self::$classRules= 'App\Http\Controllers\Apis\Controllers\\'.$requestName.'\\'.$requestName.'Rules';
    }


    public static function setLang(){

        if(request()->has('lang') && in_array(request()->lang,['ar','en'])){
            self::$lang=request()->lang;
            request()->request->add(['lang'=>request()->lang]);
        }elseif(self::$account && self::$account->lang ){
            self::$lang=self::$account->lang;
            request()->request->add(['lang'=>self::$account->lang]);

        }else{
              self::$lang='ar';
              request()->request->add(['lang'=>'ar']);

        }
    }
}
