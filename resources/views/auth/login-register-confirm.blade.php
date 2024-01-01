<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود</title>

  <link rel="stylesheet" href="{{asset('front-assets/css/output.css')}}"/>
  <link rel="stylesheet" href="{{asset('admin-assets/bootstrap/css/bootstrap.min.css')}}">
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
      <form action="{{ route('auth.login-register-confirm', $token) }}" method="post">
        @csrf
        <div class="mb-2">
          <a href="./index.html">
            <img src="{{asset('front-assets/image/logo.png')}}" alt="" class="w-36 mx-auto">
          </a>
        </div>
        <div class="opacity-80 text-lg mb-5">
          کد تایید را وارد نمایید
        </div>

        @if($otp->type == 0)
        <div class="text-xs opacity-70 mb-2">
          کد تایید برای شماره موبایل {{ $otp->login_id }} ارسال گردید
        </div>
        @else
        <div class="text-xs opacity-70 mb-2">
          کد تایید برای ایمیل {{ $otp->login_id }} ارسال گردید
        </div>
        @endif


        <div class="mb-2">
          <input class="w-full drop-shadow-lg outline-none rounded-2xl py-2 text-center" name="otp" value="{{ old('otp') }}" type="text">
          @error('otp')
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
        <div class="text-center mt-5 mb-3 d-none" id="resend-otp">
          <a href="{{route('auth.login-register-resend-otp',$token)}}" class="text-decoration-none text-primary">دریافت مجدد کد تایید</a>
        </div>
        <section id="timer"></section>

        <div class="text-xs opacity-80 mt-5">
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


@php
    $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(1)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
@endphp

<script src="{{ asset('front-assets/js/jQuery.min.js')}}" ></script>
<script src="{{ asset('admin-assets/bootstrap/js/bootstrap/bootstrap.min.js') }}" ></script>




<script>
   var countDownDate = new Date().getTime() + {{ $timer }};
    var timer = $('#timer');
    var resendOtp = $('#resend-otp');

    var x = setInterval(function(){

        var now = new Date().getTime();

        var distance = countDownDate - now;

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(minutes == 0){
            timer.html('ارسال مجدد کد تایید تا ' + seconds + 'ثانیه دیگر')
        }
        else{
            timer.html('ارسال مجدد کد تایید تا ' + minutes + 'دقیقه و ' + seconds + 'ثانیه دیگر');
        }
        if(distance < 0)
        {
            clearInterval(x);
            timer.addClass('d-none');
            resendOtp.removeClass('d-none');
        }

    }, 1000)





</script>


</html>


