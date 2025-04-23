<?php

namespace App\Repositories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;

class DeviceRepository extends Repository
{
    public function create(array $attributes): Model
    {
        return $this->getQuery()->create($attributes);
    }

    public static function getEntityInstance(): Model
    {
        return new Device();
    }
}
