<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\ConstantController;
use App\Http\Controllers\API\V1\HourlyWageController;
use App\Http\Controllers\API\V1\OfficeController;
use App\Http\Controllers\API\V1\RegionController;
use App\Http\Controllers\API\V1\SettingController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\VacationReasonController;
use App\Http\Controllers\API\V1\WorkingHourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});

Route::namespace('App\\Http\\Controllers\\API\V1')->prefix('/v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/constants', [ConstantController::class, 'get']);

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::middleware(['can:admin-only'])->group(function() {
            Route::get('/office-master', [OfficeController::class, 'get'])->name('office_master.get');
            Route::post('/office-master', [OfficeController::class, 'create'])->name('office_master.create');
            Route::put('/office-master/{office}', [OfficeController::class, 'update'])->name('office_master.update');
            Route::delete('/office-master/{office}', [OfficeController::class, 'delete'])->name('office_master.delete');

            Route::get('/office-master/{office}/scheduled-working', [OfficeController::class, 'getScheduleWorkings'])->name('office_master.scheduled_working.get');
            Route::post('/office-master/{office}/scheduled-working', [OfficeController::class, 'saveScheduleWorking'])->name('office_master.scheduled_working.save');


            Route::get('/region', [RegionController::class, 'get'])->name('region.get');
            Route::post('/region', [RegionController::class, 'create'])->name('region.create');
            Route::post('/region/{region}', [RegionController::class, 'update'])->name('region.update');
            Route::delete('/region/{region}', [RegionController::class, 'delete'])->name('region.delete');

            Route::get('/reason-for-vacation', [VacationReasonController::class, 'get'])->name('vacation_reason.get');
            Route::post('/reason-for-vacation', [VacationReasonController::class, 'create'])->name('vacation_reason.create');
            Route::put('/reason-for-vacation/status/{reasonForVacation}', [VacationReasonController::class, 'updateStatus']);
            Route::post('/reason-for-vacation/{reasonForVacation}', [VacationReasonController::class, 'update']);
            Route::delete('/reason-for-vacation/{reasonForVacation}', [VacationReasonController::class, 'delete']);

            Route::get('/working-hours', [WorkingHourController::class, 'get']);
            Route::post('/working-hours', [WorkingHourController::class, 'create']);
            Route::put('/working-hours/status/{workingHour}', [WorkingHourController::class, 'updateStatus']);
            Route::put('/working-hours/{workingHour}', [WorkingHourController::class, 'update']);
            Route::delete('/working-hours/{workingHour}', [WorkingHourController::class, 'delete']);

            Route::get('/setting', [SettingController::class, 'get']);
            Route::post('/setting', [SettingController::class, 'save']);

            Route::get('/hourly-wage', [HourlyWageController::class, 'get']);
            Route::post('/hourly-wage', [HourlyWageController::class, 'create']);
            Route::put('/hourly-wage/{hourlyWage}', [HourlyWageController::class, 'update']);
            Route::delete('/hourly-wage/{hourlyWage}', [HourlyWageController::class, 'delete']);

            Route::get('/users', [UserController::class, 'get']);
            Route::put('/users/{user}/setting', [UserController::class, 'updateSetting']);
        });
    });
});
