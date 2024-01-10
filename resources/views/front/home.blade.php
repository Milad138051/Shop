@extends('front.layouts.master')

@section('head-tag')
<title>خانه</title>
@endsection

@section('content')
    <!-- MAIN -->
    <!-- HERO SLIDER MOBILE -->

    @include('front.layouts.home.hero-slider-mobile')

    <div class="max-w-[1440px] mx-auto px-3">

      @include('front.layouts.home.hero-slider-mobile')
      <!-- HERO SLIDER -->
      @include('front.layouts.home.hero-slider')
      <!-- PRODUCT SLIDER 1 -->
      @include('front.layouts.home.product-slider1')
      <!-- SECTION IMAGE -->
      @include('front.layouts.home.section-image')
      <!-- SUGGESTED CATEGORY PRODUCTS -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-y-3 bg-white mb-10 lg:rounded-xl border divide-y-2 sm:divide-y-0">
        <div class="bg-white p-3 lg:rounded-r-xl border-l">
          <div class="flex flex-col gap-y-2 mb-5">
            <div class="opacity-80">لپ تاپ و کامپیوتر خانگی</div>
            <div class="opacity-70 text-xs">بر اساس بازدیدهای شما</div>
          </div>
          <div class="grid grid-cols-2">
            <div class="border-l border-b py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="{{asset('front-assets/image/suggested product/l1.webp')}}" alt=""></a></div>
            <div class="border-b py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="{{asset('front-assets/image/suggested product/l2.webp')}}" alt=""></a></div>
            <div class="border-l py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="{{asset('front-assets/image/suggested product/l3.webp')}}" alt=""></a></div>
            <div class="py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="{{asset('front-assets/image/suggested product/l4.webp')}}" alt=""></a></div>
          </div>
          <div class="flex justify-center text-sm text-red-500 hover:text-red-600 transition mt-5"><a href="#">مشاهده همه</a></div>
        </div>
        <div class="bg-white p-3 border-l">
          <div class="flex flex-col gap-y-2 mb-5">
            <div class="opacity-80">گوشی موبایل</div>
            <div class="opacity-70 text-xs">بر اساس بازدیدهای شما</div>
          </div>
          <div class="grid grid-cols-2">
            <div class="border-l border-b py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="{{asset('front-assts/image/suggested product/m1.jpg')}}" alt=""></a></div>
            <div class="border-b py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="{{asset('front-assets/image/suggested product/m2.jpg')}}" alt=""></a></div>
            <div class="border-l py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/m3.jpg" alt=""></a></div>
            <div class="py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/m4.jpg" alt=""></a></div>
          </div>
          <div class="flex justify-center text-sm text-red-500 hover:text-red-600 transition mt-5"><a href="#">مشاهده همه</a></div>
        </div>
        <div class="bg-white p-3 border-l">
          <div class="flex flex-col gap-y-2 mb-5">
            <div class="opacity-80">هدفون، هدست و هندزفری</div>
            <div class="opacity-70 text-xs">بر اساس بازدیدهای شما</div>
          </div>
          <div class="grid grid-cols-2">
            <div class="border-l border-b py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/h1.jpg" alt=""></a></div>
            <div class="border-b py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/h2.jpg" alt=""></a></div>
            <div class="border-l py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/h3.jpg" alt=""></a></div>
            <div class="py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/h4.jpg" alt=""></a></div>
          </div>
          <div class="flex justify-center text-sm text-red-500 hover:text-red-600 transition mt-5"><a href="#">مشاهده همه</a></div>
        </div>
        <div class="bg-white p-3 lg:rounded-l-xl">
          <div class="flex flex-col gap-y-2 mb-5">
            <div class="opacity-80">ساعت هوشمند</div>
            <div class="opacity-70 text-xs">بر اساس بازدیدهای شما</div>
          </div>
          <div class="grid grid-cols-2">
            <div class="border-l border-b py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/w1.jpg" alt=""></a></div>
            <div class="border-b py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/w2.jpg" alt=""></a></div>
            <div class="border-l py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/w3.jpg" alt=""></a></div>
            <div class="py-2"><a href="#"><img class="max-w-[130px] mx-auto" src="./assets/image/suggested product/w4.jpg" alt=""></a></div>
          </div>
          <div class="flex justify-center text-sm text-red-500 hover:text-red-600 transition mt-5"><a href="#">مشاهده همه</a></div>
        </div>
      </div>
      <!-- 4 IMAGE -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <a href="./search.html">
          <img class="rounded-xl" src="./assets/image/fourImage/1.jpg" alt="">
        </a>
        <a href="./search.html">
          <img class="rounded-xl" src="./assets/image/fourImage/2.jpg" alt="">
        </a>
        <a href="./search.html">
          <img class="rounded-xl" src="./assets/image/fourImage/3.jpg" alt="">
        </a>
        <a href="./search.html">
          <img class="rounded-xl" src="./assets/image/fourImage/4.jpg" alt="">
        </a>
      </div>
      <!-- GOOD CATEGORYS -->
      <div class="bg-white rounded-2xl py-6 shadow-xl my-10">
        <div class="flex justify-between px-5 pb-5 md:px-10 items-center">
          <div class="border-b-2 border-red-500 pb-1">دسته بندی های محبوب</div>
          <a href="./search.html"><div class="transition px-4 py-2 rounded-xl flex justify-center items-center text-red-500 hover:text-red-600">دیدن همه<img class="w-4" src="./assets/image/arrow-left.png" alt=""></div></a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-x-4 gap-y-4 md:gap-x-8 2xl:gap-x-10 px-3 md:px-8 lg:px-28">
          <a href="./search.html" class="flex justify-center items-center flex-col gap-y-3 hover:scale-105 transition">
            <img src="./assets/image/goodCategory/mobile.webp" alt="">
            <div class="text-sm opacity-90">موبایل</div>
          </a>
          <a href="./search.html" class="flex justify-center items-center flex-col gap-y-3 hover:scale-105 transition">
            <img src="./assets/image/goodCategory/biutiful.webp" alt="">
            <div class="text-sm opacity-90">زیبایی</div>
          </a>
          <a href="./search.html" class="flex justify-center items-center flex-col gap-y-3 hover:scale-105 transition">
            <img src="./assets/image/goodCategory/book.webp" alt="">
            <div class="text-sm opacity-90">کتاب و دفتر</div>
          </a>
          <a href="./search.html" class="flex justify-center items-center flex-col gap-y-3 hover:scale-105 transition">
            <img src="./assets/image/goodCategory/digital.webp" alt="">
            <div class="text-sm opacity-90">کالای دیجیتال</div>
          </a>
          <a href="./search.html" class="flex justify-center items-center flex-col gap-y-3 hover:scale-105 transition">
            <img src="./assets/image/goodCategory/market.webp" alt="">
            <div class="text-sm opacity-90">سوپر مارکت</div>
          </a>
          <a href="./search.html" class="flex justify-center items-center flex-col gap-y-3 hover:scale-105 transition">
            <img src="./assets/image/goodCategory/mode.webp" alt="">
            <div class="text-sm opacity-90">مد و پوشاک</div>
          </a>
          <a href="./search.html" class="flex justify-center items-center flex-col gap-y-3 hover:scale-105 transition">
            <img src="./assets/image/goodCategory/tools.webp" alt="">
            <div class="text-sm opacity-90">ابزارآلات</div>
          </a>
        </div>
      </div>
      <!-- PRODUCT SLIDER 2 -->
      <div class="bg-white rounded-2xl pt-10 shadow-xl my-10">
        <!-- TOP SLIDER -->
        <div class="flex justify-between px-5 md:px-10 items-center">
          <div class="border-b-2 border-red-500 pb-1">کالای دیجیتال</div>
          <a href="./search.html"><div class="transition px-4 py-2 rounded-xl flex justify-center items-center text-red-500 hover:text-red-600">دیدن همه<img class="w-4" src="./assets/image/arrow-left.png" alt=""></div></a>
        </div>
        <!-- SLIDER -->
        <div class="containerPSlider swiper">
          <div class="slide-container1 px-2">
            <div class="card-wrapper swiper-wrapper py-4">
              <a href="./single-product.html" class="card swiper-slide my-2 p-2 md:p-3 ">
                <div class="image-box mb-6 ">
                  <div>
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/7.jpg" alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      لپ تاپ مدل ایسوس
                    </div>
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
              </a>
              <a href="./single-product.html" class="card swiper-slide my-2 p-2 md:p-3 ">
                <div class="image-box mb-6 ">
                  <div>
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/8.jpg" alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      گوشی ونگارد
                    </div>
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
              </a>
              <a href="./single-product.html" class="card swiper-slide my-2 p-2 md:p-3 ">
                <div class="image-box mb-6 ">
                  <div>
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/9.jpg" alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      کش مخصوص تقویت مچ دست
                    </div>
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
              </a>
              <a href="./single-product.html" class="card swiper-slide my-2 p-2 md:p-3 ">
                <div class="image-box mb-6 ">
                  <div>
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/10.jpg" alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      پاک کننده لوازم دیجیتال
                    </div>
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
              </a>
              <a href="./single-product.html" class="card swiper-slide my-2 p-2 md:p-3 ">
                <div class="image-box mb-6 ">
                  <div>
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/11.jpg" alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      پک لوازم سفر
                    </div>
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
              </a>
              <a href="./single-product.html" class="card swiper-slide my-2 p-2 md:p-3 ">
                <div class="image-box mb-6 ">
                  <div>
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="./assets/image/productSlider/12.jpg" alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      بسته 3 عددی روان نویس
                    </div>
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
              </a>
            </div>
          </div>
          <div class="swiper-button-next swiper-navBtn"></div>
          <div class="swiper-button-prev swiper-navBtn"></div>
        </div>
      </div>
      <!-- SECTION IMAGE 2 -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <a href="./search.html">
          <img class="rounded-xl" src="./assets/image/twoImage/1.jpg" alt="">
        </a>
        <a href="./search.html">
          <img class="rounded-xl" src="./assets/image/twoImage/2.jpg" alt="">
        </a>
      </div>
      <!-- OFF PRODUCTS -->
      @include('front.layouts.home.off-products')
      <!-- BRANDS -->
      @include('front.layouts.home.brands')
      <!-- BLOG -->
      @include('front.layouts.home.blogs')
    </div>
@endsection


