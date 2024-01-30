<?php

namespace App\Http\Controllers\Front\SalesProcess;

use App\Models\Market\Copan;
use App\Models\Market\Order;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use App\Models\Market\Payment;
use Shetabit\Multipay\Invoice;
use App\Models\Market\CartItem;
use App\Models\Market\OrderItem;
use App\Models\Market\CashPayment;
use App\Http\Controllers\Controller;
use App\Models\Market\OnlinePayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class PaymentController extends Controller
{
    public function payment()
    {
        $user = auth()->user();
        $order = Order::where('user_id', $user->id)->where('order_status', 1)->first();
        if ($order->orderItems->count() > 0) {
            foreach ($order->orderItems as $item) {
                $item->delete();
            }
        }
        if ($order->copan_id !== null) {
            $order->update([
                'copan_id' => null,
                'order_copan_discount_amount' => null,
            ]);
        }
        $cartItems = CartItem::where('user_id', $user->id)->get();
        return view('front.sales-process.payment', compact('cartItems', 'order'));
    }

    public function copanDiscount(Request $request)
    {
        $request->validate(
            ['copan' => 'required']
        );
        $copan = Copan::where([['code', $request->copan], ['status', 1], ['end_date', '>', now()], ['start_date', '<', now()]])->first();
        if ($copan != null) {
            // چک میکنیم که اگه کد خصوصی بود فقط برا همون کاربر کارکنه
            if ($copan->user_id != null) {
                $copan = Copan::where([['code', $request->copan], ['status', 1], ['end_date', '>', now()], ['start_date', '<', now()], ['user_id', auth()->user()->id]])->first();

                //اگه همچین کدی پیدا نکرد که شاید ممکنه  بخاطر این باشه که اصلا همچین کدی وجود نداره یا اگه داره برا یه کاربر دیگه تعریف شده
                if ($copan == null) {
                    return redirect()->back()->withErrors(['copan' => ['درخواست نامعتبر']]);
                }
            }

            $order = Order::where('user_id', Auth::user()->id)->where('order_status', 1)->where('copan_id', null)->first();
            // dd($order);


            //میایم سفارشی از کاربر رو که در حال انجامه رو پیدا میکنیم و چک میکنیم قبلا روش کد تخفیف اعمال نکرده باشه 
            if ($order) {
                //اگه کد تخفیف از نوع درصدی بود
                if ($copan->amount_type == 0) {
                    $copanDiscountAmount = $order->order_final_amount * ($copan->amount / 100);

                    // چک میکنیم که میزان تخفیف از سقف تخفیف مشخص شده برا این کد بیشتر نشه
                    if ($copanDiscountAmount > $copan->discount_ceiling) {
                        $copanDiscountAmount = $copan->discount_ceiling;
                    }
                } else {

                    // اگه کد تخفیف از نوع عددی باشه
                    $copanDiscountAmount = $copan->amount;
                }

                // میزان تخفیف . چه عددی چه درصدی رو از قیمت سفارش کاربر کم میکنیم
                $order->order_final_amount = $order->order_final_amount - $copanDiscountAmount;
                // dd($copanDiscountAmount);
                // dd($order->order_final_amount);

                //میزان تخفیف گرفته شده از کد تخفیف رو جمع میکنیم با بقیه تخفیفاتی که ممکنه کاربر گرفته باشه مثل تخفیف عمومی و تخفیف شگفت انگیز
                $finalDiscount = $order->order_total_products_discount_amount + $copanDiscountAmount;

                // در اخرم سفارش کاربر رو با اطلاعات جدید اپدیت میکنیم
                // $order->update([
                //      'copan_id' => $copan->id,
                //      'copan_object'=>$copan,
                //      'order_copan_discount_amount' => $copanDiscountAmount, 
                //      'order_total_products_discount_amount' => $finalDiscount
                //     ]);
                $order->copan_id=$copan->id;
                $order->copan_object=$copan;
                $order->order_copan_discount_amount=$copanDiscountAmount;
                $order->order_total_products_discount_amount=$finalDiscount;
                $order->update();
                return redirect()->back()->with(['copan' => 'کد تخفیف با موفقیت اعمال شد']);
            } else {
                return redirect()->back()->withErrors(['copan' => ['درخواست نامعتبر']]);
            }
        } else {
            return redirect()->back()->withErrors(['copan' => ['کد تخفیف اشتباه است']]);
        }

    }

    public function paymentSubmit(Request $request)
    {

        $request->validate(
            ['payment_type' => 'required']
        );

        $order = Order::where('user_id', auth()->user()->id)->where('order_status', 1)->first();
        $cash_receiver = null;

        switch ($request->payment_type) {

            case '0':
                $targetModel = OnlinePayment::class;
                $type = 0;
                // $paymentType=0;
                break;
            case '1':
                $targetModel = CashPayment::class;
                $type = 1;
                // $paymentType=1;
                $cash_receiver = $request->cash_receiver ? $request->cash_receiver : null;
                break;

            default:
                return redirect()->back()->withErrors(
                    ['error' => 'خطا']
                );
        }

        //create online or cash payment
        $paymented = $targetModel::create([
            'amount' => $order->order_final_amount,
            'user_id' => auth()->user()->id,
            'pay_date' => now(),
            // 'cash_receiver'=>$cash_receiver,
            'cash_receiver' => $order->address->recipient_name,
            'status' => 1,
            'order_id' => $order->id,
        ]);

        //create payment
        $payment = Payment::create([
            'amount' => $order->order_final_amount,
            'user_id' => auth()->user()->id,
            'pay_date' => now(),
            'type' => $type,
            // 'type'=>$paymentType,
            'paymentable_id' => $paymented->id,
            'paymentable_type' => $targetModel,
            'status' => 1
        ]);

        //online
        if ($request->payment_type == 0) {
            $order->update(['order_status' => 1, 'payment_type' => $type]);
            session([
                'amount' => strval($order->order_final_amount),
                'order_id' => strval($order->id),
                'online_payment_id' => $paymented->id,
            ]);

            $invoice = (new Invoice)->amount($order->order_final_amount);
            return ShetabitPayment::purchase($invoice, function ($driver, $transactionId) use ($paymented) {
                $paymented->update(['transaction_id' => $transactionId]);
            })->pay()->render();
        }
        //cash
        if ($request->payment_type == 1) {
            $order->update(['order_status' => 2, 'payment_type' => $type, 'payment_status' => 0]);
            $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product' => $cartItem->product,
                    'amazing_sale_id' => $cartItem->product->activeAmazingSale()->id ?? null,
                    'amazing_sale_object' => $cartItem->product->activeAmazingSale() ?? null,
                    'amazing_sale_discount_amount' => empty($cartItem->product->activeAmazingSale()) ? 0 : $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSale()->percentage / 100),
                    'number' => $cartItem->number,
                    'final_product_price' => empty($cartItem->product->activeAmazingSale()) ? $cartItem->cartItemProductPrice() : ($cartItem->cartItemProductPrice() - $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSale()->percentage / 100)),
                    'final_total_price' => $cartItem->cartItemFinalPrice(),
                    'color_id' => $cartItem->color_id,
                    'guarantee_id' => $cartItem->guarantee_id,
                ]);


                $product = Product::find($cartItem->product_id);
                $product->update([
                    'marketable_number' => $product->marketable_number - $cartItem->number,
                ]);
                $cartItem->delete();
            }
            return redirect()->route('cart.callback', $order);
        }
    }

    public function verifyPayment()
    {
        $total_amount = intval(session()->get('amount'));
        $order_id = intval(session()->get('order_id'));
        $online_payment_id = intval(session()->get('online_payment_id'));
        $onlinePayment = OnlinePayment::find($online_payment_id);
        $transaction_id = $onlinePayment->transaction_id;

        $order = Order::find($order_id);

        try {
            ShetabitPayment::amount($total_amount)->transactionId($transaction_id)->verify();
            $order->update([
                'order_status' => 2,
                'payment_status' => 1,
                'delivery_status' => 1
            ]);
            $onlinePayment->update([
                'user_id' => auth()->user()->id,
                'gatetway' => 'zibal',
                'amount' => $total_amount,
                'order_id' => $order->id,
            ]);
            $this->afterPayment($order);
            return redirect()->route('cart.callback', $order);
        } catch (InvalidPaymentException $exception) {

            // dd($exception->getMessage());
            $order->update([
                'order_status' => 1,
                'payment_status' => 0
            ]);

            $this->afterPayment($order);
            session()->forget(['transaction_id', 'amount', 'order_id', 'online_payment_id', 'gateway']);

            return redirect()->route('cart.callback', $order);
        }
    }


    public function callback(Order $order)
    {
        return view('front.sales-process.callback-payment', compact('order'));
    }



    public function afterPayment($order)
    {
        $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
        //success
        if ($order->order_status == '2') {
            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem->product_id);
                $product->update([
                    'marketable_number' => $product->marketable_number - $cartItem->number,
                    'sold_number'=> $product->sold_number + $cartItem->number
                ]);
            }
            $this->createOrderItems($cartItems, $order);
            $this->clearCart($cartItems);
        }
        //falied
        elseif ($order->order_status == '1') {
            $this->createOrderItems($cartItems, $order);
        }
    }

    public function clearCart($cartItems)
    {
        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }
    }


    public function createOrderItems($cartItems, $order)
    {
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product' => $cartItem->product,
                'amazing_sale_id' => $cartItem->product->activeAmazingSale()->id ?? null,
                'amazing_sale_object' => $cartItem->product->activeAmazingSale() ?? null,
                'amazing_sale_discount_amount' => empty($cartItem->product->activeAmazingSale()) ? 0 : $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSale()->percentage / 100),
                'number' => $cartItem->number,
                'final_product_price' => empty($cartItem->product->activeAmazingSale()) ? $cartItem->cartItemProductPrice() : ($cartItem->cartItemProductPrice() - $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSale()->percentage / 100)),
                'final_total_price' => $cartItem->cartItemFinalPrice(),
                'color_id' => $cartItem->color_id,
                'guarantee_id' => $cartItem->guarantee_id,
            ]);
        }
    }

}
