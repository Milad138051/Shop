@extends('front.layouts.master')

@section('head-tag')
    <title>سبد خرید</title>
@endsection


@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <li>{{ $error }}</li>
                        </div>
                    @endforeach
                </ul>
            @endif

            @if (session('copan'))
                <div class="alert alert-success">
                    {{ session('copan') }}
                </div>
            @endif
            <form action="{{ route('front.sales-process.copanDiscount') }}" method="POST">
                @csrf
                <div class="flex flex-col md:flex-row gap-y-3 items-center gap-x-2 mb-7">
                    <div class="text-sm opacity-80">
                        کد تخفیف دارید؟ وارد کنید:
                    </div>
                    <div>
                        <input name="copan" class="border border-gray-400 outline-none focus:border-red-300 rounded-lg p-1"
                            type="text">
                    </div>
                    <div>
                        <button class="bg-red-600 text-white px-3 py-1 rounded-lg shadow-md">
                            تایید
                        </button>
                    </div>
                </div>
            </form>



            <div>
                <div class="text-lg md:text-xl opacity-70 mb-3">
                    انتخاب نوع پرداخت
                </div>
                <form action="{{ route('front.sales-process.choose-address-and-delivery') }}" id="a-form">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 px-5 md:px-20">
                        <div class="mb-4">
                            <label for="payment" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">روش
                                پرداخت:</label>
                            <select name="payment_type" id="payment" required
                                class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300">
                                <option value="0">
                                    روش انلاین
                                </option>
                                <option value="1">
                                    روش پرداخت در محل
                                </option>
                            </select>
                            @error('delivery_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>


            <div class="border shadow-xl rounded-2xl mx-auto max-w-xl mt-7 flex flex-col gap-y-5 py-5 px-5 md:px-20">
                @php
                    $totalProductPrice = 0;
                    $totalDiscount = 0;
                @endphp

                @foreach ($cartItems as $cartItem)
                    @php
                        $totalProductPrice += $cartItem->cartItemProductPrice() * $cartItem->number;
                        $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->number;
                    @endphp
                @endforeach
                <div class="flex justify-between">
                    <div>
                        قیمت کالاها:
                    </div>
                    <div class="flex gap-x-1">
                        <div>
                            {{ priceFormat($totalProductPrice) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div>
                        هزینه پست:
                    </div>
                    <div class="flex gap-x-1">
                        <div>
                            {{ priceFormat($order->delivery_amount) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>
                @if ($totalDiscount !== 0)
                    <div class="flex justify-between">
                        <div>
                            تخفیف کالاها
                        </div>
                        <div class="flex gap-x-1">
                            <div>
                                {{ priceFormat($totalDiscount) }}
                            </div>
                            <div>
                                تومان
                            </div>
                        </div>
                    </div>
                @endif
                @if ($order->copan != null)
                    <div class="flex justify-between">
                        <div>
                            میزان تخفیف کد تخفیف

                        </div>
                        <div class="flex gap-x-1">
                            <div>
                                {{ priceFormat($order->copan->amount) }}
                            </div>
                            <div>
                                @if ($order->copan->amount_type == 0)
                                    درصدی
                                @elseif($order->copan->amount_type == 1)
                                    تومان
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if ($order->commonDiscount != null)
                    <div class="flex justify-between">
                        <div>
                            میزان تخفیف عمومی

                        </div>
                        <div class="flex gap-x-1">
                            <div>
                                {{ priceFormat($order->commonDiscount->percentage) }} درصد
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            میزان حداکثر تخفیف عمومی

                        </div>
                        <div class="flex gap-x-1">
                            <div>
                                {{ priceFormat($order->commonDiscount->discount_ceiling) }} تومان
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            حداقل موجودی سبد خرید

                        </div>
                        <div class="flex gap-x-1">
                            <div>
                                {{ priceFormat($order->commonDiscount->minimal_order_amount) }} تومان
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex justify-between">
                    <div class="text-red-600">
                        مجموع نهایی:
                    </div>
                    <div class="flex gap-x-1">
                        <div>
                            {{ priceFormat($order->order_final_amount) }}

                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center opacity-90 my-5">
                <button
                    class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm"
                    form="a-form" type="submit">ثبت
                    و پرداخت</button>
            </div>
        </div>
    </div>
@endsection
