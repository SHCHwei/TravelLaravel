<?php

use App\Http\Middleware\EnsureJsonInput;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;


Route::post('/orders', [OrderController::class, 'orders'])->name("orders")->middleware(EnsureJsonInput::class);
