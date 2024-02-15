<?php

namespace App\Providers;

use App\Models\Market\CartItem;
use App\Models\Market\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Auth::loginUsingId(1);
        // Auth::loginUsingId();
        //  Auth::logout();
        // session()->flush();
        // Model::shouldBeStrict();
        // dd(auth()->user());

        // Paginator::defaultView('front.layouts.my-paginator');
        // Paginator::defaultView('bootstrap-5');


        

        view()->composer('front.layouts.header',function($view){
            if(Auth::check()){
                $cartItems=CartItem::where('user_id',Auth::user()->id)->get();
                $view->with('cartItems',$cartItems);
            }
            // else{
            //     $cartItems=collect();
            //     $view->with('cartItems',$cartItems);
            // }
		});
        view()->composer('front.layouts.header',function($view){
                $categories=Category::where('show_in_menu',1)->where('parent_id',null)->where('status',1)->get();
                $view->with('categories',$categories);
		});

    }
}
