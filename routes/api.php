<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::controller(UserController::class)->group(callback: function () {
    Route::post(uri: 'users', action: 'store');
    Route::middleware('auth.api')->group(callback: function () {
        Route::get(uri: 'users', action: 'show');
        Route::put(uri: 'users', action: 'update');
        Route::delete(uri: 'users', action: 'destroy');
    });
});



