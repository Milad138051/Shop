@extends('front.layouts.master')

@section('head-tag')
<title>ویرایش حساب</title>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
@endsection


@section('content')
<div class="max-w-[1440px] mx-auto px-3">
    <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
      <div class="flex flex-col md:flex-row gap-5">

        @include('front.layouts.partials.profile-sidebar')

        <div class="md:w-8/12 lg:w-9/12 flex flex-col gap-y-5">
            <div class="border rounded-3xl shadow-lg flex flex-col p-5 gap-y-5">
                <div class="sm:grid grid-cols-2 gap-x-5">
                <form action="{{route('front.profile.update')}}" method="post" id="update-profile" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="mb-4">
                <label for="name" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">نام کاربری</label>
                <input id="name" name="name" type="text" class="text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300" value="{{old('name',auth()->user()->name ?? '-')}}"/>
                @error('name')
                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
            @enderror
              </div>
              <div class="mb-4">
                <label for="first_name" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">نام</label>
                <input id="first_name" name="first_name" type="text" class="text-sm block w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300" value="{{old('first_name',auth()->user()->first_name ?? '-')}}" />
                @error('first_name')
                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
            @enderror
              </div>
              <div class="mb-4">
                <label for="last_name" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">نام خانوادگی</label>
                <input id="last_name" name="last_name" type="text" class="text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300" value="{{old('last_name',auth()->user()->last_name ?? '-')}}">
                @error('last_name')
                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
            @enderror
              </div>

              <div class="flex items-center pt-7 h-16">
                <span class="w-auto ml-2 font-semibold text-xs text-slate-700">
                  تغییر عکس پروفایل
                </span>
                <label for="dropzone-file" class="w-8/12 sm:w-1/3 flex flex-col items-center justify-center border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                  <div class="flex flex-col items-center justify-center p-1">
                    <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                  </div>
                  <input name="profile_photo_path" id="dropzone-file" type="file" class="hidden" />
                  @error('profile_photo_path')
                  <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                      <strong>
                          {{ $message }}
                      </strong>
                  </span>
              @enderror
                </label>
              </div> 
            </form>
            </div>
            <span class="opacity-90">
              <button class="px-7 py-2 text-center text-white bg-blue-500 align-middle border-0 rounded-lg shadow-md text-sm" onclick="document.getElementById('update-profile').submit()">ثبت</button>
              <a href="{{route('front.profile.profile')}}" class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm">لغو</a>
            </span>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection