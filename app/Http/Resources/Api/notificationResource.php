<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class notificationResource extends JsonResource
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
            'id'=>$this->id,
            'content'=>$this->notification->content,
            'type'=>$this->notification->type,
            'typeTranslated'=>$this->notification->typeTranslated,
            'createdAt'=>$this->notification->created_at,
            'createdAtInt'=>strtotime($this->notification->created_at),
        ];
    }
    
}
