<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoteController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('index');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/history', [PostController::class, 'history'])->name('posts.history');
    Route::get('/posts/followed', [PostController::class, 'followed'])->name('posts.followed');
    Route::get('/posts/new', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/new', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit')->middleware(['owner.post', 'post.open', 'post.no-interation']);
    Route::post('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update')->middleware(['owner.post', 'post.open', 'post.no-interation']);
    Route::delete('/posts/delete/{id}', [PostController::class, 'destroy'])->name('posts.delete')->middleware(['owner.post', 'post.open', 'post.no-interation']);
    Route::post('/posts/conclued/{id}', [PostController::class, 'conclued'])->name('posts.conclued')->middleware(['owner.post', 'post.open']);
});