<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require('auth.php');
require('verify_routes.php');
require('forgot_password.php');

Route::get('/', function () {
    $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;
    return view('welcome', compact('profile'));
})->name('welcome');

Route::group(
    ['middleware' => ['auth', 'auth.session', 'verified']],
    function () {

        Route::get('profile/ajax', [ProfileController::class, 'ajax']);
        Route::resource('profile', ProfileController::class);

        Route::get('storage/private/{file}', function ($file) {
            $path = storage_path('app/private/' . $file);
            return response()->file($path);
        })->name('private');
    }
);
