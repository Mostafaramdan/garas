<?php

namespace App\Http\Controllers\Apis\Controllers\getRegions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Helper\helper ;

class getRegionsRules extends index
{
    public static function rules()
    {
        $rules=[
            // "page"      =>"required|numeric"
        ];

        $messages=[
            "page.required"         =>400,
            "page.numeric"          =>405
        ];

        $messagesAr=[
            "page.required"         =>"يجب ادخال رقم الصفحة",
            "page.numeric"          =>"يجب ادخال رقم الصفحة بشكل صحيح",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=request()->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(request()->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

    }
}
