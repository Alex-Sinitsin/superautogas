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
    Route::group(['middleware' => ['guest']], function () {
        Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'show'])->name('admin.login');
        Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', \App\Http\Controllers\Admin\AdminController::class)->name('admin.index');
        //Posts
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
        Route::post('posts/upload', [\App\Http\Controllers\Admin\PostController::class, 'upload']);
        //Pages
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        //Galleries
        Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);
        Route::post('/galleries/brand/store', [\App\Http\Controllers\Admin\GalleryController::class, 'brandStore'])->name('admin.brands.store');
        Route::post('/galleries/brand/update/{gallery}', [\App\Http\Controllers\Admin\GalleryController::class, 'brandUpdate'])->name('admin.brands.update');
        Route::delete('/galleries/brand/delete/{gallery}', [\App\Http\Controllers\Admin\GalleryController::class, 'destroyBrand'])->name('admin.brands.delete');
        Route::post('/galleries/update/{gallery}', [\App\Http\Controllers\Admin\GalleryController::class, 'update'])->name('admin.models.update');
        Route::delete('/galleries/delete/{gallery}', [\App\Http\Controllers\Admin\GalleryController::class, 'destroyModel'])->name('admin.models.delete');

        Route::get('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout.perform');
    });
});
