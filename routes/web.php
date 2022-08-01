<?php

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

Route::redirect('/', '/admin/login');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['guest']], function() {
        Route::get('/login', [\App\Http\Controllers\LoginController::class, 'show'])->name('admin.login');
        Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('admin.login.perform');
    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', \App\Http\Controllers\AdminController::class)->name('admin.index');
        Route::resource('posts', \App\Http\Controllers\PostController::class);
        Route::post('posts/upload', [\App\Http\Controllers\PostController::class, 'upload']);
        Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('admin.logout.perform');
    });
});
