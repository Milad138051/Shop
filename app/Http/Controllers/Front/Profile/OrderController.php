<?php

namespace App\Http\Controllers\Front\Profile;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders=auth()->user()->orders()->orderBy('id','desc')->get();		
        return view('front.profile.orders.orders',compact('orders'));
    }

    public function showOrder(Order $order)
	{
		return view('front.profile.orders.show-order',compact('order'));
	}
}
