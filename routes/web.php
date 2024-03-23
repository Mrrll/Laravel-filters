<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
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

Route::get('/', [MovieController::class, 'index'])->name('welcome');

Route::group(
    ['middleware' => ['auth', 'auth.session', 'verified']],
    function () {

        Route::get('profile/ajax', [ProfileController::class, 'ajax']);
        Route::resource('profile', ProfileController::class);

        Route::get('movies/ajax', [MovieController::class, 'ajax']);
        Route::resource('movies', MovieController::class);

        Route::get('genders/ajax', [GenderController::class, 'ajax']);
        Route::resource('genders', GenderController::class);

        Route::get('comments/ajax', [CommentController::class, 'ajax']);
        Route::resource('comments', CommentController::class);

        Route::get('ratings/ajax', [RatingController::class, 'ajax']);
        Route::resource('ratings', RatingController::class);

        Route::get('tags/ajax', [TagController::class, 'ajax']);
        Route::resource('tags', TagController::class);

        Route::get('storage/private/{file}', function ($file) {
            $path = storage_path('app/private/' . $file);
            return response()->file($path);
        })->name('private');
    }
);
