@extends('front.layouts.master')

@section('head-tag')
<title>خانه</title>
@endsection

@section('content')
    <!-- MAIN -->
    <!-- HERO SLIDER MOBILE -->
    <div class="md:w-[100%] mx-auto md:hidden">
      <div dir="ltr" class="owl-carousel">
        <div class="box-border">
          <a href="./search.html"
            ><img class="" src="{{asset('front-assets/image/heroSlider/1-mobile.jpg')}}" alt=""
          /></a>
        </div>
        <div class="box-border">
          <a href="./search.html"
            ><img class="" src="{{asset('front-assets/image/heroSlider/2-mobile.jpg')}}" alt=""
          /></a>
        </div>
        <div class="box-border">
          <a href="./search.html"
            ><img class="" src="{{asset('front-assets/image/heroSlider/3-mobile.gif')}}" alt=""
          /></a>
        </div>
        <div class="box-border">
          <a href="./search.html"
            ><img class="" src="{{asset('front-assets/image/heroSlider/4-mobile.jpg')}}" alt=""
          /></a>
        </div>
      </div>
    </div>
    <div class="max-w-[1440px] mx-auto px-3">
      <!-- HERO SLIDER -->
      <div class="flex mb-5 md:my-5">
        <div class="md:w-3/12 mx-auto">
          <a href="#">
            <img class="w-10/12 mx-auto rounded-xl" src="{{asset('front-assets/image/heroSlider/b1.jpg')}}" alt="">
          </a>
        </div>
        <div class="w-9/12 mx-auto hidden md:block ">
          <div dir="ltr" class="owl-carousel">
            <div class="box-border">
              <a href="./search.html"
                ><img class="rounded-xl" src="{{asset('front-assets/image/heroSlider/1-mobile.jpg')}}" alt=""
              /></a>
            </div>
            <div class="box-border">
              <a href="./search.html"
                ><img class="rounded-xl" src="{{asset('front-assets/image/heroSlider/2-mobile.jpg')}}" alt=""
              /></a>
            </div>
            <div class="box-border">
              <a href="./search.html"
                ><img class="rounded-xl" src="{{asset('front-assets/image/heroSlider/3-mobile.gif')}}" alt=""
              /></a>
            </div>
            <div class="box-border">
              <a href="./search.html"
                ><img class="rounded-xl" src="{{asset('front-assets/image/heroSlider/4-mobile.jpg')}}" alt=""
              /></a>
            </div>
          </div>
        </div>
      </div>
      <!-- PRODUCT SLIDER 1 -->
      <div class="bg-white rounded-2xl pt-10 shadow-xl">
        <!-- TOP SLIDER -->
        <div class="flex justify-between px-5 md:px-10 items-center">
          <div class="border-b-2 border-red-500 pb-1">پرتخفیف ترین ها</div>
          <a href="./search.html"><div class="transition px-4 py-2 rounded-xl flex justify-center items-center text-red-500 hover:text-red-600">دیدن همه<img class="w-4" src="{{asset('front-assets/image/arrow-left.png')}}" alt=""></div></a>
        </div>
        <!-- SLIDER -->
        <div class="containerPSlider swiper">
          <div class="slide-container1 px-2">
            <div class="card-wrapper swiper-wrapper py-4">
              <a href="./single-product.html" class="card swiper-slide my-2 p-2 md:p-3 ">
                <div class="image-box mb-6 ">
                  <div>
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="{{asset('front-assets/image/productSlider/1.jpg')}}" alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      گوشی شیائومی m11
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
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="{{asset('front-assets/image/productSlider/2.jpg')}} alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      اپل واچ مدل m32
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
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="{{asset('front-assets/image/productSlider/3.jpg')}} alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      ریش تراش دایاک
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
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="{{asset('front-assets/image/productSlider/4.jpg')}} alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      تلویزیون 40 اینچ
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
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="{{asset('front-assets/image/productSlider/5.jpg')}} alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      کاپشن زمستانه
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
                    <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="{{asset('front-assets/image/productSlider/6.jpg')}} alt="" />
                  </div>
                </div>
                <div class="space-y-3 text-center">
                  <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                    <div>
                      هنذفری بلوتوثی شیائومی
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
      <!-- SECTION IMAGE -->
      <div class="my-10">
        <a href="./search.html">
          <img class="rounded-2xl hidden md:block" src="{{asset('front-assets/image/sectionImage/2.webp')}}" alt="">
        </a>
        <a href="./search.html"></a>
          <img class="rounded-2xl md:hidden" src="{{asset('front-assets/image/sectionImage/2-mobile.jpg')}}" alt="">
        </a>
      </div>
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
      <div class="bg-white rounded-2xl pt-5 shadow-xl my-10">
        <div class="flex justify-center px-5 md:px-10 items-center">
          <div class="border-b-2 border-red-500 pb-1">منتخب محصولات تخفیف دار </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 px-5">
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/7.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/3.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/1.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/6.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/2.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/17.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/1.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/6.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/2.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/17.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/7.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./single-product.html" class="my-2 p-2 md:p-3">
            <div class="image-box">
              <img class="w-full mx-auto mb-5 max-w-[150px]" src="./assets/image/productSlider/3.jpg" alt="" />
            </div>
            <div class="flex justify-between">
              <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
                10%
              </div>
              <div class="space-y-3 text-center">
                <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
                  <div>1,100,000</div>
                  <div>تومان</div>
                </div>
                <div class="flex justify-center text-xs opacity-75 pl-6">
                  <div class="line-through">1,350,000</div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- BRANDS -->
      <div class="bg-white rounded-2xl pt-5 shadow-xl my-10">
        <!-- TOP SLIDER -->
        <div class="flex justify-center px-5 md:px-10 items-center">
          <div class="border-b-2 border-red-500 pb-1">محبوب ترین برندها</div>
        </div>
        <!-- SLIDER -->
        <div class="containerPSlider swiper">
          <div class="slide-container-brand px-2">
            <div class="card-wrapper swiper-wrapper py-4 items-center">
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/1.png" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/2.png" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/3.png" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/4.png" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/5.jpg" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/6.png" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/7.jpg" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/8.png" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/9.png" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/1.png" alt="" />
              </a>
              <a href="./#" class="card swiper-slide">
                <img class="max-w-[110px]" src="./assets/image/brands/1.png" alt="" />
              </a>
            </div>
          </div>
          <div class="swiper-button-next swiper-navBtn"></div>
          <div class="swiper-button-prev swiper-navBtn"></div>
        </div>
      </div>
      <!-- BLOG -->
      <div class="bg-white rounded-2xl py-8 shadow-xl my-10">
        <div class="flex justify-between px-5 md:px-10 items-center">
          <div class="text-red-500">خواندنی ها</div>
          <a href="./blog.html"><div class="transition px-4 py-2 rounded-xl flex justify-center items-center text-red-500 hover:text-red-600">مطالب بیشتر<img class="w-4" src="./assets/image/arrow-left.png" alt=""></div></a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 px-10 gap-5">
          <a href="./blog(single).html" class="shadow-lg rounded-3xl p-4 hover:text-red-600 transition">
            <div>
              <img class="rounded-xl hover:scale-105 transition" src="./assets/image/blog/lavazem.jpg" alt="">
            </div>
            <div class="text-sm opacity-90 py-5">
              لوازم آشپزی مورد نیاز من.
            </div>
          </a>
          <a href="./blog(single).html" class="shadow-lg rounded-3xl p-4 hover:text-red-600 transition">
            <div>
              <img class="rounded-xl hover:scale-105 transition" src="./assets/image/blog/bag.jpg" alt="">
            </div>
            <div class="text-sm opacity-90 py-5">
              چه چیزهایی با خودم نیازه ببرم کوه؟
            </div>
          </a>
          <a href="./blog(single).html" class="shadow-lg rounded-3xl p-4 hover:text-red-600 transition">
            <div>
              <img class="rounded-xl hover:scale-105 transition" src="./assets/image/blog/car.jpg" alt="">
            </div>
            <div class="text-sm opacity-90 py-5">
              چرا نباید در هوای بارانی در فصل زمستان و بهار آفرود بریم؟
            </div>
          </a>
          <a href="./blog(single).html" class="shadow-lg rounded-3xl p-4 hover:text-red-600 transition">
            <div>
              <img class="rounded-xl hover:scale-105 transition" src="./assets/image/blog/chador.jpg" alt="">
            </div>
            <div class="text-sm opacity-90 py-5">
              چادر ضد آب یا پارچه ای؟
            </div>
          </a>
        </div>
      </div>
    </div>
@endsection


