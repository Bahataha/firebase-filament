<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use App\Filament\Resources\NotificationResource;
use App\Jobs\SendPushNotification;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNotification extends CreateRecord
{
    protected static string $resource = NotificationResource::class;

    public function getRedirectUrl(): string
    {
        return NotificationResource::getUrl();
    }

    protected function afterCreate(): void
    {
        SendPushNotification::dispatch($this->record)->delay($this->record->scheduled_at);
    }
}
