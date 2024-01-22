@extends('front.layouts.master')

@section('head-tag')
<title>لیست علاقه مندی های شما</title>
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
                  <th scope="col" class="px-6 py-3">
                    قیمت
                  </th>
                  <!-- <th scope="col" class="pr-10 py-3">
                    افزودن به سبدخرید
                  </th> -->
                  <th scope="col" class="px-4 py-3">
                    دستورات
                  </th>
                </tr>
              </thead>
              <tbody class="grid grid-cols-1 sm:grid-cols-2 md:contents gap-5">
                @forelse (auth()->user()->products as $product)
                <tr class="bg-white border-b hover:bg-gray-50 grid grid-cols-1 justify-items-center md:table-row">
                    <td class="p-4">
                      <img src="{{asset($product->image['indexArray']['medium'])}}" class="w-48 md:w-32 max-w-full max-h-full rounded-lg" alt="">
                    </td>
                    <td class="md:pr-6 py-4 text-sm opacity-90 text-gray-900">
                      {{$product->name}}
                    </td>
                    <td class="px-6 py-4 text-sm opacity-90 text-gray-900">
                      {{PriceFormat($product->price)}} تومان
                    </td>
                    <td class="px-2 py-4">
                      <a href="{{route('front.profile.favorites.delete',$product)}}" class="text-red-600">حذف</a>
                      <a href="{{route('front.market.product',$product)}}" class="text-white bg-green-500 hover:bg-green-600 transition px-2 py-1 shadow-lg rounded-md mr-3">مشاهده</a>
                    </td>
                  </tr>
                  @empty
                  <div class="md:w-8/12 lg:w-9/12 flex flex-col gap-y-5">
                    <div class="border rounded-3xl shadow-lg flex flex-col p-5 gap-y-5">
                        ایتمی یافت نشد
                    </div>
                </div>                    
                @endforelse


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection