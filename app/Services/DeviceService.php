<?php

namespace App\Services;

use App\Http\Requests\DeviceRegisterRequest;
use App\Repositories\DeviceRepository;
use Illuminate\Database\Eloquent\Model;

class DeviceService
{
    public function __construct(
        private readonly DeviceRepository $deviceRepository
    ) {}

    public function register(DeviceRegisterRequest $request): Model
    {
        return $this->deviceRepository->create([
            'user_id' => $request->get('user_id'),
            'device_token' => $request->get('device_token'),
            'device_name' => $request->get('device_name'),
        ]);
    }

    public function getAllDeviceTokens(): array
    {
        return $this->deviceRepository->getQuery()
            ->select('device_token')
            ->get()
            ->pluck('device_token')
            ->toArray();
    }

    public function getDeviceIdsByTokens(array $tokens): array
    {
        return $this->deviceRepository->getQuery()
            ->select('id')
            ->whereIn('device_token', $tokens)
            ->get()
            ->pluck('id')
            ->toArray();
    }
}
