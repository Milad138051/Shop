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

          @foreach ($products as $product)
          <a href="{{route('front.market.product',$product)}}" class="card swiper-slide my-2 p-2 md:p-3" style="border:none!important">
            <div class="image-box mb-6 ">
              <div>
                <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="{{ asset($product->image['indexArray']['medium']) }}" alt="" />
              </div>
            </div>
            <div class="space-y-3 text-center">
              <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                <div>
                  {{$product->name}}
                </div>
              </span>
              {{-- <div class="flex justify-center text-xs opacity-75">
                <div class="line-through">1.350.000</div>
                <div class="line-through">تومان</div>
              </div> --}}
              <div class="flex justify-center mt-1 mb-2 text-sm">
                <div>{{PriceFormat($product->price)}}</div>
                <div>تومان</div>
              </div>
            </div>
          </a>
          @endforeach

        </div>
      </div>
      <div class="swiper-button-next swiper-navBtn"></div>
      <div class="swiper-button-prev swiper-navBtn"></div>
    </div>
  </div>