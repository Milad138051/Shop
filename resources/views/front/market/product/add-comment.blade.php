@extends('front.layouts.master')

@section('head-tag')
    <title>{{ $product->name }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('front-assets/css/bootstrap/bootstrap.min.css') }}"> --}}

@endsection


@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <div class="bg-white mx-5 rounded-2xl my-4 grid place-items-center">
                <div class="w-11/12 mx-auto rounded">
                    <div class="py-3">
                        <div class="lg:flex flex-row mb-16">
                            <!-- Product Thumbnail-->
                            <div class="lg:basis-1/3">
                                <div class="text-center">
                                    <a href="{{ route('front.market.product', $product) }}" class="flex flex-col gap-y-3">
                                        <img src="{{ asset($product->image['indexArray']['medium']) }}"
                                            class="lg:rounded-xl mx-auto w-[320px] hover:scale-105 transition"
                                            alt="" />
                                    </a>
                                </div>
                            </div>
                            <!-- Product Info -->
                            {{-- //review --}}
                            <div class="lg:basis-2/3 pb-5">
                                <div class="opacity-80 text-lg font-semibold">
                                    {{ $product->name }}
                                </div>
                                @if($product->CategoryValues()->count() >0 )
                                <form action="{{ route('front.market.add-review', $product) }}" method="post">
                                <div class="lg:flex flex-wrap gap-y-5 justify-center">
                                            @csrf
                                            @foreach ($product->CategoryValues()->get() as $value)
                                                <div class="lg:basis-1/2 mb-3 text-center"
                                                    id="div-{{ $value->attribute()->first()->id }}">
                                                    <div class="py-3 pr-5 text-right text-sm opacity-80">
                                                        {{ $value->attribute()->first()->name }}
                                                    </div>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="category_attribute_ids[]"
                                                        value="{{ $value->attribute()->first()->id }}">
                                                    <input type="range" min="1" max="5"
                                                        name="attributeScores[]" value="" class="w-full md:w-10/12"
                                                        id="{{ $value->attribute()->first()->name }}">
                                                    <div
                                                        class="flex w-full mx-auto text-xs opacity-75 md:justify-around justify-between">
                                                        <div data-value="1">خیلی بد</div>
                                                        <div data-value="2" class="md:mr-7">ضعیف</div>
                                                        <div data-value="3" class="md:mr-12">متوسط</div>
                                                        <div data-value="4" class="md:mr-14">خوب</div>
                                                        <div data-value="5" class="md:mr-14">عالی</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <button class="inline-block px-8 py-2 my-1 font-semibold leading-normal text-center text-white bg-red-500 align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs active:opacity-85" type="submit">ثبت</button>
                                        </form>
                                        @endif
                                </div>
                            </div>
                        </div>


                        {{-- comment --}}
                        <div class="lg:flex flex-row">
                            <div class="lg:basis-1/2">
                                <form action="{{route('front.market.add-comment',$product)}}" method="POST">
                                    @csrf
                                    <div>

                                        <div class="md:px-10 mb-3">
                                            <label for="first name"
                                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">متن نظر
                                            </label>
                                            <div class="form-row">
                                                <textarea name="body" placeholder="متن خود را بنویسید" cols="30" rows="5"
                                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></textarea>
                                            </div>
                                        </div>

                                        <div class="px-10">
                                            <p class="mb-1">
                                                با “ثبت دیدگاه” موافقت خود را با
                                                <a href="#" class="border-b text-red-500 hover:text-red-600"
                                                    target="">قوانین ایران مارکت</a>
                                                اعلام می‌کنم.
                                            </p>
                                            <button type="submit"
                                                class="inline-block px-8 py-2 my-1 font-semibold leading-normal text-center text-white bg-red-500 align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs active:opacity-85">ثبت
                                                دیدگاه</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="lg:basis-1/2 mt-5 lg:mt-0">
                                <div class="opacity-80 mb-2">
                                    دیگران را با نوشتن نظرات خود، برای انتخاب این محصول راهنمایی کنید.
                                </div>
                                <div class="opacity-75 text-sm">
                                    لطفا پیش از ارسال نظر، خلاصه قوانین زیر را مطالعه کنید:
                                </div>
                                <div class="opacity-70 text-sm leading-8">
                                    لازم است محتوای ارسالی منطبق برعرف و شئونات جامعه و با بیانی رسمی و عاری از لحن تند،
                                    تمسخرو توهین باشد.
                                    از ارسال لینک‌ سایت‌های دیگر و ارایه‌ی اطلاعات شخصی نظیر شماره تماس، ایمیل و آی‌دی
                                    شبکه‌های اجتماعی پرهیز کنید.
                                    در نظر داشته باشید هدف نهایی از ارائه‌ی نظر درباره‌ی کالا ارائه‌ی اطلاعات مشخص و مفید
                                    برای راهنمایی سایر کاربران در فرآیند انتخاب و خرید یک محصول است.
                                    با توجه به ساختار بخش نظرات، از پرسیدن سوال یا درخواست راهنمایی در این بخش خودداری کرده
                                    و سوالات خود را در بخش «پرسش و پاسخ» مطرح کنید.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- TOAST -->
    <script src="{{ asset('front-assets/js/toastify.js') }}"></script>
    <!-- MAIN -->
    <script src="{{ asset('front-assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <!--MOBILE NAVBAR-->
    <script src="{{ asset('front-assets/js/navbar.js') }}"></script>
    <!-- SHOW MODAL SEARCH -->
    <script src="{{ asset('front-assets/js/searchBox.js') }}"></script>
    <!-- GOOD AND BAD -->
    <script src="{{ asset('front-assets/js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('admin-assets/bootstrap/js/bootstrap.min.js') }}"></script> --}}

@endsection
