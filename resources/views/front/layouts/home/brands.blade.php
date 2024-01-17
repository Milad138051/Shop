<div class="bg-white rounded-2xl pt-5 shadow-xl my-10">
    <!-- TOP SLIDER -->
    <div class="flex justify-center px-5 md:px-10 items-center">
      <div class="border-b-2 border-red-500 pb-1">محبوب ترین برندها</div>
    </div>
    <!-- SLIDER -->
    <div class="containerPSlider swiper">
      <div class="slide-container-brand px-2">
        <div class="card-wrapper swiper-wrapper py-4 items-center">
      
      @foreach ($brands as $brand)
      <a href="./#" class="card swiper-slide" style="border:none!important">
        <img class="max-w-[100px]" src="{{ asset($brand->logo['indexArray']['large']) }}" alt="" />
      </a>
      @endforeach    
        </div>
      </div>
      <div class="swiper-button-next swiper-navBtn"></div>
      <div class="swiper-button-prev swiper-navBtn"></div>
    </div>
  </div>