<?php

namespace App\Api\V1\Http\Resources\Auth;

use App\Enums\User\Gender;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => Gender::getDescription($this->gender->value),
            'vip' => $this->vip,
            'created_at' => $this->created_at,
        ];
    }
}
