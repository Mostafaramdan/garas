<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class studentResource extends JsonResource
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
            'apiToken'=>$this->apiToken,
            'name'=>$request->name,
            'classId'=>$this->classes_id
        ];
    }
}
