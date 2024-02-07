<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct()
    {
            $this->middleware('can:order-show');
    }

    public function newOrders()
    {
		$orders=Order::where('order_status',0)->get();
		foreach($orders as $order){
			$order->order_status=1;
			$order->save();
		}
        $orders->paginate(10);
        return view('admin.market.order.index',compact('orders'));
    }
	
    public function sending()
    {
		$orders=Order::where('delivery_status',1)->paginate(10);
        return view('admin.market.order.index',compact('orders'));
    }
	
    public function unpaid()
    {
		$orders=Order::where('payment_status',0)->paginate();
        return view('admin.market.order.index',compact('orders'));
    }
	
    public function canceled()
    {
		$orders=Order::where('order_status',3)->paginate(10);
        return view('admin.market.order.index',compact('orders'));
    }
	
    public function returned()
    {
		$orders=Order::where('order_status',4)->paginate(10);
        return view('admin.market.order.index',compact('orders'));
    }
	
    public function all()
    {
		$orders=Order::orderBy('created_at','desc')->paginate(10);
        return view('admin.market.order.index',compact('orders'));
    }
	
	
	
    public function showFactor(Order $order)
    {
        return view('admin.market.order.show-factor',compact('order'));
    }    
	
	public function detail(Order $order)
    {
        return view('admin.market.order.detail',compact('order'));
    }
	
    public function changeSendStatus(Order $order)
    {
        switch($order->delivery_status){
			
			case 0:
			$order->delivery_status=1;
			break;
			
			case 1:
			$order->delivery_status=2;
			break;
			
			case 2:
			$order->delivery_status=3;
			break;
			
			default:
			$order->delivery_status=0;
		}
		$order->save();
		return back();
    }
	
    public function changeOrderStatus(Order $order)
    {
		 switch($order->order_status){
			 
			case 1:
			$order->order_status=2;
			break;
			
			case 2:
			$order->order_status=3;
			break;
			
			case 3:
			$order->order_status=4;
			break;		
			
			case 4:
			$order->order_status=5;
			break;		
			
			default:
			$order->order_status=1;
		}
		$order->save();
		return back();
    }
	
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('swal-success','ایتم مورد نظر با موفقیت حذف شد ');
    }}
