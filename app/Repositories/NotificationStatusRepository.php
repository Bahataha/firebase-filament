<?php

namespace App\Repositories;

use App\Models\NotificationStatus;
use Illuminate\Database\Eloquent\Model;

class NotificationStatusRepository extends Repository
{
    public function batchCreate(array $data): void
    {
        $this->getQuery()->insert($data);
    }

    public static function getEntityInstance(): Model
    {
        return new NotificationStatus();
    }
}
