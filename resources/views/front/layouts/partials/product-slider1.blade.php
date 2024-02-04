<div class="bg-white rounded-2xl pt-10 shadow-xl">
    <!-- TOP SLIDER -->
    <div class="flex justify-between px-5 md:px-10 items-center">
      <div class="border-b-2 border-red-500 pb-1">ارزان ترین ها</div>
      <a href="{{route('front.products',['sort'=>3])}}"><div class="transition px-4 py-2 rounded-xl flex justify-center items-center text-red-500 hover:text-red-600">دیدن همه<img class="w-4" src="{{asset('front-assets/image/arrow-left.png')}}" alt=""></div></a>
    </div>
    <!-- SLIDER -->
    <div class="containerPSlider swiper">
      <div class="slide-container1 px-2">
        <div class="card-wrapper swiper-wrapper py-4">
         @foreach ($cheapestProducts->take(4) as $product)
         <a href="{{route('front.market.product',$product)}}" class="card swiper-slide my-2 p-2 md:p-3" style="border:none!important">
          <div class="image-box mb-6 ">
            <div>
              <img class="hover:scale-105 transition rounded-3xl w-full mx-auto" src="{{ asset($product->image['indexArray']['medium']) }}" alt="" />
            </div>
          </div>
          <div class="space-y-3 text-center">
            <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
              @if (number_format($product->ratingsAvg(), 1, '.') != 0.0)
              <h6>
                میانگین امتیاز :
                {{ number_format($product->ratingsAvg(), 1, '.') .' از 5 ' ??
                    'شما اولین
                    امتیاز را ثبت نمایید!!!' }}
            </h6>
            @endif
              <div>
                {{$product->name}}
              </div>
            </span>
            @php
            $amazingSale=$product->activeAmazingSale() ?? collect();
          @endphp
            @if($amazingSale->count() > 0)
            <div class="flex justify-center text-xs opacity-75">
              <div class="line-through">{{PriceFormat($product->price)}}</div>
              <div class="line-through">تومان</div>
            </div>
            <div class="flex justify-center mt-1 mb-2 text-sm">
              <div>{{PriceFormat($product->price-($product->price *($product->activeAmazingSale()->percentage/100)))}}</div>
              <div>تومان</div>
            </div>
            @else
            <div class="flex justify-center mt-1 mb-2 text-sm">
              <div>{{PriceFormat($product->price)}}</div>
              <div>تومان</div>
            </div>
            @endif
            @php
               $commonDiscount = App\Models\Market\CommonDiscount::where([['status', 1], ['end_date', '>', now()], ['start_date', '<', now()]])->first();
            @endphp
            @if($commonDiscount->count() > 0)
            <div class="flex justify-center mt-1 mb-2 text-sm">
              <div class="text-danger"> {{$commonDiscount->percentage}}% تخفیف خورده </div>
            </div>
            @endif
          </div>
        </a>           
         @endforeach


        </div>
      </div>
      <div class="swiper-button-next swiper-navBtn"></div>
      <div class="swiper-button-prev swiper-navBtn"></div>
    </div>
  </div>