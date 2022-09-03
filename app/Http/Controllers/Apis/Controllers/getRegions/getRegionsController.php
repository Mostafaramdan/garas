<?php
namespace App\Http\Controllers\Apis\Controllers\getRegions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Http\Controllers\Apis\Resources\objects;
use  App\Http\Controllers\Apis\Controllers\index;
use App\Models\countries;

class getRegionsController extends index
{
    public static function api()
    {
        $records=  countries::where('is_active',1)->orderBy('id','DESC');
        $search = request()->search;
        if($search){
            $records->whereHas('regions',function($query) use ($search){
                $query->where('name_'.self::$lang,'like','%'.$search.'%');
            });
        }
        $records = $records->get();
        return [
            "status"=>$records->forPage(request()->page+1,self::$itemPerPage)->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "countries"=>objects::ArrayOfObjects($records->forPage(request()->page+1,self::$itemPerPage),"country"),
        ];
    }
}
