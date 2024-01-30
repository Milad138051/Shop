<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-y-3 bg-white mb-10 lg:rounded-xl border divide-y-2 sm:divide-y-0">
   
      
  
  @forelse ($popularCategories as $category)
  <div class="bg-white p-3 lg:rounded-r-xl border-l">
      <div class="flex flex-col gap-y-2 mb-5">
        <div class="opacity-80">{{$category->name}}</div>
        <div class="opacity-70 text-xs">پیشنهاد ما به شما</div>
      </div>
      <div class="grid grid-cols-2">
       
        @foreach ($category->products->take(4) as $product)
        <div class="border-l border-b py-2"><a href="{{route('front.market.product',$product)}}"><img class="max-w-[130px] mx-auto" src="{{ asset($product->image['indexArray']['medium']) }}" alt=""></a></div>
        @endforeach


      </div>
      <div class="flex justify-center text-sm text-red-500 hover:text-red-600 transition mt-5"><a href="{{route('front.products',$category)}}">مشاهده همه</a></div>
    </div>

    @empty


  @endforelse
  </div>