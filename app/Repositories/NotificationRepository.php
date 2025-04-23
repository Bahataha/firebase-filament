<?php

namespace App\Repositories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;

class NotificationRepository extends Repository
{
    public static function getEntityInstance(): Model
    {
        return new Notification();
    }
}
