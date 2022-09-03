<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class noteResource extends JsonResource
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
            'notes'=>$this->notes,
            'created_at_str'=>$this->created_at,
            'created_at'=>strtotime($this->created_at),
        ];
    }
}
