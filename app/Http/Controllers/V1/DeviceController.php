<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRegisterRequest;
use App\Services\DeviceService;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    public function register(DeviceRegisterRequest $request, DeviceService $service): JsonResponse
    {
        $device = $service->register($request);

        return $this->respondCreated($device);
    }
}
