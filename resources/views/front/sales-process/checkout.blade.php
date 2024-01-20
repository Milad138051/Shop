@extends('front.layouts.master')

@section('head-tag')
    <title>سبد خرید</title>
@endsection


@section('content')
<div class="max-w-[1440px] mx-auto px-3">
    <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
      <div class="flex flex-col md:flex-row gap-y-3 items-center gap-x-2 mb-7">
        <div class="text-sm opacity-80">
          کد تخفیف دارید؟ وارد کنید:
        </div>
        <div>
          <input class="border border-gray-400 outline-none focus:border-red-300 rounded-lg p-1" type="text">
        </div>
        <div>
          <button class="bg-red-600 text-white px-3 py-1 rounded-lg shadow-md">
            تایید
          </button>
        </div>
      </div>
      <div>
        <div class="text-lg md:text-xl opacity-70 mb-3">
          جزئیات صورت حساب
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 px-5 md:px-20">
          <div class="mb-4">
            <label for="username" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">نام تحویل گیرنده:</label>
            <input type="text" class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300"/>
          </div>
          <div class="mb-4">
            <label for="username" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">شماره موبایل:</label>
            <input type="text" class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300"/>
          </div>
          <div class="mb-4">
            <label for="username" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">کدپستی:</label>
            <input type="text" class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300"/>
          </div>
          <div class="mb-4">
            <label for="username" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">آدرس:</label>
            <input type="text" class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300"/>
          </div>
          <div class="mb-4">
            <label for="mailTicket" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">توضیحات اضافه:</label>
            <textarea cols="30" rows="5" class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300"></textarea>
          </div>
        </div>
      </div>
      <div>
        <div class="text-lg md:text-xl opacity-70 mb-3 mt-5">
          جزئیات محصولات
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 lg:px-16">
          <span class="card swiper-slide my-2 p-2 md:p-3 ">
            <div class="image-box mb-6 ">
              <a href="">
                <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/1.jpg" alt="" />
              </a>
            </div>
            <div class="space-y-3 text-center">
              <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                <a href="">
                  گوشی شیائومی m11
                </a>
              </span>
              <div class="flex justify-center text-xs opacity-75">
                <div class="line-through">1.350.000</div>
                <div class="line-through">تومان</div>
              </div>
              <div class="flex justify-center mt-1 mb-2 text-sm">
                <div>1.100.000</div>
                <div>تومان</div>
              </div>
            </div>
          </span>
          <span class="card swiper-slide my-2 p-2 md:p-3 ">
            <div class="image-box mb-6 ">
              <a href="">
                <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/2.jpg" alt="" />
              </a>
            </div>
            <div class="space-y-3 text-center">
              <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                <a href="">
                  اپل واچ m32
                </a>
              </span>
              <div class="flex justify-center text-xs opacity-75">
                <div class="line-through">1.350.000</div>
                <div class="line-through">تومان</div>
              </div>
              <div class="flex justify-center mt-1 mb-2 text-sm">
                <div>1.100.000</div>
                <div>تومان</div>
              </div>
            </div>
          </span>
          <span class="card swiper-slide my-2 p-2 md:p-3 ">
            <div class="image-box mb-6 ">
              <a href="">
                <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/3.jpg" alt="" />
              </a>
            </div>
            <div class="space-y-3 text-center">
              <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                <a href="">
                  ریش تراش دیواید
                </a>
              </span>
              <div class="flex justify-center text-xs opacity-75">
                <div class="line-through">1.350.000</div>
                <div class="line-through">تومان</div>
              </div>
              <div class="flex justify-center mt-1 mb-2 text-sm">
                <div>1.100.000</div>
                <div>تومان</div>
              </div>
            </div>
          </span>
          <span class="card swiper-slide my-2 p-2 md:p-3 ">
            <div class="image-box mb-6 ">
              <a href="">
                <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/4.jpg" alt="" />
              </a>
            </div>
            <div class="space-y-3 text-center">
              <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                <a href="">
                  تلویزیون 40 اینچ
                </a>
              </span>
              <div class="flex justify-center text-xs opacity-75">
                <div class="line-through">1.350.000</div>
                <div class="line-through">تومان</div>
              </div>
              <div class="flex justify-center mt-1 mb-2 text-sm">
                <div>1.100.000</div>
                <div>تومان</div>
              </div>
            </div>
          </span>
        </div>
      </div>
      <div class="border shadow-xl rounded-2xl mx-auto max-w-xl mt-7 flex flex-col gap-y-5 py-5 px-5 md:px-20">
        <div class="flex justify-between">
          <div>
            قیمت کل:
          </div>
          <div class="flex gap-x-1">
            <div>
              1,240,000
            </div>
            <div>
              تومان
            </div>
          </div>
        </div>
        <div class="flex justify-between">
          <div>
            حمل و نقل:
          </div>
          <div class="flex gap-x-1">
            <div>
              40,000
            </div>
            <div>
              تومان
            </div>
          </div>
        </div>
        <div class="flex justify-between">
          <div>
            سود شما از این خرید:
          </div>
          <div class="flex gap-x-1">
            <div>
              80,000
            </div>
            <div>
              تومان
            </div>
          </div>
        </div>
        <div class="flex justify-between">
          <div class="text-red-600">
            مجموع نهایی:
          </div>
          <div class="flex gap-x-1">
            <div>
              1,200,000
            </div>
            <div>
              تومان
            </div>
          </div>
        </div>
      </div>
      <a href="#" class="flex justify-center items-center opacity-90 my-5">
        <button class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm">ثبت و پرداخت</button>
      </a>
    </div>
  </div>
@endsection


@section('script')

<script>
    $(document).ready(function(){
        bill();
    })


    function bill() {
        var total_product_price = 0;
        var total_discount = 0;
        var total_price = 0;

        $('.number').each(function() {
            var productPrice = parseFloat($(this).data('product-price'));
            var productDiscount = parseFloat($(this).data('product-discount'));
            var number = parseFloat($(this).val());

            total_product_price += productPrice * number;
            total_discount += productDiscount * number;
        })

        total_price = total_product_price - total_discount;

        $('#total_product_price').html(toFarsiNumber(total_product_price));
        $('#total_discount').html(toFarsiNumber(total_discount));
        $('#total_price').html(toFarsiNumber(total_price));


        function toFarsiNumber(number)
        {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }

    }

</script>
@endsection