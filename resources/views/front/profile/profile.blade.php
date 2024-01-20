@extends('front.layouts.master')

@section('head-tag')
<title>پروفایل</title>
@endsection


@section('content')

<div class="max-w-[1440px] mx-auto px-3">
    <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
      <div class="flex flex-col md:flex-row gap-5">

        @include('front.layouts.partials.profile-sidebar')

        <div class="md:w-8/12 lg:w-9/12">
          <div class="border rounded-3xl shadow-lg flex flex-col p-5 gap-y-5">
                {{-- <a class="d-flex justify-content-end btn btn-link btn-sm text-info text-decoration-none mx-1" data-bs-toggle="modal"
                    data-bs-target="#edit-profile"><i class="fa fa-edit px-1"></i>ویرایش حساب</a> --}}

            <div class="border-b pb-3">اطلاعات شخصی</div>
            <div class="flex border-b pb-2">
              <div class="w-1/2">
                <div class="text-xs opacity-80 mb-1">
                  نام کاربری
                </div>
                <div class="text-sm opacity-90">
                  {{auth()->user()->name}}
                </div>
              </div>
              <div class="w-1/2">
                <div class="text-xs opacity-80 mb-1">
                  نام 
                </div>
                <div class="text-sm opacity-90">
                  {{auth()->user()->first_name}}
                </div>
              </div>
              <div class="w-1/2">
                <div class="text-xs opacity-80 mb-1">
                  نام خانوادگی
                </div>
                <div class="text-sm opacity-90">
                  {{auth()->user()->last_name}}
                </div>
              </div>
            </div>
            <div class="flex border-b pb-2">
              <div class="w-1/2">
                <div class="text-xs opacity-80 mb-1">
                  شماره تلفن همراه:
                </div>
                <div class="text-sm opacity-90">
                  {{auth()->user()->mobile ??'-'}}
                </div>
              </div>
              <div class="w-1/2">
                <div class="text-xs opacity-80 mb-1">
                  ایمیل:
                </div>
                <div class="text-sm opacity-90">
                  {{auth()->user()->email ?? '-'}}
                </div>
              </div>
              <div class="w-1/2">
                <div class="text-xs opacity-80 mb-1">
                  کدملی:
                </div>
                <div class="text-sm opacity-90">
                  -
                </div>
              </div>
            </div>
            <div class="flex border-b pb-2">
              <div class="w-1/2">
                <div class="text-xs opacity-80 mb-1">
                  تاریخ عضویت:
                </div>
                <div class="text-sm opacity-90">
                  {{jalaliDate(auth()->user()->created_at)}}
                </div>
              </div>
              <div class="w-1/2">
                <div class="text-xs opacity-80 mb-1">
                  احراز هویت:
                </div>
                <div class="text-sm opacity-90">
                  @if (auth()->user()->email_verified_at or auth()->user()->mobile_verified_at!==null)
                      بله
                      @else
                      خیر
                  @endif
                </div>
              </div>
            </div>
            <span class="opacity-90">
              <a href="{{route('front.profile.update-view')}}" class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm">ویرایش اطلاعات</a>
            </span>
          </div>
        
        </div>

      </div>
    </div>
  </div>
@endsection