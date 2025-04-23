<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'body',
        'scheduled_at'
    ];

    public function notificationStatuses(): HasMany
    {
        return $this->hasMany(NotificationStatus::class);
    }
}
