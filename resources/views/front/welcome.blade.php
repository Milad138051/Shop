<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>خوش آمدید</title>

  <link rel="stylesheet" href="{{asset('front-assets/css/output.css')}}" />
  <link rel="stylesheet" href="{{asset('front-assets/css/font.css')}}">

</head>
<body class="bg-gray-50">
  <div class="flex justify-center items-center text-right h-screen w-96 mx-auto">
<div class="shadow-xl rounded-2xl p-8 bg-white min-w-full">
    <div class="mb-2">
      <a href="{{route('front.home')}}">
        <img src="{{asset('front-assets/image/logo.png')}}" alt="" class="w-36 mx-auto">
      </a>
    </div>
    <div class="opacity-80 text-lg my-5 text-center">
       به ایران مارکت خوش آمدید
    </div>
    <div class="text-xs text-center opacity-70 mb-2">
      با تکمیل حساب کاربری به کلیه امکانات دسترسی داشته باشید
    </div>
    <div class="text-center mt-5 mb-3">
      <a class="bg-red-500 hover:bg-red-600 transition text-white opacity-80 rounded-2xl w-full py-2 mb-5" type="submit">
        تکمیل حساب کاربری
      </a>
      <div class="flex justify-center items-center">
        <a class="border-b-2 border-red-500 hover:text-red-600 transition" href="{{route('front.home')}}">
          صفحه اصلی
        </a>
        <img class="w-5" src="{{asset('front-assets/image/arrow-left.png')}}" alt="">
      </div>
    </div>
</div>
</div>   

</body>
<script src="{{asset('front-assets/js/main.js')}}"></script>
<script src="{{asset('front-assets/js/verifyUser.js')}}"></script>
</html>

