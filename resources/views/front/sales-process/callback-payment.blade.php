@extends('front.layouts.master')

@section('head-tag')
    <title>
        @if ($order->order_status == 2)
            پرداخت موفق
        @else
            پرداخت ناموفق
        @endif
    </title>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <div class="mb-2">
                <div
                    @if ($order->order_status == 2) class="text-xl text-green-700 opacity-90 mb-3" @else class="text-xl text-red-700 opacity-90 mb-3" @endif>
                    @if ($order->order_status == 2)
                        پرداخت با موفقیت انجام شد
                    @else
                        پرداخت با موفقیت انجام نشد
                    @endif
                </div>
                <div class="text-sm opacity-70">
                    @if ($order->order_status == 2)
                        از انتخاب شما سپاسگزاریم.
                    @else
                        چنانچه این فرایند مبلغی از حساب شما کسر کرده است،طی 36 ساعت آینده به حساب شما باز میگردد .
                    @endif
                </div>
            </div>
            <div class="bg-gray-50 shadow-md rounded-xl px-5 py-4 my-3 grid grid-cols-1 md:grid-cols-2 gap-y-10">
                <div class="grid gap-4">
                    <div class="opacity-90 text-sm">
                        جزئیات پرداخت :
                    </div>
                    {{-- <div class="flex text-xs opacity-80">
            <div>
              کد پیگیری محصول:
            </div>
            <div>
              651984891819
            </div>
          </div> --}}
                    <div class="flex text-xs opacity-80">
                        <div>
                            تاریخ:
                        </div>
                        <div>
                            {{ jalaliDate($order->created_at) }}
                        </div>
                    </div>
                    <div class="flex text-xs opacity-80">
                        <div>
                            قیمت نهایی:
                        </div>
                        <div>
                            {{ priceFormat($order->order_final_amount) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>
                <div class="grid gap-4">
                    <div class="opacity-90 text-sm">
                        جزئیات آدرس:
                    </div>
                    <div class="opacity-80 text-xs">
                        {{ $order->address->address }}-پلاک {{ $order->address->no ?? '-' }}-
                        واحد{{ $order->address->unit ?? '-' }}
                    </div>
                    <div class="flex text-xs opacity-80">
                        <div>
                            شماره تلفن:
                        </div>
                        <div>
                            {{ $order->address->mobile }}
                        </div>
                    </div>
                    <div class="flex text-xs opacity-80">
                        <div>
                            کد پستی:
                        </div>
                        <div>
                            {{ $order->address->postal_code }}
                        </div>
                    </div>
                </div>
            </div>


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
                        </tr>
                    </thead>
                    <tbody class="grid grid-cols-1 sm:grid-cols-2 md:contents gap-5">
                        @foreach ($order->orderItems as $item)
                            <tr
                                class="bg-white border-b hover:bg-gray-50 grid grid-cols-1 justify-items-center md:table-row">
                                <td class="p-4">
                                    <img src="{{ asset($item->singleProduct->image['indexArray']['medium']) }}"
                                        class="w-48 md:w-32 max-w-full max-h-full rounded-lg" alt="">
                                </td>
                                <td class="md:pr-6 py-4 text-sm opacity-90 text-gray-900">
                                    {{ $item->singleProduct->name }}
                                </td>
                                <td class="md:pr-6 py-4 text-sm opacity-90 text-gray-900">
                                    <p>
                                        <span style="background-color: {{ $item->color->color }}"
                                            class="cart-product-selected-color me-1"></span> <span>
                                            {{ $item->color->color_name }}</span>
                                    </p>
                                </td>
                                <td class="md:pr-6 py-4 text-sm opacity-90 text-gray-900">
                                    {{ $item->guarantee->name }}

                                </td>
                                <td class="px-6 py-4">
                                    <div class="quantity flex items-center">

                                        <input class="w-12 h-8 mx-2 text-center border focus:outline-none rounded-lg number"
                                            name="number" type="number" min="1" step="1"
                                            value="{{ $item->number }}" readonly="readonly">
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm opacity-90 text-gray-900">
                                  {{ priceFormat($item->final_total_price ?? '-')}} 
                                  تومان
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div
                class="border shadow-xl rounded-2xl mx-auto max-w-xl mt-7 flex flex-col gap-y-5 py-5 px-5 md:px-20 text-sm">
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
                @if ($order->order_total_products_discount_amount)
                    <div class="flex justify-between">
                        <div>
                            سود شما از این خرید:
                        </div>
                        <div class="flex gap-x-1">
                            <div>
                                {{ PriceFormat($order->order_total_products_discount_amount ?? '-') }}
                            </div>
                            <div>
                                تومان
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
                <div class="flex justify-between">
                    <div class="ml-2">
                        آدرس ارسال شده:
                    </div>
                    <div>
                        {{ $order->address->address }}-پلاک {{ $order->address->no ?? '-' }}-
                        واحد{{ $order->address->unit ?? '-' }}
                    </div>
                </div>
            </div>
            <span class="flex justify-center items-center opacity-90 my-5">
                <a href="{{ route('front.home') }}"
                    class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-xs">صفحه
                    اصلی</a>
            </span>
        </div>
    </div>
@endsection
