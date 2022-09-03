<?php
namespace App\Http\Controllers\Apis\Controllers\search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\housing_units;
use App\Models\estates;
use App\Models\orders;
use App\Models\carts;
use Illuminate\Support\Arr;

class searchController extends index
{
    public static  $records;
    public static function api()
    {
        $type = 'App\Models\\'.request()->type.'s';
        self::$records=  $type::where('is_active',1);

        request()->search?  self::search() :null;//search
        request()->price?  self::filterByPrice() :null;// filter by price
        request()->rate?  self::filterByRate() :null;// filter by rate
        request()->cityId?  self::filterByCity() :null;// filter by city
        request()->rooms?  self::filterByRooms() :null;// filter by rooms info
        request()->attachmentIds?  self::filterByAttachments() :null;// filter by Attachment
        request()->isVisa?  self::filterByIsVisa() :null;// filter by payment = visa
        request()->isOffer?  self::filterByIsOffer() :null;// filter by only on offer now
        request()->departureDate?  self::filterByIsAvailable() :null;// filter by only is available
        self::sort() ;// sort by and sort type
        // if(request()->type== 'apartment'){
        //     self::$records= self::$records->groupBy('apartments_complexes_id');
        // }else{
        //     self::$records= self::$records->groupBy('estates_id');
        // }
        $response = self::get();

        return [
            "status"=>$response[1],
            "totalPages"=>$response[0],
            "countItems"=>$response[2],
            request()->type.'s'=>objects::ArrayOfObjects(self::$records,request()->type),
        ];
    }

    public static function search()
    {
        $search = request()->search;
        if(request()->type == 'housing_unit')
            return self::$records->whereHas('estate', function ($query) use ($search) {
                $query->where('name_ar',        'like', '%'.$search.'%')
                    ->orWhere('name_en',       'like', '%'.$search.'%')
                    ->orWhere('description_ar','like', '%'.$search.'%')
                    ->orWhere('description_en','like', '%'.$search.'%');
            });

        else
        return self::$records->whereHas('apartments_complex', function ($query) use ($search) {
            $query->where('name_ar',        'like', '%'.$search.'%')
                ->orWhere('name_en',       'like', '%'.$search.'%')
                ->orWhere('description_ar','like', '%'.$search.'%')
                ->orWhere('description_en','like', '%'.$search.'%');
        });
    }
    public static function filterByAttachments()
    {
        $attachmentIds = array_map('intval', request()->attachmentIds);
        if(request()->type == 'housing_unit')
            return self::$records->whereHas('estate', function ($query) use ($attachmentIds) {
                $query->whereJsonContains('attachments',$attachmentIds );
            });
        else
        return self::$records->whereHas('apartments_complex', function ($query) use ($attachmentIds) {
            $query->whereJsonContains('attachments',$attachmentIds );
        });
    }
    public static function filterByIsVisa()
    {
        if(request()->type == 'housing_unit')
            return self::$records->whereHas('estate', function ($query)  {
                $query->where('payment','visa' );
            });
        else
        return self::$records->whereHas('apartments_complex', function ($query)  {
            $query->where('payment','visa' );
        });

    }
    public static function filterByIsOffer()
    {
        return self::$records->whereHas('offers', function ($query)  {
            $query->where('start_at','<=',date('Y-m-d H:i:s') )
                  ->where('end_at','>', date('Y-m-d H:i:s') )
                  ->where('is_active',1);
        });
    }
    public static function filterByIsAvailable()
    {
        if(request()->type == 'housing_unit')
            $column= 'housing_units_id';
        else
            $column= 'apartments_id';
        
        request()->offsetSet('arrivalDate',date('Y-m-d H:i:s',request()->arrivalDate/1000) );
        request()->offsetSet('departureDate',date('Y-m-d H:i:s',request()->departureDate/1000) );
        $ordersIds = orders::with('carts')->where(function($q){    
            return $q->where(function($q){
                        return $q->where(function($q){
                                return $q->whereBetween('start_at',[request()->arrivalDate,request()->departureDate])
                                        ->orWhereBetween('end_at',[request()->arrivalDate,request()->departureDate])
                                        ;
                            })
                            ->orWhere(function($q){
                                return $q->where('start_at','<=',request()->arrivalDate)
                                        ->where('end_at','>=',request()->departureDate);
                            });
                        })
                        ->whereNotIn('status',['cancelled','refused'])
                        ;
                })
                ->pluck('id')
                ->toArray();
        $records_ids = carts::whereIn('orders_id',$ordersIds)->pluck($column)->toArray();
        return self::$records->whereNotIn('id',$records_ids );
        // return self::$records->where(function($q) use($ordersIds){
        //     return $q->whereHas('carts', function ($q) use($ordersIds){                
        //         return $q->whereHas('order',function($q) use($ordersIds){
        //             return $q->whereNotIn('orders_id',$ordersIds);
        //             return $q->where(function($q){
        //                 return $q->whereNotBetween('start_at',[request()->arrivalDate,request()->departureDate])
        //                          ->whereNotBetween('end_at',[request()->arrivalDate,request()->departureDate] );
                        
        //             })
        //             ->orWhere(function($q){
        //                 return $q->where(function($q){
        //                     return $q->whereBetween('start_at',[request()->arrivalDate,request()->departureDate])
        //                             ->orWhereBetween('end_at',[request()->arrivalDate,request()->departureDate]);
        //                 })
        //                 ->whereIn('status',['cancelled','refused'])
        //                 ;
        //             })
        //             ;
        //         });
        //     })
        //     ->orWhereDoesntHave('carts')
        //     ;
        // });

        
    }
    public static function filterByRate()
    {
        if(request()->type == 'housing_unit')
            return self::$records->whereHas('estate', function($query) {
                $query->where('total_rate','<=', request()->rate);
            });
        else
            return self::$records->whereHas('apartments_complex', function($query) {
                $query->where('total_rate','<=', request()->rate);
            });

    }
    public static function filterByCity()
    {
        if(request()->type == 'housing_unit')
            return self::$records->whereHas('estate', function ($query)  {
                $query->Where('regions_id',request()->cityId);
            });
        else
            return self::$records->whereHas('apartments_complex', function ($query)  {
                $query->Where('regions_id',request()->cityId);
            });
    }

