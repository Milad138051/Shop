<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
  @foreach ($twoBanners as $twoBanner)
  <a href="{{ urldecode($twoBanner->url)}}">
    <img class="rounded-xl" src="{{$twoBanner->image}}" alt="">
  </a>    
  @endforeach  
  </div>