<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Middleware\CheckConsumerLogin;
use App\Http\Middleware\CheckStoreLogin;

Route::prefix('consumer')->middleware([CheckConsumerLogin::class])->group(function () {

    Route::post('/update', [ConsumerController::class, 'update']);
    Route::post('/changePWD', [ConsumerController::class, 'changePassword']);
    Route::post('/overview', [ConsumerController::class, 'overview']);

    Route::post('/order', [ConsumerController::class, 'update']);
    Route::post('/pay', [ConsumerController::class, 'update']);
    Route::post('/orderCancel', [ConsumerController::class, 'update']);
});


Route::prefix('store')->middleware([CheckStoreLogin::class])->group(function () {
    Route::post('/update', [StoreController::class, 'update']);
    Route::post('/changePWD', [StoreController::class, 'changePassword']);

    Route::post('/room_list', [StoreController::class, 'update']);
    Route::post('/new_room', [RoomTypeController::class, 'update']);
    Route::post('/update_room', [RoomTypeController::class, 'update']);

    Route::post('/order_view', [RoomTypeController::class, 'update']);
    Route::post('/order_status', [RoomTypeController::class, 'update']);

});


Route::post('/register', [ConsumerController::class, 'register']);
Route::post('/store/register', [StoreController::class, 'register']);

Route::post('/login', [ConsumerController::class, 'login']);
Route::post('/store/login', [StoreController::class, 'login']);

Route::post('/logout', [ConsumerController::class, 'logout']);
Route::post('/store/logout', [StoreController::class, 'logout']);
