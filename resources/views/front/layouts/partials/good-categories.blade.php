<div class="bg-white rounded-2xl py-6 shadow-xl my-10">
    <div class="flex justify-between px-5 pb-5 md:px-10 items-center">
      <div class="border-b-2 border-red-500 pb-1">دسته بندی های محبوب</div>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-x-4 gap-y-4 md:gap-x-8 2xl:gap-x-10 px-3 md:px-8 lg:px-28">
      @foreach ($popularCategories->take(5) as $category)
      <a href="{{route('front.products',$category)}}" class="flex justify-center items-center flex-col gap-y-3 hover:scale-105 transition">
        <img src="{{ asset($category->image['indexArray']['medium']) }}" alt="">
        <div class="text-sm opacity-90">{{$category->name}}</div>
      </a>        
      @endforeach

    </div>
  </div>