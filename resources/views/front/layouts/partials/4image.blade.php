<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    
  @foreach ($fourBanners as $fourBanner)
  <a href="{{ urldecode($fourBanner->url) }}">
    <img class="rounded-xl" src="{{asset($fourBanner->image)}}" alt="">
  </a>    
  @endforeach

  </div>