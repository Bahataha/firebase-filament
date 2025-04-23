<?php

namespace App\Filament\Resources\NotificationStatusResource\Pages;

use App\Filament\Resources\NotificationStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotificationStatus extends EditRecord
{
    protected static string $resource = NotificationStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
