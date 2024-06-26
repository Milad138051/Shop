<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Payment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:payment-show');

    }
    public function index()
    {
        $payments = Payment::orderBy('id','desc')->paginate(10)->withQueryString();
        return view('admin.market.payment.index', compact('payments'));
    }
    public function online()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\Market\OnlinePayment')->get();
        $payments->paginate(10)->withQueryString();
        return view('admin.market.payment.index', compact('payments'));
    }
    public function cash()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\Market\CashPayment')->get();
        $payments->paginate(10)->withQueryString();
        return view('admin.market.payment.index', compact('payments'));
    }
    // public function confirm()
    // {
    //     return view('admin.market.payment.index');
    // }
    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییر با موفقیت اعمال شد');
    }
    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییر با موفقیت اعمال شد');
    }
    public function paid(Payment $payment)
    {
        $payment->status = 1;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییر با موفقیت اعمال شد');
    }
    public function notPaid(Payment $payment)
    {
        $payment->status = 0;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییر با موفقیت اعمال شد');
    }

    public function show(Payment $payment)
    {
        return view('admin.market.payment.show', compact('payment'));
    }
}
