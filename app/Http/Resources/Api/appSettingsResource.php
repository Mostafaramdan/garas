<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class appSettingsResource extends JsonResource
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
            'email'=>$this->email,
            'phone'=>$this->phone,
            'aboutUs'=>$this->{"about_".request()->lang},
            'terms'=>$this->{"terms_".request()->lang}

        ];
    }
}
