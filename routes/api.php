<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\CustomerController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout')->middleware('auth:api');
    });
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('create/customer', [CustomerController::class, 'create']);
    Route::post('update/customer/{customer}', [CustomerController::class, 'update']);
    Route::post('bill/customer/{customer}', [BillController::class, 'bill']);
    Route::get('bill/filter', [BillController::class, 'filter']);
});