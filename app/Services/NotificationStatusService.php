<?php

namespace App\Services;

use App\Repositories\NotificationStatusRepository;

class NotificationStatusService
{
    public function __construct(
        protected NotificationStatusRepository $notificationStatusRepository
    ) {}

    public function batchCreate(array $data): void
    {
        $this->notificationStatusRepository->batchCreate($data);
    }
}
