<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Customer\Infrastructure\Http\Controllers\CustomerController;

Route::get('/health', function () {
    return 'health';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/customers', [CustomerController::class, 'store']);
