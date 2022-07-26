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
        Route::get('/dashboard', \App\Http\Controllers\Admin\AdminController::class)->name('admin.dashboard.index');
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
        //Testimonials
        Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
        //Certificates
        Route::get('/certificates', [\App\Http\Controllers\Admin\CertificateController::class, 'index'])->name('admin.certificates.index');
        Route::post('/certificates/store', [\App\Http\Controllers\Admin\CertificateController::class, 'store'])->name('admin.certificates.store');
        Route::delete('/certificates/{certificate}/delete', [\App\Http\Controllers\Admin\CertificateController::class, 'destroy'])->name('admin.certificates.destroy');
        //Users
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

        Route::get('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout.perform');
    });
});
