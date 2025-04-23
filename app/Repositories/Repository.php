<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class Repository
{
    public Model $entityInstance;

    public function __construct()
    {
        $this->initializeRepository();
    }

    public function getQuery(): Builder
    {
        return $this->entityInstance::query();
    }

    abstract public static function getEntityInstance(): Model;

    private function initializeRepository(): void
    {
        $this->entityInstance = static::getEntityInstance();
    }
}
