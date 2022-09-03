<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class classRoomTableResource extends JsonResource
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
            'teacher'=>new teacherResource($this->teacher),
            'subject'=>new subjectResource($this->subject),
            'day'=>$this->class_rooms_in_day->day,
            'classRoomNumber'=>$this->class_rooms_in_day->class_room->number,
            'class'=>new classResource($this->class),
            'notes'=>noteResource::collection($this->notes)
        ];
    }
}