    public static function filterByRooms()
    {
        $rooms = request()->rooms;
        if(request()->type == 'housing_unit'){
            $adult_nums= Arr::pluck($rooms,'adultNums');
            $children_nums= Arr::pluck($rooms,'childrenNums');
            // dd($adult_nums,$children_nums);
            return    self::$records->where('adult_nums','>=',$adult_nums)
                            // ->whereIn('children_nums',$children_nums)
                            ;
        }else{
            return  self::$records->where('rooms',request()->rooms);
        }
    }
    public static function filterByPrice()
    {
        $start= request()->price['start'];
        $end= request()->price['end'];
        return self::$records->whereBetween('final_price',[$start,$end]);
    }
    public static function sort()
    {
        if(request()->sortBy=='rate')
            if(request()->type == 'housing_unit')
                return self::$records->withCount(['estate as average_rating' => function($query) {
                    $query->select('total_rate');
                }])
                ->orderBy('average_rating', request()->sortType??"DESC");
            else
                return self::$records->withCount(['apartments_complex as average_rating' => function($query) {
                    $query->select('total_rate');
                }])
                ->orderBy('average_rating', request()->sortType??"DESC");

        elseif(request()->sortBy=='price'){
            return self::$records =self::$records->orderBy('final_price', request()->sortType??"DESC");
        }else
            return self::$records->orderBy('id', 'DESC');

    }

    public static function get()
    {
        $totalPages=ceil(self::$records->count()/self::$itemPerPage);
        $countRecords=self::$records->count();
        self::$records = self::$records->forPage(request()->page+1,self::$itemPerPage)->get();
        $status = self::$records->count()?200:204;
        return [$totalPages,$status ,$countRecords];
    }
}
