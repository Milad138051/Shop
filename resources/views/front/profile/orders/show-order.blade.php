@extends('front.layouts.master')


@section('head-tag')
<title>سفارش های من</title>

<style>
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
    <div class="flex flex-col md:flex-row gap-5">

      @include('front.layouts.partials.profile-sidebar')

      <div class="md:w-8/12 lg:w-9/12">
        <div class="rounded-xl">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="hidden md:table-header-group text-xs text-gray-700 bg-gray-50">
              <tr>
                <th scope="col" class="px-16 py-3">
                  <span class="sr-only">تصویر</span>
                </th>
                <th scope="col" class="md:pr-6 py-3">
                  نام محصول
                </th>
                <th scope="col" class="pr-10 py-3">
                  تعداد
                </th>
                <th scope="col" class="pr-10 py-3">
                  رنگ
                </th>
                <th scope="col" class="pr-10 py-3">
                  گارانتی
                </th>
                <th scope="col" class="px-6 py-3">
                  قیمت
                </th>
                <th scope="col" class="px-6 py-3">
                     قیمت نهایی (شامل هزینه رنگ + گارانتی)
                </th>
              </tr>
            </thead>
            <tbody class="grid grid-cols-1 sm:grid-cols-2 md:contents gap-5">
             @foreach ($order->orderItems as $item)
             <tr class="bg-white border-b hover:bg-gray-50 grid grid-cols-1 justify-items-center md:table-row">
              <td class="p-4">
                <img src="{{asset($item->singleProduct->image['indexArray']['medium'])}}" class="w-48 md:w-32 max-w-full max-h-full rounded-lg" alt="">
              </td>
              <td class="md:pr-6 py-4 text-sm opacity-90 text-gray-900">
                {{$item->singleProduct->name ?? '-' }}
              </td>
              <td class="px-6 py-4">
                <div class="quantity flex items-center">
                  <input class="w-12 h-8 mx-2 text-center border focus:outline-none rounded-lg" type="number" value="{{$item->number}}" readonly>
                </div>
              </td>
              <td class="px-6 py-4">
                <span style="background-color: {{ $item->color->color }}"
                  class="cart-product-selected-color me-1"></span> <span>
                  {{ $item->color->color_name }}
                </span>
              </td>
              <td class="px-6 py-4">

                {{$item->guarantee->name}}
              </td>
              <td class="px-6 py-4 text-sm opacity-90 text-gray-900">
               {{priceFormat($item->singleProduct->price * $item->number ?? '-')}} تومان
              </td>
              <td class="px-6 py-4 text-sm opacity-90 text-gray-900">
                {{ priceFormat($item->final_total_price ?? '-')}} تومان
              </td>
            </tr>               
             @endforeach
            </tbody>
          </table>


          <div class="border shadow-xl rounded-2xl mx-auto max-w-xl mt-7 flex flex-col gap-y-5 py-5 px-5 md:px-20 text-sm">
            <div class="flex justify-between">
              <div>
                هزینه پست:
              </div>
              <div class="flex gap-x-1">
                <div>
                  {{priceFormat($order->delivery_amount)}}
                </div>
                <div>
                  تومان
                </div>
              </div>
            </div>
            @if($order->order_total_products_discount_amount)
            <div class="flex justify-between">
              <div>
                سود شما از این خرید:
              </div>
              <div class="flex gap-x-1">
                <div>
                 {{PriceFormat($order->order_total_products_discount_amount ?? '-')}}
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
                  {{priceFormat(($order->order_final_amount))}}
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
                {{$order->address->address}}-پلاک {{$order->address->no ?? '-'}}- واحد{{$order->address->unit ?? '-'}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection