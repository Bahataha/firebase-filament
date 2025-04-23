<?php

use App\Http\Controllers\V1\DeviceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/devices/register', [DeviceController::class, 'register']);
});
