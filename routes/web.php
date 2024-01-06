<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Content\CommentController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Market\GuaranteeController;
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Admin\Content\PostCategoryController;
use App\Http\Controllers\Admin\Market\PropertyValueController;
use App\Http\Controllers\Admin\Market\CommentController as ProductCommentController;


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
    Route::
        // middleware('throttle:customer-login-register-limiter')->
        post('login-register', 'loginRegister')->name('auth.login-register');
    Route::get('login-register-confirm/{token}', 'loginRegisterConfirmForm')->name('auth.login-register-confirm-form');
    Route::
        // middleware('throttle:customer-login-register-limiter')->
        post('login-register-confirm/{token}', 'loginRegisterConfirm')->name('auth.login-register-confirm');
    Route::
        // middleware('throttle:customer-login-register-limiter')->
        get('login-register-resend-otp/{token}', 'loginRegisterResendOtp')->name('auth.login-register-resend-otp');
    Route::get('logout/', 'logout')->name('auth.customer.logout');
});


//admin
Route::prefix('admin')->group(function () {
    Route::get('', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::prefix('content')->group(function () {
        //post category
        Route::controller(PostCategoryController::class)->prefix('postCategory')->group(function () {
            Route::get('/', 'index')->name('admin.content.postCategory.index');
            Route::get('/create', 'create')->name('admin.content.postCategory.create');
            Route::post('/store', 'store')->name('admin.content.postCategory.store');
            Route::get('/edit/{postCategory}', 'edit')->name('admin.content.postCategory.edit');
            Route::put('/update/{postCategory}', 'update')->name('admin.content.postCategory.update');
            Route::delete('/delete/{postCategory}', 'delete')->name('admin.content.postCategory.delete');
        });
        //post
        Route::controller(PostController::class)->prefix('post')->group(function () {
            Route::get('/', 'index')->name('admin.content.post.index');
            Route::get('/create', 'create')->name('admin.content.post.create');
            Route::post('/store', 'store')->name('admin.content.post.store');
            Route::get('/edit/{post}', 'edit')->name('admin.content.post.edit');
            Route::put('/update/{post}', 'update')->name('admin.content.post.update');
            Route::delete('/delete/{post}', 'delete')->name('admin.content.post.delete');
        });
        //comment
        Route::controller(CommentController::class)->prefix('comment')->group(function () {
            Route::get('/', 'index')->name('admin.content.comment.index');
            Route::get('/show/{comment}', 'show')->name('admin.content.comment.show');
            // Route::get('/status/{comment}', 'status')->name('admin.comment.status');
            Route::delete('/destroy/{comment}', 'delete')->name('admin.content.comment.delete');
            Route::get('/approved/{comment}', 'approved')->name('admin.content.comment.approved');
            Route::post('/answer/{comment}', 'answer')->name('admin.content.comment.answer');
        });

    });

    Route::prefix('market')->group(function () {
        //category
        Route::controller(CategoryController::class)->prefix('category')->group(function () {
            Route::get('/', 'index')->name('admin.market.category.index');
            Route::get('/create', 'create')->name('admin.market.category.create');
            Route::post('/store', 'store')->name('admin.market.category.store');
            Route::get('/edit/{productCategory}', 'edit')->name('admin.market.category.edit');
            Route::put('/update/{productCategory}', 'update')->name('admin.market.category.update');
            Route::delete('/destroy/{productCategory}', 'delete')->name('admin.market.category.delete');
        });
        //brand
        Route::controller(BrandController::class)->prefix('brand')->group(function () {
            Route::get('/', 'index')->name('admin.market.brand.index');
            Route::get('/create', 'create')->name('admin.market.brand.create');
            Route::post('/store', 'store')->name('admin.market.brand.store');
            Route::get('/edit/{brand}', 'edit')->name('admin.market.brand.edit');
            Route::put('/update/{brand}', 'update')->name('admin.market.brand.update');
            Route::delete('/destroy/{brand}', 'delete')->name('admin.market.brand.delete');
        });

        //product
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('admin.market.product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.market.product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.market.product.store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('admin.market.product.edit');
            Route::put('/update/{product}', [ProductController::class, 'update'])->name('admin.market.product.update');
            Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.market.product.destroy');
            //gallery
            Route::get('{product}/gallery', [GalleryController::class, 'index'])->name('admin.market.product.gallery.index');
            Route::get('/{product}/gallery/create', [GalleryController::class, 'create'])->name('admin.market.product.gallery.create');
            Route::post('{product}/gallery/store', [GalleryController::class, 'store'])->name('admin.market.product.gallery.store');
            Route::delete('/gallery/destroy/{gallery}', [GalleryController::class, 'destroy'])->name('admin.market.product.gallery.destroy');
            // //product-color
            Route::get('{product}/product-color', [ProductColorController::class, 'index'])->name('admin.market.product-color.index');
            Route::get('{product}/product-color/create', [ProductColorController::class, 'create'])->name('admin.market.product-color.create');
            Route::post('{product}/product-color/store', [ProductColorController::class, 'store'])->name('admin.market.product-color.store');
            Route::delete('product-color/destroy/{productcolor}', [ProductColorController::class, 'destroy'])->name('admin.market.product-color.destroy');
            // //guarantee
            Route::get('/guarantee/{product}', [GuaranteeController::class, 'index'])->name('admin.market.guarantee.index');
            Route::get('/guarantee/create/{product}', [GuaranteeController::class, 'create'])->name('admin.market.guarantee.create');
            Route::post('/guarantee/store/{product}', [GuaranteeController::class, 'store'])->name('admin.market.guarantee.store');
            Route::delete('/guarantee/destroy/{product}/{guarantee}', [GuaranteeController::class, 'destroy'])->name('admin.market.guarantee.destroy');
        });

        //property
        Route::prefix('property')->group(function () {
            Route::get('/', [PropertyController::class, 'index'])->name('admin.market.property.index');
            Route::get('/create', [PropertyController::class, 'create'])->name('admin.market.property.create');
            Route::post('/store', [PropertyController::class, 'store'])->name('admin.market.property.store');
            Route::get('/edit/{categoryAttribute}', [PropertyController::class, 'edit'])->name('admin.market.property.edit');
            Route::put('/update/{categoryAttribute}', [PropertyController::class, 'update'])->name('admin.market.property.update');
            Route::delete('/destroy/{categoryAttribute}', [PropertyController::class, 'destroy'])->name('admin.market.property.destroy');

            //value
            Route::get('{categoryAttribute}/value', [PropertyValueController::class, 'index'])->name('admin.market.property.value.index');
            Route::get('{categoryAttribute}/value/create', [PropertyValueController::class, 'create'])->name('admin.market.property.value.create');
            Route::post('{categoryAttribute}/value/store', [PropertyValueController::class, 'store'])->name('admin.market.property.value.store');
            Route::get('value/{categoryAttribute}/edit/{categoryValue}', [PropertyValueController::class, 'edit'])->name('admin.market.property.value.edit');
            Route::put('value/{categoryAttribute}/update/{categoryValue}', [PropertyValueController::class, 'update'])->name('admin.market.property.value.update');
            Route::delete('value/{categoryAttribute}/destroy/{categoryValue}', [PropertyValueController::class, 'destroy'])->name('admin.market.property.value.destroy');
        });

        //comment
        Route::controller(ProductCommentController::class)->prefix('product-comment')->group(function () {
            Route::get('/', 'index')->name('admin.market.comment.index');
            Route::get('/show/{comment}', 'show')->name('admin.market.comment.show');
            // Route::get('/status/{comment}', 'status')->name('admin.comment.status');
            Route::delete('/destroy/{comment}', 'delete')->name('admin.market.comment.delete');
            Route::get('/approved/{comment}', 'approved')->name('admin.market.comment.approved');
            Route::post('/answer/{comment}', 'answer')->name('admin.market.comment.answer');
        });

        //discount
        Route::prefix('discount')->group(function () {
            //copan
            Route::get('/copan', [DiscountController::class, 'copan'])->name('admin.market.discount.copan');
            Route::get('/copan/create', [DiscountController::class, 'copanCreate'])->name('admin.market.discount.copan.create');
            Route::post('/copan/store', [DiscountController::class, 'copanStore'])->name('admin.market.discount.copan.store');
            Route::get('copan/edit/{copan}', [DiscountController::class, 'copanEdit'])->name('admin.market.discount.copan.edit');
            Route::put('/copan/update/{copan}', [DiscountController::class, 'copanUpdate'])->name('admin.market.discount.copan.update');
            Route::delete('copan/delete/{copan}', [DiscountController::class, 'copanDestroy'])->name('admin.market.discount.copan.delete');

            //common-discount
            Route::get('/common-discount', [DiscountController::class, 'commonDiscount'])->name('admin.market.discount.commonDiscount');
            Route::get('/common-discount/create', [DiscountController::class, 'commonDiscountCreate'])->name('admin.market.discount.commonDiscount.create');
            Route::post('/common-discount/store', [DiscountController::class, 'commonDiscountStore'])->name('admin.market.discount.commonDiscount.store');
            Route::get('/common-discount/edit/{commonDiscount}', [DiscountController::class, 'commonDiscountEdit'])->name('admin.market.discount.commonDiscount.edit');
            Route::put('/common-discount/update/{commonDiscount}', [DiscountController::class, 'commonDiscountUpdate'])->name('admin.market.discount.commonDiscount.update');
            Route::delete('/common-discount/delete/{commonDiscount}', [DiscountController::class, 'commonDiscountDestroy'])->name('admin.market.discount.commonDiscount.delete');
        });


    });


});
