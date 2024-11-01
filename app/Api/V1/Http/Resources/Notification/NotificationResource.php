<?php

namespace App\Api\V1\Http\Resources\Notification;

use App\Enums\Notification\NotificationStatus;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class NotificationResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return $this->collection->map(function($notification){
            return [
                'id' => $notification->id,
                'title' => $notification->title,
                'message' => $notification->message,
                'status' => NotificationStatus::getDescription($notification->status->value),
                'created_at' => $notification->created_at->toIso8601String(),
            ];
        });
    }
}
