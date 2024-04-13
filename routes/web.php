<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ToastController;
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
Route::get('filters/ajax', [FilterController::class, 'filter']);

Route::group(
    ['middleware' => ['auth', 'auth.session', 'verified']],
    function () {

        Route::get('profile/ajax', [ProfileController::class, 'ajax']);
        Route::resource('profile', ProfileController::class)->only(['store', 'update']);

        Route::resource('movies', MovieController::class);

        Route::resource('genders', GenderController::class)->except(['create', 'edit', 'show', 'update'])->middleware('admin');

        Route::resource('comments', CommentController::class)->only(['store','destroy']);

        Route::get('ratings/ajax', [RatingController::class, 'ajax']);

        Route::get('tags/ajax', [TagController::class, 'ajax']);
        Route::resource('tags', TagController::class)->except(['create', 'edit', 'show', 'update'])->middleware('admin');

        Route::get('toasts/ajax', [ToastController::class, 'ajax']);



        Route::get('storage/private/{file}', function ($file) {
            $path = storage_path('app/private/' . $file);
            return response()->file($path);
        })->name('private');
    }
);
