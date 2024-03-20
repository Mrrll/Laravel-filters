<?php

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Authentication routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Authentication" middleware group. Make something great!
|
*/

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('register', 'register')->name('singup')->middleware('guest');
    Route::get('login', 'login')->name('singin')->middleware('guest');
    Route::post('register', 'registered')->name('register')->middleware('guest');
    Route::post('login', 'Authorization')->name('login')->middleware('guest');
    Route::get('logout', 'logout')->name('logout')->middleware(['auth','auth.session']);
});
