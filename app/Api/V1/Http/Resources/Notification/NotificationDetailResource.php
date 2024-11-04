<?php

namespace App\Api\V1\Http\Resources\Notification;

use App\Enums\Notification\NotificationStatus;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'message' => $this->message,
            'status' => NotificationStatus::getDescription($this->status->value),
            'created_at' => $this->created_at,
        ];
    }
}
