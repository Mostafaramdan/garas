<?php

namespace App\Http\Controllers\Apis\Controllers\notifications;

use  App\Http\Resources\Api\notificationResource;
use App\Http\Controllers\Apis\Controllers\index;
use App\Models\notify;
use  App\Http\Requests\Api\notificationsRequest as Request;

class notificationsController extends index
{
    public static function api(Request $request){

        $query=  notify::orderBy('id','DESC')
                        ->when($request->has('type'),function($q) use ($request){
                            return $q->whereHas('notification',function($q) use ($request){
                                $type=[];
                                if($request->type == 'management')
                                    $type=['schoolToClass','schoolToTeacher','adminToteachers','adminToAll'];
                                else 
                                    $type= ['teacherToClass'];
                                    
                                return $q->whereIn('type',$type);
                            });
                        })
                        ->where(request()->account->getTable().'_id',request()->account->id)
                        ;
    
        $records= $query->forPage(request()->page+1,self::$itemPerPage)->get();
        foreach($records as $record)
           notify::updateOrCreate(['id'=>$record->id],[
                'is_seen'=>1
            ]);
        return [
            "status"=>$records->count()?200:204,
            "totalPages"=>ceil($query->count()/self::$itemPerPage),
            "notifications"=>notificationResource::collection($records),
        ];


    }
}

