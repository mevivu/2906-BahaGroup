<?php

namespace App\Admin\Repositories\Notification;
use App\Admin\Repositories\EloquentRepository;
use App\Models\Notification;

class NotificationRepository extends EloquentRepository implements NotificationRepositoryInterface
{

    public function getModel(): string
    {
        return Notification::class;
    }
}
