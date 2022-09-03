<?php
namespace App\Http\Controllers\Apis\Controllers\search;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class searchRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"              =>"required|exists:tokens,apiToken",
            'type'       =>'required|in:housing_unit,apartment',
            'price'                 =>'array',
            'price.start'           =>'required_with:price',
            'price.end'             =>'required_with:price',
            'rooms'                 =>'array',
            'rooms.*.adultNums'     =>'required_with:rooms',
            // 'rooms.*.childrenNums'  =>'required_with:rooms',
            'attachmentIds'         =>'array',
            'attachmentIds.*'       =>'int|exists:attachments,id',
            'arrivalDate'           =>'required_with:departureDate',
            'departureDate'           =>'required_with:arrivalDate',
            'sortBy'                    =>'in:price,rate',
            'sortType'                    =>'in:ASC,DESC',
            "page"      =>"required|numeric"
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "price.array"               =>400,
            "price.start.required_with" =>400,
            "price.end.required_with"   =>400,

            "rooms.*.adultNums.required_with" =>400,
            "rooms.*.childrenNums.required_with" =>400,

            "arrivalDate.required_with"   =>400,
            "DepartureDate.required_with"   =>400,

            "sortBy.in"         =>405,
            "sortType.in"         =>405,

            "page.required"         =>400,
            "page.numeric"          =>405
        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "userId.exists"         =>"هذا الشخص غير موجود",
            "userId.required"       =>"يجب ادخال رقم الشخص",

            "page.required"         =>"يجب ادخال رقم الصفحة",
            "page.numeric"          =>"يجب ادخال رقم الصفحة بشكل صحيح",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=request()->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(request()->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
