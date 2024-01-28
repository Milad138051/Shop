@extends('front.layouts.master')

@section('head-tag')
    <title>محصولات</title>

    <style>
        .sidebar-nav {}

        .sidebar-nav-item {
            border-bottom: 1px solid #efefef;
        }

        .sidebar-nav-item:last-of-type {
            border: none;
        }

        .sidebar-nav-item-title {
            position: relative;
            font-size: 0.8rem;
            /* font-weight: bold; */
            /* --tw-text-opacity: 1; */
            color: rgb(17 24 39 / var(--tw-text-opacity));
            display: block;
            cursor: pointer;
            padding: 0.4rem 0rem;
            transition: 0.4s;
        }

        .sidebar-nav-item-title i {
            position: absolute;
            left: 0rem;
            top: 0.6rem;
        }

        .sidebar-nav-item-title:hover {
            color: #ff253a;
            transition: 0.4s;
        }

        .sidebar-nav-item-title>a {
            display: block;
            text-decoration: none;
            color: inherit;
            text-shadow: inherit;
        }

        .rotate-angle-left-90-degrees {
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            transform: rotate(-90deg);
            padding-left: 0.4rem;
        }

        .sidebar-nav-sub-wrapper {
            display: none;
        }

        .sidebar-nav-sub-item {}

        .sidebar-nav-sub-item-title {
            padding: 0.3rem 1rem 0.3rem 0.6rem;
            font-size: 0.75rem;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            color: #333333;
            margin-bottom: 0.1rem;
            transition: 0.4s;
        }

        .sidebar-nav-sub-item-title:hover {
            color: #ff253a;
            transition: 0.4s;
        }

        .sidebar-nav-sub-item-title a {
            text-decoration: none;
            color: inherit;
        }

        .sidebar-nav-sub-item-title i {
            color: #999999;
        }

        .sidebar-nav-sub-item-title:hover i {
            color: inherit;
        }

        .sidebar-nav-sub-sub-wrapper {
            display: none;
        }

        .sidebar-nav-sub-sub-item {
            padding: 0.3rem 2rem;
            font-size: 0.75rem;
        }

        .sidebar-nav-sub-sub-item a {
            text-decoration: none;
            display: block;
            color: #333333;
            transition: 0.4s;
        }

        .sidebar-nav-sub-sub-item:hover a {
            text-decoration: none;
            color: #ff253a;
            transition: 0.4s;
        }

        .sidebar-input-text {
            font-size: 0.8rem;
            padding: 0.5rem;
            border-radius: 0.25rem;
            border: none;
            outline: none;
            background-color: rgba(0, 0, 0, 0.1);
            width: 100%;
            display: inline-block;
        }

        .sidebar-input-text:focus {
            box-shadow: 0rem 0rem 0.2rem 0.1rem rgba(0, 0, 0, 0.1);
        }


        .sidebar-input-text {
            font-size: 0.8rem;
            padding: 0.5rem;
            border-radius: 0.25rem;
            border: none;
            outline: none;
            background-color: rgba(0, 0, 0, 0.1);
            width: 100%;
            display: inline-block;
        }

        .sidebar-input-text:focus {
            box-shadow: 0rem 0rem 0.2rem 0.1rem rgba(0, 0, 0, 0.1);
        }

        .sidebar-price-range input {
            font-size: 0.8rem;
            padding: 0.5rem;
            border-radius: 0.25rem;
            border: none;
            outline: none;
            background-color: rgba(0, 0, 0, 0.1);
            width: 100%;
            display: inline-block;
        }

        .sidebar-price-range input:focus {
            box-shadow: 0rem 0rem 0.2rem 0.1rem rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            {{-- <div class="bg-white mx-5 rounded-2xl mb-4">
                <div class="py-3">
                    <h3 class="text-xl font-semibold text-gray-800">لپ تاپ و کامپیوتر</h3>
                </div>
            </div> --}}
            <div class="md:flex">

                @include('front.layouts.partials.products-sidebar')


                <div class="md:w-8/12 lg:w-9/12">
                    <div class="bg-white mx-1 rounded-2xl grid place-items-center">
                        <div class="w-full">
                            <div class="py-3 border-b">
                                @if (request()->search)
                                    <span class="d-inline-block border p-1 rounded bg-light mb-4">
                                        نتیجه جستجو برای :
                                        <span class="badge bg-info text-dark">"{{ request()->search }}"</span>
                                    </span>
                                @endif
                                @if (request()->brands)
                                    <span class="d-inline-block border p-1 rounded bg-light mb-4">
                                        برند :
                                        <span
                                            class="badge bg-info text-dark">"{{ implode(',', $selectedBrandsArray) }}"</span>
                                    </span>
                                @endif

                                @if (request()->categories)
                                    <span class="d-inline-block border p-1 rounded bg-light mb-4">
                                        دسته :
                                        <span class="badge bg-info text-dark">"-"</span>
                                    </span>
                                @endif

                                @if (request()->min_price)
                                    <span class="d-inline-block border p-1 rounded bg-light mb-4">قیمت از :
                                        <span class="badge bg-info text-dark">{{ request()->min_price }} تومان</span>
                                    </span>
                                @endif

                                @if (request()->max_price)
                                    <span class="d-inline-block border p-1 rounded bg-light mb-4">قیمت تا :
                                        <span class="badge bg-info text-dark">{{ request()->max_price }} تومان</span>
                                    </span>
                                @endif

                                @if (request()->category)
                                    <div class="opacity-80 text-sm mb-2">
                                        کالاهای موجود در دسته : {{ request()->category->name }}
                                    </div>
                                @else
                                    <div class="opacity-80 text-sm mb-2">
                                        همه کالاها
                                    </div>
                                @endif


                                <div class="opacity-80 text-sm mb-2">
                                    مرتب سازی:
                                </div>
                                <div class="flex flex-wrap gap-5 justify-start items-center">
                                    {{-- <a
                                        class="opacity-70 text-xs hover:text-red-500 transition cursor-pointer text-red-600">
                                        محبوب ترین
                                </a> --}}
                                    <a href="{{ route('front.products', ['search' => request()->serach, 'sort' => '5', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}"
                                        class="btn btn {{ request()->sort == 5 ? 'btn-info' : '' }}  btn-sm px-1 py-0"
                                        class="opacity-70 text-xs hover:text-red-500 transition cursor-pointer">
                                        پرفروش ترین
                                    </a>
                                    <a href="{{ route('front.products', ['search' => request()->serach, 'sort' => '3', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}"
                                        class="btn btn {{ request()->sort == 3 ? 'btn-info' : '' }}  btn-sm px-1 py-0"
                                        class="opacity-70 text-xs hover:text-red-500 transition cursor-pointer">
                                        ارزان ترین
                                    </a>
                                    <a href="{{ route('front.products', ['search' => request()->serach, 'sort' => '2', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}"
                                        class="btn btn {{ request()->sort == 2 ? 'btn-info' : '' }}  btn-sm px-1 py-0"
                                        class="opacity-70 text-xs hover:text-red-500 transition cursor-pointer">
                                        گران ترین
                                    </a>
                                    <a href="{{ route('front.products', ['search' => request()->serach, 'sort' => '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}"
                                        class="btn btn {{ request()->sort == 1 ? 'btn-info' : '' }} btn-sm px-1 py-0"
                                        class="opacity-70 text-xs hover:text-red-500 transition cursor-pointer">
                                        جدیدترین
                                    </a>
                                    <a href="{{ route('front.products', ['search' => request()->serach, 'sort' => '4', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}"
                                        class="btn btn {{ request()->sort == 4 ? 'btn-info' : '' }}  btn-sm px-1 py-0"
                                        class="opacity-70 text-xs hover:text-red-500 transition cursor-pointer">
                                        پربازدیدترین
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl">

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-5 px-1 rounded-2xl py-5">
                            @forelse ($products as $product)
                                <a href="{{ route('front.market.product', $product) }}"
                                    class="my-2 py-2 md:p-3 border rounded-xl flex items-center sm:inline hover:shadow-lg transition">
                                    <div class="image-box sm:mb-6">
                                        <div>
                                            <img class="hover:scale-105 transition rounded-md sm:rounded-3xl w-24 sm:w-full mx-auto"
                                                src="{{ asset($product->image['indexArray']['medium']) }}"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <span class="text-xs sm:text-sm opacity-90 mb-5">
                                            <div class="leading-7 h-auto">
                                                {{ $product->name }}
                                            </div>
                                        </span>
                                        <div class="flex justify-end mb-2 text-sm opacity-80 pl-3 md:pl-0">
                                            <div>{{ PriceFormat($product->price) }}</div>
                                            <div>تومان</div>
                                        </div>
                                        {{-- <div class="flex justify-end text-xs opacity-75 pl-3 md:pl-0">
                    <div class="line-through">1.350.000</div>
                    <div class="line-through">تومان</div>
                  </div> --}}
                                    </div>
                                </a>


                            @empty
                                <h1 class="text-danger">محصولی یافت نشد</h1>
                            @endforelse
                        </div>
                    </div>
                    <section class="col-12">
                        <section class="my-4 d-flex justify-content-center">
                            <nav>
                                {{ $products->links('pagination::bootstrap-5') }}
                            </nav>
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        //start filter
        $(document).ready(function() {

            $(".sidebar-nav-item-title").click(function() {
                $header = $(this);
                $content = $header.next();

                $(".sidebar-nav-sub-sub-wrapper").slideUp();
                $(".sidebar-nav-sub-item-title i").removeClass("rotate-angle-left-90-degrees");
                if ($content.is(":visible")) {
                    $header.find("i").removeClass("rotate-angle-left-90-degrees");
                    $content.slideUp();
                } else {
                    $(".sidebar-nav-item-title i").removeClass("rotate-angle-left-90-degrees");
                    $(".sidebar-nav-sub-wrapper").slideUp();
                    $header.find("i").addClass("rotate-angle-left-90-degrees");
                    $content.slideToggle(400);
                }
            });

            $(".sidebar-nav-sub-item-title").click(function() {
                $subHeader = $(this);
                $subContent = $subHeader.next();

                if ($subContent.is(":visible")) {
                    $subHeader.find("i").removeClass("rotate-angle-left-90-degrees");
                    $subContent.slideUp();
                } else {
                    $(".sidebar-nav-sub-item-title i").removeClass("rotate-angle-left-90-degrees");
                    $(".sidebar-nav-sub-sub-wrapper").slideUp();
                    $subHeader.find("i").addClass("rotate-angle-left-90-degrees");
                    $subContent.slideToggle(400);
                }
            });

        });
        //end filter
    </script>
@endsection
