<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use App\Models\Market\CashPayment;
use App\Models\Market\Category;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Product;
use App\Models\User;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Payment;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index(){
        $allUsers=User::where('activation',1)->get()->count();
        $adminUsers=User::where('activation',1)->where('user_type',1)->get()->count();
        $normalUsers=User::where('activation',1)->where('user_type',0)->get()->count();
        $allOrders=Order::all()->count();
        $inProgressOrders=Order::where('order_status',1)->count();
        $submitedOrders=Order::where('order_status',2)->count();
        $allPayments=Payment::all()->count();
        $onlinePayments=OnlinePayment::all()->count();
        $cashPayments=CashPayment::all()->count();
        $allProducts=Product::all()->count();
        $allCategoriesProducts=Category::all()->count();
        $allPosts=Post::all()->count();
        $allCategoriesPost=PostCategory::all()->count();
        $latestOrders=Order::latest()->take(10)->get();
        $latestUsers=User::latest()->take(10)->get();
        $latestProducts=Product::latest()->take(10)->get();

        
        return view('admin.index',compact('allUsers','adminUsers','normalUsers','allOrders','inProgressOrders','submitedOrders','allPayments','onlinePayments','cashPayments','allProducts','allCategoriesProducts','allPosts','allCategoriesPost','latestOrders','latestUsers','latestProducts'));
    }
}
