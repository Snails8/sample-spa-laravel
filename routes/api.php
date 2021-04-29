<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function () {
        return Auth::user();
    });

    // Users
    Route::resource('users', UserController::class)->only([
        'index'
    ]);

});
