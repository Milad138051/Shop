<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Content\CommentController;
use App\Http\Controllers\Admin\Content\PostCategoryController;

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

Route::get('/', function () {
    return view('welcome');
});




//auth
Route::controller(LoginRegisterController::class)->prefix('auth')->group(function () {
    Route::get('login-register', 'loginRegisterForm')->name('auth.login-register-form');
    Route::post('login-register','loginRegister')->name('auth.login-register');
    Route::get('login-register-confirm/{token}', 'loginRegisterConfirmForm')->name('auth.login-register-confirm-form');
    Route::post('login-register-confirm/{token}', 'loginRegisterConfirm')->name('auth.login-register-confirm');
    Route::get('login-register-resend-otp/{token}','loginRegisterResendOtp')->name('auth.login-register-resend-otp');
    Route::get('logout/','logout')->name('auth.customer.logout');
});


//admin
Route::prefix('admin')->group(function () {

    Route::get('', [AdminDashboardController::class, 'index'])->name('admin.home');

    Route::prefix('content')->group(function () {
        Route::controller(PostCategoryController::class)->prefix('postCategory')->group(function () {
            Route::get('/', 'index')->name('admin.content.postCategory.index');
            Route::get('/create', 'create')->name('admin.content.postCategory.create');
            Route::post('/store', 'store')->name('admin.content.postCategory.store');
            Route::get('/edit/{postCategory}', 'edit')->name('admin.content.postCategory.edit');
            Route::put('/update/{postCategory}', 'update')->name('admin.content.postCategory.update');
            Route::delete('/delete/{postCategory}', 'delete')->name('admin.content.postCategory.delete');
        });
        Route::controller(PostController::class)->prefix('post')->group(function () {
            Route::get('/', 'index')->name('admin.content.post.index');
            Route::get('/create', 'create')->name('admin.content.post.create');
            Route::post('/store', 'store')->name('admin.content.post.store');
            Route::get('/edit/{post}', 'edit')->name('admin.content.post.edit');
            Route::put('/update/{post}', 'update')->name('admin.content.post.update');
            Route::delete('/delete/{post}', 'delete')->name('admin.content.post.delete');
        });
        Route::controller(CommentController::class)->prefix('comment')->group(function () {
            Route::get('/', 'index')->name('admin.content.comment.index');
            Route::get('/show/{comment}', 'show')->name('admin.content.comment.show');
            // Route::get('/status/{comment}', 'status')->name('admin.comment.status');
            Route::delete('/destroy/{comment}', 'delete')->name('admin.content.comment.delete');
            Route::get('/approved/{comment}', 'approved')->name('admin.content.comment.approved');
            Route::post('/answer/{comment}', 'answer')->name('admin.content.comment.answer');
        });

    });

});
