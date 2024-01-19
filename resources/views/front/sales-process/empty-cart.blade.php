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
      <img class="mx-auto max-w-md w-full" src="{{asset('front-assets/image/cartEmpty/1.jpg')}}" alt="">
      <div class="opacity-90 text-center my-7 text-base md:text-lg">
        سبد خرید شما در حال حاضر خالی است!
      </div>
      <div class="flex justify-center items-center mb-5">
        <img class="w-4" src="{{asset('fromt-assets/image/arrow-left.png')}}" alt="">
      </div>
      <a href="{{route('front.home')}}" class="flex justify-center items-center opacity-90">
        <button class="px-7 py-2 text-center text-white bg-red-500 hover:bg-red-600 hover:shadow-lg hover:shadow-red-400 transition align-middle rounded-lg shadow-md text-xs">خانه</button>
      </a>
    </div>
  </div>
@endsection