<?php

namespace App\Http\Controllers\Front\SalesProcess;

use App\Models\Address;
use App\Models\Province;
use App\Models\Market\Copan;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Models\Market\Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Market\CommonDiscount;
use App\Http\Requests\Front\SalesProcess\ChooseAddressAndDeliveryRequest;

class CheckoutController extends Controller
{


    public function addressAndDelivery()
	{		
	//nazarim useri ke to sabadesh hich mahsoli nadare , biad to address page
        $user = Auth::user();
		$cartItems=CartItem::where('user_id',$user->id)->get();
		$addresses=Address::where('user_id',auth()->user()->id)->get();
		$deliveryMethods=Delivery::where('status',1)->get();
        // dd($deliveryMethods);
		if(empty(CartItem::where('user_id',$user->id)->count()))
		{
            return redirect()->route('front.sales-process.cart');
		}
		return view('front.sales-process.checkout',compact('cartItems','addresses','deliveryMethods'));
	}

    public function chooseAddressAndDelivery(ChooseAddressAndDeliveryRequest $request)
	{
        $user = auth()->user();
        $inputs = $request->all();
        // dd($inputs);
		
        //calc price
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $totalProductPrice = 0;
        $totalDiscount = 0;
        $totalFinalPrice = 0;
        $totalFinalDiscountPriceWithNumbers = 0;
        foreach ($cartItems as $cartItem)
        {
            $totalProductPrice += $cartItem->cartItemProductPrice();
            $totalDiscount += $cartItem->cartItemProductDiscount();
            $totalFinalPrice += $cartItem->cartItemFinalPrice();
            $totalFinalDiscountPriceWithNumbers += $cartItem->cartItemFinalDiscount();
        }

        //commonDiscount
        $commonDiscount = CommonDiscount::where([['status', 1], ['end_date', '>', now()], ['start_date', '<', now()]])->first();
        if($commonDiscount)
        {
             $commonPercentageDiscountAmount = $totalFinalPrice * ($commonDiscount->percentage / 100);
			 
             if($commonPercentageDiscountAmount > $commonDiscount->discount_ceiling)
             {
                $commonPercentageDiscountAmount = $commonDiscount->discount_ceiling;
             }
             if($commonDiscount != null and $totalFinalPrice >= $commonDiscount->minimal_order_amount)
             {
                $finalPrice = $totalFinalPrice - $commonPercentageDiscountAmount;
             }
             else{
                $finalPrice = $totalFinalPrice;
             }
        }
        else{
            $commonPercentageDiscountAmount = null;
			$finalPrice=$totalFinalPrice;
        }

        $delivery=Delivery::find($request->delivery_id);
        $address=Address::find($request->address_id);
		
        $inputs['user_id'] = $user->id;
        $inputs['delivery_id'] = $delivery->id;
        $inputs['delivery_amount'] = $delivery->amount;
        $inputs['delivery_object'] = $delivery;
        $inputs['order_final_amount'] = $finalPrice + $delivery->amount;
        $inputs['address_object'] = $address;
		if($commonDiscount)
		{
        $inputs['common_discount_id'] = $commonDiscount->id;
		}
        $inputs['order_discount_amount'] = $totalFinalDiscountPriceWithNumbers;
        $inputs['order_common_discount_amount'] = $commonPercentageDiscountAmount;
        // dd($inputs);
        $inputs['order_total_products_discount_amount'] = $inputs['order_discount_amount'] + $inputs['order_common_discount_amount'];
        Order::updateOrCreate(
            ['user_id' => $user->id, 'order_status' => 1],
            $inputs
        );

        return redirect()->route('front.sales-process.payment');
	}
}
