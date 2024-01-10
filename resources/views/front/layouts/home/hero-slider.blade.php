<div class="flex mb-5 md:my-5">
  {{-- //banner near slideshow --}}
    <div class="md:w-3/12 mx-auto">
      <a href="{{ urldecode($bannerNearSliderShowImages->url ?? '#' ) }}">
        <img class="w-10/12 mx-auto rounded-xl" src="{{asset($bannerNearSliderShowImages->image ?? '')}}" alt="">
      </a>
    </div>
    {{-- // --}}

    <div class="w-9/12 mx-auto hidden md:block ">
      <div dir="ltr" class="owl-carousel">
        @foreach ($sliderShowImages as $sliderShowImage)
        <div class="box-border">
          <a href="{{ urldecode($sliderShowImage->url ?? '#')}}"
            ><img class="rounded-xl" src="{{asset($sliderShowImage->image ?? '')}}" alt=""
          /></a>
        </div>          
        @endforeach
      </div>
    </div>
  </div>