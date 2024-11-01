<?php

namespace App\Models;

use App\Enums\Notification\NotificationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends  Model
{
    use HasFactory;
    protected $table = 'notifications';

    protected $fillable = [
        /** user_id */
        'user_id',
        /** Tiêu đề thông báo */
        'title',
        /** Nội dung thông báo */
        'message',
        /** Trạng thái thông báo 1: Chưa đọc, 2: Đã đọc */
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'status' => NotificationStatus::class,
    ];
    public function markAsRead(): void
    {
        $this->status = NotificationStatus::READ;
        $this->save();
    }
}
