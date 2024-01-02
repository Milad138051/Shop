<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود</title>

  <link rel="stylesheet" href="{{asset('front-assets/css/output.css')}}"/>
  <link rel="stylesheet" href="{{asset('front-assets/css/font.css')}}">
  <link rel="stylesheet" href="{{asset('admin-assets/sweetalert/sweetalert2.css')}}">

  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
</head>
<body class="bg-gray-50">

  <div class="flex justify-center items-center text-right h-screen w-96 mx-auto">
    <div class="shadow-xl rounded-2xl p-8 bg-white">
      <form action="{{ route('auth.login-register') }}" method="post">
        @csrf
        <div class="mb-2">
          <a href="./index.html">
            <img src="{{asset('front-assets/image/logo.png')}}" alt="" class="w-36 mx-auto">
          </a>
        </div>
        <div class="opacity-80 text-lg mb-5">
          ورود | ثبت نام
        </div>
        <div class="text-xs opacity-70 mb-2">
            شماره همراه یا ایمیل خود را وارد کنید:
        </div>
        <div class="mb-2">
          <input class="w-full drop-shadow-lg outline-none rounded-2xl py-2 text-center" required name="id" value="{{ old('id') }}" type="text">
          @error('id')
          <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
              <strong>
                  {{ $message }}
              </strong>
          </span>
          @enderror
        </div>
        <div class="text-xs text-red-500 hidden">
          شماره موبایل نادرست است
        </div>
        <div class="text-center mt-5 mb-3">
          <button class="bg-red-500 hover:bg-red-600 transition text-white opacity-80 rounded-2xl w-full py-2" type="submit">
            ورود
          </button>
        </div>
        <div class="text-xs opacity-80">
          ثبت نام یا ورود شما به منظور پذیرش
          <a href="#" class="text-red-500">قوانین و مقررات</a>
          ایران مارکت می باشد
        </div>
      </form>
    </div>
  </div>
  <script src="{{asset('admin-assets/js/plugins/jquery/jquery.min.js')}}"></script>

  <script src="{{asset('admin-assets/sweetalert/sweetalert2.min.js')}}"></script>
  @include('admin.alerts.sweetalert.success')
  @include('admin.alerts.sweetalert.error')

</body>

</html>