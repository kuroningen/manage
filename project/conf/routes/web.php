<?php

use Illuminate\Support\Facades\Route;
use project\core\middleware\middlewareAuth;
use project\core\middleware\middlewareNoAuth;

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


Route::post('register', 'toolLogin\contRegister@doRegister');
Route::get('logout', 'toolLogin\contLogin@doLogout');
Route::get('generate', 'toolLogin\contKeyGenerator@generateKey');

Route::group(['middleware' => middlewareNoAuth::class], function() {
    Route::get('login', 'toolLogin\contLogin@showLoginPage');
    Route::post('login', 'toolLogin\contLogin@doLogin');
});

Route::group(['middleware' => middlewareAuth::class], function() {
    Route::get('/', 'contDeviceManager@showDevices');
    Route::get('/', 'contLanding@showLandingPage');
});