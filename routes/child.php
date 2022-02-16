<?php

use App\Http\Controllers\API\V1\Child\AttendanceController;
use App\Http\Controllers\API\V1\Child\AuthController;
use App\Http\Controllers\API\V1\Child\ChildController;
use App\Http\Controllers\API\V1\Child\ContactBookController;
use App\Http\Middleware\ChildcareAuth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\\Http\\Controllers\\API\V1\\Child')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware(ChildcareAuth::class)->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
    });
    Route::middleware(['auth:api'])->group(function () {
        Route::put('/register/{child}', [ChildController::class, 'update'])->middleware('can:handle-child,child');
        Route::post('/register', [ChildController::class, 'register']);
        Route::get('/child', [ChildController::class, 'list']);
        Route::get('/child/{child}', [ChildController::class, 'retrieve'])->middleware('can:handle-child,child');
        Route::delete('/child/{child}', [ChildController::class, 'delete'])->middleware('can:handle-child,child');
        Route::post('/attendance/{child}', [AttendanceController::class, 'save'])->middleware('can:handle-child,child');
        Route::get('/attendance', [AttendanceController::class, 'list']);

        Route::post('/contact-book/child/{child}/school/0', [ContactBookController::class, 'schoolSave0'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/school/1', [ContactBookController::class, 'schoolSave12'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/school/2', [ContactBookController::class, 'schoolSave345'])->middleware('can:handle-child,child');
    });
    Route::middleware(['auth:childcare'])->group(function () {
        Route::post('/contact-book/child/{child}/home/0', [ContactBookController::class, 'homeSave0'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/home/1', [ContactBookController::class, 'homeSave12'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/home/2', [ContactBookController::class, 'homeSave345'])->middleware('can:handle-child,child');
    });
});
