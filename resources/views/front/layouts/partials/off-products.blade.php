<div class="bg-white rounded-2xl pt-5 shadow-xl my-10">
    <div class="flex justify-center px-5 md:px-10 items-center">
      <div class="border-b-2 border-red-500 pb-1">فروش شگفت انگیز</div>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 px-5">

      @foreach ($amazingSaleProducts as $product)
      <a href="{{route('front.market.product',$product)}}" class="my-2 p-2 md:p-3">
        <div class="image-box">
          <img class="w-full mx-auto mb-5 max-w-[150px]" src="{{ asset($product->image['indexArray']['medium']) }}" alt="" />
        </div>
        <div class="flex justify-between">
          <div class="bg-red-600 text-white h-full text-xs px-1 md:px-2 py-1 rounded-full">
            {{$product->activeAmazingSale()->percentage}}%
          </div>
            <div>
              {{$product->name}}
            </div>
          <div class="space-y-3 text-center">
            <div class="flex justify-center mt-1 mb-2 text-xs md:text-sm opacity-90">
              <div>{{PriceFormat($product->price-($product->price *($product->activeAmazingSale()->percentage/100)))}}</div>
              <div>تومان</div>
            </div>
            <div class="flex justify-center text-xs opacity-75 pl-6">
              <div class="line-through">{{PriceFormat($product->price)}}</div>
              <div>تومان</div>

            </div>
          </div>
        </div>
      </a>        
      @endforeach


    </div>
  </div>