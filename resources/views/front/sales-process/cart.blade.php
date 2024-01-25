@extends('front.layouts.master')

@section('head-tag')
    <title>سبد خرید</title>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .cart-product-selected-color {
            background-color: #000000;
            width: 20px;
            height: 20px;
            display: inline-block;
            border-radius: 70%;
        }
    </style>
@endsection


@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <form id="a-form" action="{{ route('front.sales-process.go-to-checkout') }}" method="post">
                @csrf
                <div class="relative overflow-x-auto rounded-2xl border">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="hidden md:table-header-group text-xs text-gray-700 bg-gray-50">
                            <tr>
                                <th scope="col" class="px-16 py-3">
                                    <span class="sr-only">تصویر</span>
                                </th>
                                <th scope="col" class="md:pr-6 py-3">
                                    نام محصول
                                </th>
                                <th scope="col" class="md:pr-6 py-3">
                                    رنگ
                                </th>
                                <th scope="col" class="md:pr-6 py-3">
                                    گارانتی
                                </th>
                                <th scope="col" class="pr-10 py-3">
                                    تعداد
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    قیمت (هزینه رنگ + گارانتی)
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    تخفیف
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    دستورات
                                </th>
                            </tr>
                        </thead>
                        <tbody class="grid grid-cols-1 sm:grid-cols-2 md:contents gap-5">
                            @auth

                                @php
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp
                                @foreach ($cartItems as $cartItem)
                                    @php
                                        $totalProductPrice += $cartItem->cartItemProductPrice();
                                        $totalDiscount += $cartItem->cartItemProductDiscount();
                                    @endphp

                                    <tr
                                        class="bg-white border-b hover:bg-gray-50 grid grid-cols-1 justify-items-center md:table-row">
                                        <td class="p-4">
                                            <img src="{{ asset($cartItem->product->image['indexArray']['medium']) }}"
                                                class="w-48 md:w-32 max-w-full max-h-full rounded-lg" alt="">
                                        </td>
                                        <td class="md:pr-6 py-4 text-sm opacity-90 text-gray-900">
                                            {{ $cartItem->product->name }}
                                        </td>
                                        <td class="md:pr-6 py-4 text-sm opacity-90 text-gray-900">
                                            <p>
                                                @if (!empty($cartItem->color))
                                                    <span style="background-color: {{ $cartItem->color->color }}"
                                                        class="cart-product-selected-color me-1"></span> <span>
                                                        {{ $cartItem->color->color_name }}</span>
                                                @else
                                                    <span>رنگ منتخب وجود ندارد</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td class="md:pr-6 py-4 text-sm opacity-90 text-gray-900">
                                            @if (!empty($cartItem->guarantee))
                                                {{ $cartItem->guarantee->name }}
                                            @else
                                                ندارد
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="quantity flex items-center">
    
                                                <input
                                                    class="w-12 h-8 mx-2 text-center border focus:outline-none rounded-lg number"
                                                    name="number" type="number" min="1" step="1"
                                                    value="{{ $cartItem->number }}"
                                                    data-product-price={{ $cartItem->cartItemProductPrice() }}
                                                    data-product-discount={{ $cartItem->cartItemProductDiscount() }}
                                                    readonly="readonly">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm opacity-90 text-gray-900">
                                            {{ priceFormat($cartItem->cartItemProductPrice()) }}
                                            تومان
                                        </td>

                                        <td class="px-6 py-4 text-sm opacity-90 text-gray-900">
                                            @if (!empty($cartItem->product->activeAmazingSale()))
                                                {{ priceFormat($cartItem->cartItemProductDiscount()) }} تومان
                                                {{-- {{ PriceFormat($cartItem->product->price * ($cartItem->product->activeAmazingSale()->percentage / 100) ) }}  تومان --}}
                                            @else
                                                ندارد
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <a href="{{ route('front.sales-process.remove-from-cart', $cartItem) }}"
                                                class=" text-red-600">حذف</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endauth

                        </tbody>
                    </table>
                </div>
            </form>

            <div class="border shadow-xl rounded-2xl mx-auto max-w-xl mt-7 flex flex-col gap-y-5 py-5 px-5 md:px-20">
                <div class="flex justify-between">
                    <div>
                        قیمت کالاها ({{$cartItem->count()}}):
                    </div>
                    <div class="flex gap-x-1">
                        <div id="total_product_price">
                            {{ priceFormat($totalProductPrice) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <div>
                        تخفیف کالاها
                    </div>
                    <div class="flex gap-x-1">
                        <div id="total_discount">
                            {{ priceFormat($totalDiscount) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="text-red-600">
                        مجموع نهایی:
                    </div>
                    <div class="flex gap-x-1">
                        <div id="total_price">
                            {{priceFormat($totalProductPrice - $totalDiscount) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center opacity-90 my-5">
                <button type="submit" form="a-form" class="btn btn-danger d-block">تکمیل فرآیند خرید</button>
            </div>
        </div>
    </div>
@endsection


@section('script')
<script>
    $(document).ready(function() {
        bill();

        $('.cart-number').click(function() {
            bill();
        })
    })


    function bill() {
        var total_product_price = 0;
        var total_discount = 0;
        var total_price = 0;

        $('.number').each(function() {
            var productPrice = parseFloat($(this).data('product-price'));
            var productDiscount = parseFloat($(this).data('product-discount'));
            var number = parseFloat($(this).val());

            total_product_price += productPrice * number;
            total_discount += productDiscount * number;
        })

        total_price = total_product_price - total_discount;

        $('#total_product_price').html(toFarsiNumber(total_product_price));
        $('#total_discount').html(toFarsiNumber(total_discount));
        $('#total_price').html(toFarsiNumber(total_price));


        function toFarsiNumber(number) {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }

    }
</script>


@endsection
