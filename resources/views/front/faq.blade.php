@extends('front.layouts.master')

@section('head-tag')
<title>سوالات متداول</title>
@endsection


@section('content')
<div class="max-w-[1440px] mx-auto px-3">
    <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
      <div class="grid place-items-center">
        <div class="w-full md:w-11/12 mx-auto rounded">
          <div class="bg-white px-2 py-5 md:p-10">
            <h3 class="text-lg font-medium text-gray-800">سوالات پرتکرار</h3>
            <p class="text-sm font-light text-gray-600 my-3">
              اگه سوال مورد نظرتون رو پیدا نکردید به 
              <a class="hover:text-red-600 text-red-500 transition" href="{{route('front.contact-us')}}">پشتیبانی</a>
              پیام بدید
            </p>
            @foreach ($faqs as $faq)
            <div>
                <!-- header -->
                <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-auto min-h-[64px] py-2 sm:h-16 border rounded-xl my-2">
                  <p class="opacity-80">{{$faq->question}}</p>
                </div>
                <!-- Content -->
                <div class="accordion-content transition-all px-5 pt-0 overflow-hidden max-h-0">
                  <p class="leading-6 font-light pl-9 text-justify opacity-70 pt-2">
                  {{$faq->answer}}
                  </p>
                </div>
              </div>                
            @endforeach


          </div>
        </div>
    </div>
    </div>
  </div>
@endsection


@section('script')
<script src="{{asset('front-assets/js/faq.js')}}"></script>

@endsection