<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class teacherResource extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'code'=>$this->code,
            'apiToken'=>$this->apiToken
        ];
    }
}
