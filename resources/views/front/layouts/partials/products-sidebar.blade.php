<div class="md:w-4/12 lg:w-3/12">
    <form action="{{ route('front.products', request()->category ? request()->category->id : null) }}" method="get">
        @csrf
        <input type="hidden" name="sort" value="{{ request()->sort }}">

        {{-- //categories --}}
        @include('front.layouts.partials.products-sidebar-categories', ['categories' => $categories])
        {{-- //search --}}
        <div class="bg-white mx-5 mb-4 px-3 py-3 border rounded-xl">
            <div>
                <div class="opacity-80 mb-1">
                    جستجو:
                </div>
                <div class="space-y-1 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <input type="text" class="sidebar-input-text" placeholder="جستجو بر اساس نام، برند ..."
                        name="search" value="{{ request()->search }}">
                </div>
            </div>
        </div>
        {{-- //brands --}}
        <div class="bg-white mx-5 mb-4 px-3 py-3 border rounded-xl">
            <div>
                <div class="opacity-80 mb-1">
                    برند:
                </div>
                <div class="space-y-1">
                    @foreach ($brands as $brand)
                        <div class="flex items-center rounded-lg hover:bg-gray-100 opacity-80">
                            <input id="checkbox-item-21" name="brands[]" type="checkbox"
                                @if (request()->brands && in_array($brand->id, request()->brands)) checked @endif type="checkbox"
                                value="{{ $brand->id }}" id="{{ $brand->id }}"
                                class="w-4 h-4 bg-gray-100 border-gray-300 mr-3">
                            <label for="checkbox-item-21"
                                class="w-full text-xs text-gray-900 rounded pr-1 py-2">{{ $brand->persian_name }}</label>
                            <label for="checkbox-item-21"
                                class="w-full text-xs text-gray-900 rounded pr-1 py-2">{{ $brand->original_name }}</label>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        {{-- //colors --}}
        {{-- <div class="bg-white mx-5 mb-4 px-3 py-3 border rounded-xl">
      <div>
        <div class="opacity-80 mb-1">
          رنگ:
        </div>
        <div class="space-y-1 grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div class="flex items-center rounded-lg opacity-80 bg-black text-white">
            <input id="checkbox-item-1" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 mr-3">
            <label for="checkbox-item-1" class="w-full text-xs rounded pr-1 py-2">مشکی</label>
          </div>
          <div class="flex items-center rounded-lg opacity-80 bg-white border">
            <input id="checkbox-item-2" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 mr-3">
            <label for="checkbox-item-2" class="w-full text-xs text-gray-900 rounded pr-1 py-2">سفید</label>
          </div>
          <div class="flex items-center rounded-lg opacity-80 bg-green-600 text-white">
            <input id="checkbox-item-3" type="checkbox" value="" class="w-4 h-4 border-gray-300 mr-3">
            <label for="checkbox-item-3" class="w-full text-xs rounded pr-1 py-2">سبز</label>
          </div>
          <div class="flex items-center rounded-lg opacity-80 bg-gray-400 text-white">
            <input id="checkbox-item-4" type="checkbox" value="" class="w-4 h-4 border-gray-300 mr-3">
            <label for="checkbox-item-4" class="w-full text-xs rounded pr-1 py-2">خاکستری</label>
          </div>
        </div>
      </div>
    </div> --}}
        {{-- //by price --}}
        <div class="bg-white mx-5 mb-4 px-3 py-3 border rounded-xl">
            <div class="opacity-80 mb-1">
                محدوده قیمت (تومان)
            </div>
            <div class="wrapper">
                <section class="sidebar-price-range d-flex justify-content-between">
                    <section class="p-1"><input type="text" placeholder="قیمت از ..." name="min_price"
                            value="{{ request()->min_price }}"></section>
                    <section class="p-1"><input type="text" placeholder="قیمت تا ..." name="max_price"
                            value="{{ request()->max_price }}"></section>
                </section>
            </div>
        </div>

        {{-- ////////////////////////// --}}

        <div class="bg-white mx-5 mb-4 px-3 py-3 border rounded-xl">
            <section class="sidebar-filter-btn d-grid gap-2">
                <button class="btn btn-danger" type="submit">اعمال فیلتر</button>
            </section>

            <section class="sidebar-filter-btn d-grid gap-2">
                <a href="{{ route('front.products') }}" class="btn btn-warning">حذف فیلترها</a>
            </section>
        </div>

    </form>
</div>
