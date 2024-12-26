<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Middleware\CheckConsumerLogin;
use App\Http\Middleware\CheckStoreLogin;

Route::prefix('consumer')->middleware([CheckConsumerLogin::class])->group(function () {

    Route::post('/update', [ConsumerController::class, 'update']);                  //旅客變更基本資料
    Route::post('/changePWD', [ConsumerController::class, 'changePassword']);       //旅客變更密碼
    Route::post('/overview', [ConsumerController::class, 'overview']);              //旅客資料

    Route::post('/order', [ConsumerController::class, 'update']);
    Route::post('/pay', [ConsumerController::class, 'update']);
    Route::post('/orderCancel', [ConsumerController::class, 'update']);
});


Route::prefix('store')->middleware([CheckStoreLogin::class])->group(function () {
    Route::post('/update', [StoreController::class, 'update']);                     //商家變更基本資料
    Route::post('/changePWD', [StoreController::class, 'changePassword']);          //商家變更密碼
    Route::post('/room_list', [StoreController::class, 'roomList']);                //商家瀏覽房型

    Route::post('/new_room', [RoomTypeController::class, 'create']);                //新增房型
    Route::post('/update_room', [RoomTypeController::class, 'update']);             //編輯房型

    Route::post('/order_view', [RoomTypeController::class, 'update']);
    Route::post('/order_status', [RoomTypeController::class, 'update']);

});

Route::post('/rooms', [RoomTypeController::class, 'index']);            //房型瀏覽

Route::post('/register', [ConsumerController::class, 'register']);      //旅客註冊
Route::post('/store/register', [StoreController::class, 'register']);   //商家註冊

Route::post('/login', [ConsumerController::class, 'login']);            //旅客登入
Route::post('/store/login', [StoreController::class, 'login']);         //商家登入

Route::post('/logout', [ConsumerController::class, 'logout']);          //商家登出
Route::post('/store/logout', [StoreController::class, 'logout']);       //商家登出
