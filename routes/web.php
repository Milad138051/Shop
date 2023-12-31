<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
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

Route::get('/', function () {
    return view('welcome');
});



//admin
Route::get('admin',[AdminDashboardController::class,'index'])->name('admin.home');

Route::controller(PostCategoryController::class)->prefix('admin/postCategory')->group(function () {
    Route::get('/','index')->name('admin.postCategory.index');
    Route::get('/create','create')->name('admin.postCategory.create');
    Route::post('/store','store')->name('admin.postCategory.store');
    Route::get('/edit/{postCategory}','edit')->name('admin.postCategory.edit');
    Route::put('/update/{postCategory}','update')->name('admin.postCategory.update');
    Route::delete('/delete/{postCategory}','delete')->name('admin.postCategory.delete');
});
Route::controller(PostController::class)->prefix('admin/post')->group(function () {
    Route::get('/','index')->name('admin.post.index');
    Route::get('/create','create')->name('admin.post.create');
    Route::post('/store','store')->name('admin.post.store');
    Route::get('/edit/{post}','edit')->name('admin.post.edit');
    Route::put('/update/{post}','update')->name('admin.post.update');
    Route::delete('/delete/{post}','delete')->name('admin.post.delete');

});
