<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class NotificationService
{
    public function __construct(
        protected Messaging $messaging,
        protected FirebaseNotification $notification,
        protected DeviceService $deviceService,
        protected NotificationRepository $notificationRepository,
        protected NotificationStatusService $notificationStatusService
    ) {}

    public function sendNotification(Notification $notification, int $batchSize = 200): void
    {
        $tokens = array_chunk($this->deviceService->getAllDeviceTokens(), $batchSize);

        $message = CloudMessage::new()
            ->withNotification($this->notification::create($notification->title, $notification->body));

        foreach ($tokens as $token) {
            $sendReport = $this->messaging->sendMulticast($message, $token);

            $failureTokens = [];
            foreach ($sendReport->failures()->getItems() as $failure) {
                $failureTokens[] = $failure->target()->value();
            }
            $this->createNotificationStatusByStatus($failureTokens, StatusEnum::ERROR->value, $notification->id);

            $successTokens = [];
            foreach ($sendReport->successes()->getItems() as $success) {
                $failureTokens[] = $success->target()->value();
            }
            $this->createNotificationStatusByStatus($successTokens, StatusEnum::SUCCESS->value, $notification->id);
        }
    }

    private function createNotificationStatusByStatus(array $failureTokens, int $status, int $notificationId): void
    {
        $deviceIds = $this->deviceService->getDeviceIdsByTokens($failureTokens);
        $this->createNotificationStatus($deviceIds, $status, $notificationId);
    }

    private function createNotificationStatus(array $deviceIds, int $statusId, int $notificationId): void
    {
        $array = array_map(fn($deviceId) => [
            'device_id' => $deviceId,
            'status_id' => $statusId,
            'notification_id' => $notificationId,
        ], $deviceIds);

        $this->notificationStatusService->batchCreate($array);
    }
}
