<?php

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

Route::get('/', function() {
    return view('hello');
});

Route::get('login', 'contLogin@showLoginPage');
Route::get('logout', 'contLogin@doLogout');
Route::post('login', 'contLogin@doLogin');

Route::group(['prefix' => 'admin', 'middleware' => 'middlewareAuth'], function () {
    Route::get('/', function() {
        return redirect('/admin/device');
    });
    Route::get('device', 'contDeviceManager@showDevices');
});