<?php

use App\Http\Controllers\API\V1\Child\AuthController;
use App\Http\Controllers\API\V1\Child\ChildController;
use App\Http\Middleware\ChildcareAuth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\\Http\\Controllers\\API\V1\\Child')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware(ChildcareAuth::class)->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
    });
    Route::middleware(['auth:api'])->group(function () {
        Route::put('/register/{child}', [ChildController::class, 'update']);
        Route::post('/register', [ChildController::class, 'register']);
    });
});
