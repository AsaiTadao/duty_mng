<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\ConstantController;
use App\Http\Controllers\API\V1\OfficeController;
use App\Http\Controllers\API\V1\RegionController;
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
        Route::get('/office-master', [OfficeController::class, 'get'])->name('office_master.get');
        Route::post('/office-master', [OfficeController::class, 'create'])->name('office_master.create');
        Route::put('/office-master/{office}', [OfficeController::class, 'update'])->name('office_master.update');
        Route::get('/region', [RegionController::class, 'get'])->name('region.get');
        Route::post('/region', [RegionController::class, 'create'])->name('region.create');
        Route::post('/region/{region}', [RegionController::class, 'update'])->name('region.update');
    });
});
