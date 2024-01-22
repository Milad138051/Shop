<?php

namespace App\Providers;

use App\Models\Market\CartItem;
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

        Auth::loginUsingId(2);
        //  Auth::logout();
        // session()->flush();
        // Model::shouldBeStrict();
        // dd(auth()->user());


        view()->composer('front.layouts.header',function($view){
            if(Auth::check()){
                $cartItems=CartItem::where('user_id',Auth::user()->id)->get();
                $view->with('cartItems',$cartItems);
            }
		});

    }
}
