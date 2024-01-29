@extends('front.layouts.master')

@section('head-tag')
    <title>{{ $product->name }}</title>
    <style>
        .product-info-colors {
            width: 1.4rem;
            height: 1.4rem;
            border-radius: 50%;
            display: inline-block;
            margin-bottom: -0.3rem;
            border: 1px solid rgb(137, 137, 137);
            cursor: pointer
        }
    </style>
@endsection


@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="flex gap-x-2 px-10 mt-5 md:mt-10">
            <div>
                <a href="" class="hover:text-red-500 transition text-sm opacity-70">خانه</a>
            </div>
            <div class="opacity-70">/</div>
            <div>
                <a href="" class="hover:text-red-500 transition text-sm opacity-70">کالای دیجیتال</a>
            </div>
            <div class="opacity-70">/</div>
            <div>
                <a href="" class="hover:text-red-500 transition text-sm opacity-70">موبایل</a>
            </div>
        </div>
        <div class="bg-white shadow-xl my-5 md:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <div class="p-3 w-11/12 mx-auto rounded-2xl">
                <div class="lg:flex">
                    <div class="w-full lg:w-1/3">
                        @auth
                        <div>
                            <span class="flex items-center pr-20 pb-2">
                               
                                {{-- addtocompare --}}
                                @if ($product->compares->contains(function($compare,$key){
									return $compare->id===auth()->user()->compare->id;
								}))
                                <button type="button" class="product-add-to-compare" data-url="{{ route('front.market.add-to-compare', $product) }}">
                                    <img onclick="showAlertAddTocomparison()" class="w-6 ml-2 cursor-pointer"
                                    src="{{ asset('front-assets/image/comparison.png') }}" alt="" title="حذف از لیست مقایسه">
                                </button>
                                @else
                                <button type="button" class="product-add-to-compare" data-url="{{ route('front.market.add-to-compare', $product) }}">
                                    <img onclick="showAlertAddTocomparison()" class="w-6 ml-2 cursor-pointer"
                                    src="{{ asset('front-assets/image/comparison.png') }}" alt="" title="اضافه به لیست مقایسه">
                                </button>
                                @endif
                                
                               
                                    {{-- //addtofavorite --}}
                                    @if ($product->user->contains(auth()->user()->id))
                                    <button type="button" class="product-add-to-favorite"  data-url="{{ route('front.market.add-to-favorite', $product) }}" title="حذف از علاقه مندی">
                                          <i class="fa fa-heart text-danger"></i>
                                    </button>
                                    @else
                                    <button type="button" class="product-add-to-favorite" data-url="{{ route('front.market.add-to-favorite', $product) }}" title="اضافه به علاقه مندی">
                                                    <i class="fa fa-heart"></i>
                                   </button>
                                    @endif


                            </span>
                        </div>
                        @endauth
                        <div>
                            @php
                                $imageGalley = $product->images()->get();
                                $images = collect();
                                $images->push($product->image);
                                foreach ($imageGalley as $image) {
                                    $images->push($image->image);
                                }
                            @endphp
                            <div class="max-w-[300px] mx-auto">
                                {{-- <img class="mySlides rounded-xl md:rounded-3xl" src="{{ asset($images->first()['indexArray']['medium']) }}" style="width:100%"> --}}
                                @foreach ($images as $key => $image)
                                    <img class="mySlides rounded-xl md:rounded-3xl"
                                        src="{{ asset($image['indexArray']['medium']) }}"
                                        style="width:100%;@if ($loop->iteration !== 1) display:none @endif">
                                @endforeach
                            </div>
                            <div class="flex justify-around gap-x-4 mt-3">
                                @foreach ($images as $key => $image)
                                    <div class="max-w-[80px]">
                                        <img class="rounded-xl opacity-70 hover:opacity-100 transition"
                                            src="{{ asset($image['indexArray']['medium']) }}"
                                            onclick="currentDiv({{ $loop->iteration }})">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-2/3 md:mt-0">
                        <div class="opacity-80 text-lg font-semibold">
                            {{ $product->name }}
                        </div>

                        <form action="{{route('front.sales-process.add-to-cart',$product)}}" method="POST">
                            @csrf
                        <div class="md:flex sm:pr-7">
                            <div class="md:w-2/3">

                                @php
                                    $colors = $product->colors()->get();
                                @endphp
                                @if ($colors->count() != 0)
                                    <div class="flex items-center" style="margin-top: 25px">
                                        <div class="opacity-70 text-sm mb-1">
                                            رنگ بندی:
                                        </div>
                                        <div class="flex flex-wrap">
                                            <div class="flex items-center gap-x-2">
                                                <div class="flex w-max">
                                                    <p>
                                                        @foreach ($colors as $key => $color)
                                                            <label for="{{ 'color_' . $color->id }}"
                                                                style="background-color: {{ $color->color ?? '#ffffff' }};"
                                                                class="product-info-colors me-1" data-bs-toggle="tooltip"
                                                                data-bs-placement="bottom"
                                                                title="{{ $color->color_name }}"></label>

                                                            <input style="display:none" type="radio" name="color"
                                                                id="{{ 'color_' . $color->id }}"
                                                                value="{{ $color->id }}"
                                                                data-color-name="{{ $color->color_name }}"
                                                                data-color-price="{{ $color->price_increase }}"
                                                                @if ($key == 0) checked @endif>
                                                        @endforeach

                                                    </p>
                                                    <p style="margin-right:5px"><span>رنگ انتخاب شده : <span
                                                                id="selected_color_name">
                                                                {{ $colors->first()->color_name }}</span></span>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <div class="mt-4 mb-2 opacity-80 text-sm font-semibold">
                                        ویژگی های محصول:
                                    </div>
                                    <div class="flex flex-col gap-y-2 text-xs">

                                        @foreach ($product->metas()->get() as $meta)
                                            <div class=" flex items-center">
                                                <h3 class="opacity-60 ml-1">
                                                    {{ $meta->meta_key }} :
                                                </h3>
                                                <div class="opacity-80">
                                                    <div class="text-right">
                                                        {{ $meta->meta_value }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                                <div>
                                    <div class="mt-4 mb-2 opacity-80 text-sm font-semibold">
                                        گارانتی :
                                    </div>
                                    <div class="flex flex-col gap-y-2 text-xs">

                                        @php
                                            $guarantees = $product->guarantees()->get();
                                        @endphp
                                        @if ($guarantees->count() != 0)
                                            <select class="border focus:outline-none rounded-lg" style="text-align: left;width:150px"
                                                name="guarantee" id="guarantee">
                                                @foreach ($guarantees as $key => $guarantee)
                                                    <option value="{{ $guarantee->id }}"
                                                        data-guarantee-price="{{ $guarantee->price_increase }}"
                                                        @if ($key == 0) selected @endif>
                                                        {{ $guarantee->name }}</option>
                                                @endforeach

                                            </select>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="md:w-2/5 mt-5 md:mt-0">
                                <div class="pb-5 rounded-2xl shadow-xl border">
                                    <div class="flex justify-between px-3 py-5">
                                        <div class="text-right opacity-80 text-sm flex flex-col gap-y-6">

                                            <div>
                                                موجود در انبار:
                                            </div>
                                            @php
                                            $amazingSale = $product->activeAmazingSale();
                                            @endphp

                                            @if(!empty($amazingSale))
                                            <div>
                                                 درصد تخفیف   
                                            </div>
                                            @endif
                                            {{-- @if(!empty($amazingSale))
                                            <div>
                                                 میزان تخفیف   
                                            </div>
                                            @endif --}}
                                            <div>
                                                قیمت (شامل هزینه گارانتی و رنگ کالا) :
                                            </div>
                                            @if($product->marketable_number > 0)
                                            <div>
                                                تعداد:
                                            </div>
                                            @endif
                                            <div>
                                                قیمت نهایی : 
                                            </div>
                                        </div>
                                        <div class="text-left opacity-70 text-sm flex flex-col gap-y-6">
                                            <div>
                                                {{ $product->marketable_number }} عدد
                                            </div>
                                            @if(!empty($amazingSale))
                                            <div id="product-discount-price" data-product-discount-price="{{ ($product->price * ($amazingSale->percentage / 100) ) }}">
                                                <div>
                                                    {{ $amazingSale->percentage}} درصد
                                                </div>
                                            </div>
                                            @endif
                                            {{-- @if(!empty($amazingSale))
                                            <div>
                                                <div id="product-discount-price" data-product-discount-price="{{ ($product->price * ($amazingSale->percentage / 100) ) }}">
                                                    {{ PriceFormat($product->price * ($amazingSale->percentage / 100) ) }} 
                                                </div>
                                                <div>
                                                    تومان
                                                </div>                         
                                            </div>
                                            @endif --}}
                                            <div class="flex text-red-500">
                                                <div id="product_price" data-product-original-price="{{ $product->price }}" data-amazing-sale="{{$product->activeAmazingSale()->percentage ?? ''}}"></div>
                                                <div>
                                                    تومان
                                                </div>
                                            </div>
                                            @if($product->marketable_number > 0)
                                            <div
                                                class="flex text-sm sm:text-sm items-center justify-center lg:justify-start">
                                                <div class="flex items-center justify-center select-none">
                                                    <div class="quantity flex items-center">
                                                        <input name="number" id="number"
                                                            class="w-12 h-7 mx-2 text-center border focus:outline-none rounded-lg cart-number"
                                                            type="number" min="1" step="1" value="1" readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="flex text-red-500">
                                                <div class="flex text-red-500" id="final-price"></div>
                                                تومان 
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                    <span class="flex justify-center items-center opacity-90">
                                        @if($product->marketable_number > 0)
                                        <button type="submit"
                                            class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm">افزودن
                                            به سبد خرید</button>
                                            @else
                                            <button class="px-7 py-2 text-center text-white bg-gray-500 align-middle border-0 rounded-lg shadow-md text-sm">ناموجود</button>
                                            @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
               
                <div class="flex justify-around my-5">
                    <div class="flex flex-col items-center justify-center">
                        <div>
                            <img src="{{ asset('front-assets/image/services/cash-on-delivery.svg') }}" alt="">
                        </div>
                        <div class="opacity-70 text-xs">
                            پرداخت در محل
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div>
                            <img src="{{ asset('front-assets/image/services/days-return.svg') }}" alt="">
                        </div>
                        <div class="opacity-70 text-xs">
                            قابل برگشت
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div>
                            <img src="{{ asset('front-assets/image/services/express-delivery.svg') }}" alt="">
                        </div>
                        <div class="opacity-70 text-xs">
                            ارسال سریع
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div>
                            <img src="{{ asset('front-assets/image/services/original-products.svg') }}" alt="">
                        </div>
                        <div class="opacity-70 text-xs">
                            ضمانت کالا
                        </div>
                    </div>
                </div>
              
                <!-- TABS -->
                <div class="mx-auto">
                    <div class="border-b border-gray-200 mb-4">
                        <ul class="flex justify-center flex-wrap -mb-px text-center" id="myTab"
                            data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 active"
                                    id="about-tab" data-tabs-target="#about" type="button" role="tab"
                                    aria-controls="about" aria-selected="true">درباره محصول</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2"
                                    id="details-tab" data-tabs-target="#details" type="button" role="tab"
                                    aria-controls="details" aria-selected="false">مشخصات</button>
                            </li>
                            @php
                            $commentsCount=App\Models\Content\Comment::where('commentable_type','App\Models\Market\Product')->where('approved',1)->where('commentable_id',$product->id)->count();
                            @endphp
                            <li role="presentation">
                                <button
                                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2"
                                    id="commentsBuy-tab" data-tabs-target="#commentsBuy" type="button" role="tab"
                                    aria-controls="commentsBuy" aria-selected="false">دیدگاه ها ({{$commentsCount}})</button>
                            </li>
                        </ul>
                    </div>
                    <div id="myTabContent">
                        {{-- description --}}
                        <div class="bg-gray-50 p-4 rounded-xl" id="about" role="tabpanel"
                            aria-labelledby="about-tab">
                            <span class="border-b-red-500 border-b">
                                معرفی کوتاه محصول
                            </span>
                            <p class="text-gray-500 text-sm leading-7 mt-3">

                                {!! $product->introduction !!}
                            </p>
                        </div>
                         {{-- details --}}
                        <div class="bg-gray-50 p-4 rounded-xl hidden" id="details" role="tabpanel"
                            aria-labelledby="details-tab">
                            <span class="border-b-red-500 border-b">
                                مشخصات فنی محصول
                            </span>
                            <div class="text-gray-500 text-sm grid grid-cols-1 gap-x-3 md:grid-cols-2">
                                @foreach ($product->CategoryValues()->get() as $value)
                                    <div
                                        class="flex items-center justify-between bg-gray-100 p-3 w-full my-3 mx-auto rounded-xl">
                                        <div class="text-xs opacity-80">
                                            {{ $value->attribute()->first()->name }}
                                        </div>
                                        <div class="text-xs opacity-70">
                                            {{ json_decode($value->value)->value }}
                                            {{ $value->attribute()->first()->unit }} </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- comments --}}
                        <div class="bg-gray-50 p-4 rounded-xl hidden" id="commentsBuy" role="tabpanel"
                            aria-labelledby="commentsBuy-tab">
                            <span class="border-b-red-500 border-b">
                                دیدگاه های محصول
                            </span>
                            <p class="text-gray-500 text-sm">
                            <div class="flex flex-col py-4 px-4 mx-auto my-6 max-w-7xl rounded-2xl bg-white">
                                <!-- UO COMMENTS -->
                                <div>
                                    <div>دیدگاه ها</div>
                                    <a href="{{route('front.market.add-comment.page',$product)}}" class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm" style="float:left">ارسال دیدگاه</a>
                                    <div class="opacity-70 text-xs">{{$commentsCount}} دیدگاه</div>
                                </div>
                                <!-- COMMENT -->
                                
                                @foreach ($product->activeComments() as $activeComment)
                                @php
                                $author = $activeComment->user()->first();
                                @endphp
                                <div class="bg-gray-50 rounded-xl px-3 sm:px-5 py-3 my-2" style="border: 1px solid #d7d7d7">
                                  
                                    
                                    <div class="d-flex flex-row-reverse">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal-{{$activeComment->id}}" data-bs-whatever="@mdo">
                                            پاسخ
                                        </button>
                                        <!-- start add replay Modal -->
                                        <div class="modal fade" id="exampleModal-{{$activeComment->id}}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <form action="{{route('front.market.add-replay',[$product,$activeComment])}}"
                                                                  id="form-{{$activeComment->id}}" method="POST">
                                                                @csrf
                                                                <label for="message-text"
                                                                       class="col-form-label">دیدگاه:</label>
                                                                <textarea class="form-control" id="message-text"
                                                                          name="body"></textarea>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                        <button type="submit" class="btn btn-primary"
                                                                onclick="document.getElementById('form-{{$activeComment->id}}').submit();">
                                                            ثبت
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end add replay Modal -->
                                    </div>

                                    <div class="flex flex-col items-stat gap-y-2">
                                        <div class="flex items-center">
                                            {{-- <div class="text-green-400 bg-green-100 px-1 rounded-md text-sm">
                                                4.7
                                            </div> --}}
                                            <div class="text-xs opacity-60 pr-1">
                                                ارسال شده توسط            
                                                
                                            @if(empty($author->first_name) && empty($author->last_name))
                                                {{$author->name}}
                                                @else
                                                {{ $author->first_name . ' ' . $author->last_name }}
                                            @endif
                                            </div>
                                            <div class="text-xs opacity-60 pr-1 @if($activeComment->answers()->count() > 0) border-bottom  @endif">
                                                {{ jalaliDate($activeComment->created_at) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="opacity-60 text-sm py-3">
                                        {{$activeComment->body}}
                                        </div>
                                        @foreach ($activeComment->activeAnswers() as $commentAnswer)
                                        @php
                                        $author = $commentAnswer->user()->first();
                                        @endphp
                                        <div class="bg-gray-50 rounded-xl px-3 sm:px-5 py-3 my-2" style="border: 1px solid rgba(249,128,128,var(--tw-border-opacity))">

                                            <div class="flex flex-col items-stat gap-y-2">
                                                <div class="flex items-center">
                                                    <div class="text-xs opacity-60 pr-1">
                                                        ارسال شده توسط            
                                                        
                                                    @if(empty($author->first_name) && empty($author->last_name))
                                                        {{$author->name}}
                                                        @else
                                                        {{ $author->first_name . ' ' . $author->last_name }}
                                                    @endif
                                                    </div>
                                                    <div class="text-xs opacity-60 pr-1">
                                                        {{ jalaliDate($commentAnswer->created_at) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="opacity-60 text-sm py-3">
                                                {{$commentAnswer->body}}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- related products --}}
                @if($relatedProducts->count() > 0)
                <!-- SLIDER -->
                <div class="bg-white rounded-2xl pt-10">
                    <!-- TOP SLIDER -->
                    <div class="flex justify-between px-5 md:px-10 items-center">
                        <div class="border-b-2 border-red-500 pb-1">مرتبط ترین ها</div>
                    </div>
                    <!-- SLIDER -->
                    <div class="containerPSlider swiper">
                        <div class="slide-container1 px-2">
                            <div class="card-wrapper swiper-wrapper py-4">
                                @foreach ($relatedProducts as $relatedProduct)
                                <span class="card swiper-slide my-2 p-2 md:p-3 ">
                                    <div class="image-box mb-6 ">
                                        <a href="{{route('front.market.product',$relatedProduct)}}">
                                            <img class="hover:scale-105 transition rounded-3xl w-full mx-auto"
                                                src="{{ asset($relatedProduct->image['indexArray']['medium']) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="space-y-3 text-center">
                                        <span class="text-sm opacity-80 mb-2 h-8 md:h-10">
                                            <a href="#">
                                                {{$relatedProduct->name}}
                                            </a>
                                        </span>
                                        <div class="flex justify-center mt-1 mb-2 text-sm">
                                            <div>{{$relatedProduct->price}}</div>
                                            <div>تومان</div>
                                        </div>
                                    </div>
                                </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-button-next swiper-navBtn"></div>
                        <div class="swiper-button-prev swiper-navBtn"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            bill();
            //input color
            $('input[name="color"]').change(function() {
                bill();
            })
            //guarantee
            $('select[name="guarantee"]').change(function() {
                bill();
            })
            //number
            $('.cart-number').click(function() {
                bill();
            })

        })

        function bill() {
            if ($('input[name="color"]:checked').length != 0) {
                var selected_color = $('input[name="color"]:checked');
                $("#selected_color_name").html(selected_color.attr('data-color-name'));
            }

            //price computing
            var selected_color_price = 0;
            var selected_guarantee_price = 0;
            var number = 1;
            var product_discount_price = 0;
            var product_original_price = parseFloat($('#product_price').attr('data-product-original-price'));
            var amazing_sale_percentage = parseFloat($('#product_price').attr('data-amazing-sale'));

            if ($('input[name="color"]:checked').length != 0) {
                selected_color_price = parseFloat(selected_color.attr('data-color-price'));
            }

            if ($('#guarantee option:selected').length != 0) {
                selected_guarantee_price = parseFloat($('#guarantee option:selected').attr('data-guarantee-price'));

            }

            if ($('#number').val() > 0) {
                number = parseFloat($('#number').val());
            }

            if ($('#product-discount-price').length != 0) {
                {{-- product_discount_price = parseFloat($('#product-discount-price').attr('data-product-discount-price')); --}}
                product_discount_price = (product_original_price + selected_color_price + selected_guarantee_price) * amazing_sale_percentage /100 ;

            }

            //final price
            var product_price = product_original_price + selected_color_price + selected_guarantee_price;
            var final_price = number * (product_price - product_discount_price);

            $('#product_price').html(toFarsiNumber(product_price));
            $('#final-price').html(toFarsiNumber(final_price));
        }



        function toFarsiNumber(number) {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }
    </script>


    <script>
        $('.product-add-to-favorite').click(function() {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function(result) {
                    if (result.status == 1) {
                        $(element).children().first().removeClass('fill-current');
                        $(element).children().first().addClass('full-current');
                        $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('full-current')
                        $(element).children().first().addClass('fill-current')
                        $(element).attr('data-original-title', 'افزودن به علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'افزودن به علاقه مندی ها');
                    }
                }
            })
        })
    </script>


    <script>
        $('.product-add-to-compare').click(function() {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function(result) {
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-original-title', 'حذف از لیست مقایسه');
                        $(element).attr('data-bs-original-title', 'حذف از لیست مقایسه');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger')
                        $(element).attr('data-original-title', 'اضافه به لیست مقایسه');
                        $(element).attr('data-bs-original-title', 'اضافه به لیست مقایسه');
                    }
                }
            })
        })
    </script>


    <!--DROPDOWNS FOR NAVBAR-->
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <!--MOBILE NAVBAR-->
    <script src="{{ asset('front-assets/js/navbar.js') }}"></script>
    <!-- SHOW MODAL SEARCH -->
    <script src="{{ asset('front-assets/js/searchBox.js') }}"></script>
    <!-- TOAST -->
    <script src="{{ asset('front-assets/js/toastify.js') }}"></script>
    <!-- PRODUCT SLIDER -->
    <script src="{{ asset('front-assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/scriptSlider.style.js') }}"></script>
    <!-- showImageSingleProduct -->
    <script src="{{ asset('front-assets/js/showImageSingleProduct.js') }}"></script>
    <!-- TABS -->
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
    <!-- INPUTS ADD NUMBER -->
    <script src="{{ asset('front-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/main.js') }}"></script>
@endsection
