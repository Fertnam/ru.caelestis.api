<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageUploadController;
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

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'upload'], function () {
        Route::post('/skin', [ImageUploadController::class, 'uploadSkin']);
        Route::post('/cloak', [ImageUploadController::class, 'uploadCloak']);
    });

    Route::get('/user', [UserController::class, 'index']);
    Route::put('/changePassword', [UserController::class, 'changePassword']);

    Route::post('logout', LogoutController::class);
});
