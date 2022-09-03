<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class examTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'subject'=>new subjectResource($this->subject),
            'grade'=>new gradeResource($this->grade),
            'date'=>$this->date,
            'start_time'=>$this->start_time,
            'end_time'=>$this->end_time,
            "periodType"=>$this->periodType,
        ];
    }
}  
