<?php

use App\Http\Controllers\API\V1\Child\AttendanceController;
use App\Http\Controllers\API\V1\Child\AuthController;
use App\Http\Controllers\API\V1\Child\ChildcareDiaryController;
use App\Http\Controllers\API\V1\Child\ChildController;
use App\Http\Controllers\API\V1\Child\ChildPlanController;
use App\Http\Controllers\API\V1\Child\ContactBookController;
use App\Http\Controllers\API\V1\Child\MailController;
use App\Http\Middleware\ChildcareAuth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\\Http\\Controllers\\API\V1\\Child')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware(ChildcareAuth::class)->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::get('/current-office', [AuthController::class, 'currentOffice']);
        Route::get('/monthly-attendance/{child}', [AttendanceController::class, 'monthlyList']);
    });
    Route::middleware(['auth:api'])->group(function () {
        Route::put('/register/{child}', [ChildController::class, 'update'])->middleware('can:handle-child,child');
        Route::post('/register', [ChildController::class, 'register']);
        Route::get('/child', [ChildController::class, 'list']);
        Route::get('/child/{child}', [ChildController::class, 'retrieve'])->middleware('can:handle-child,child');
        Route::delete('/child/{child}', [ChildController::class, 'delete'])->middleware('can:handle-child,child');
        Route::post('/attendance/{child}', [AttendanceController::class, 'save'])->middleware('can:handle-child,child');
        Route::get('/attendance', [AttendanceController::class, 'list']);

        Route::get('/contact-book/child/{child}', [ContactBookController::class, 'retrieve'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/school/0', [ContactBookController::class, 'schoolSave0'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/school/1', [ContactBookController::class, 'schoolSave12'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/school/2', [ContactBookController::class, 'schoolSave345'])->middleware('can:handle-child,child');

        Route::get('/child-diary', [ChildcareDiaryController::class, 'retrieve']);
        Route::post('/child-diary', [ChildcareDiaryController::class, 'save']);

        Route::get('/plan/{child}', [ChildPlanController::class, 'retrieve'])->middleware('can:handle-child,child');
        Route::post('/plan/{child}', [ChildPlanController::class, 'save'])->middleware('can:handle-child,child');
        Route::get('/plan-days/{child}', [ChildPlanController::class, 'retrieveDailyPlan'])->middleware('can:handle-child,child');
        Route::post('/plan-days/{child}', [ChildPlanController::class, 'saveDayPlan'])->middleware('can:handle-child,child');
        Route::get('/attendance-daily-stat', [AttendanceController::class, 'dailyStat']);
        Route::post('/mail', [MailController::class, 'dispatchMail']);
        Route::get('/mail-template', [MailController::class, 'getMailTemplate']);
        Route::get('/mail-history', [MailController::class, 'listMailJob']);
    });
    Route::middleware(['auth:childcare'])->group(function () {
        Route::post('/contact-book/child/{child}/home/0', [ContactBookController::class, 'homeSave0'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/home/1', [ContactBookController::class, 'homeSave12'])->middleware('can:handle-child,child');
        Route::post('/contact-book/child/{child}/home/2', [ContactBookController::class, 'homeSave345'])->middleware('can:handle-child,child');
    });
});
