@extends('front.layouts.master')

@section('head-tag')
<title>صفحه مورد نظر پیدا نشد</title>
@endsection

@section('content')
<div class="max-w-[1440px] mx-auto px-3">
    <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl  p-3 md:p-5">
      <img class="mx-auto rounded-3xl" src="{{asset('front-assets/image/404/404-error-not-found.png')}}" alt="">
      <div class="opacity-90 text-center mt-7 mb-5 text-lg">
        صفحه مورد نظر پیدا نشد!!!
      </div>
      <div class="flex justify-center items-center mb-5">
        <a class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-xs" href="{{route('front.home')}}">
          صفحه اصلی
        </a>
        <img class="w-5" src="{{asset('front-assets/image/arrow-left.png')}}" alt="">
      </div>
    </div>
  </div>
@endsection