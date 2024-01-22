@extends('front.layouts.master')

@section('head-tag')
    <title>لیست مقایسه شما</title>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <div class="flex flex-col md:flex-row gap-5">

                @include('front.layouts.partials.profile-sidebar')

                <div class="md:w-8/12 lg:w-9/12">
                    <div class="rounded-xl">

                        @forelse (auth()->user()->compare->products as $product)
                            <div class="py-4 my-3 border-b">

                                <h3 class="opacity-80 px-2 lg:px-10 xl:px-16 mb-5 text-sm md:text-base">
                                    <div class="mb-3">
                                        <img class="rounded-2xl w-52"
                                            src="{{ asset($product->image['indexArray']['medium']) }}" alt="">
                                    </div>
                                </h3>
                                <h3 class="opacity-80 px-2 lg:px-10 xl:px-16 mb-5 text-sm md:text-base">
                                    <div class="mb-3">
                                        {{ $product->name }}
                                    </div>
                                </h3>
                                <h3 class="opacity-80 px-2 lg:px-10 xl:px-16 mb-5 text-sm md:text-base">
                                    <div class="mb-3">
                                        قیمت : {{ PriceFormat($product->price) }} تومان
                                    </div>
                                </h3>
                                @foreach ($product->CategoryValues()->get() as $value)
                                    <h3 class="opacity-80 px-2 lg:px-10 xl:px-16 mb-5 text-sm md:text-base">
                                        {{ $value->attribute()->first()->name }} :
                                        {{ json_decode($value->value)->value }}
                                        {{ $value->attribute()->first()->unit }}
                                    </h3>
                                @endforeach

                                @foreach ($product->metas()->get() as $meta)
                                    <h3 class="opacity-80 px-2 lg:px-10 xl:px-16 mb-5 text-sm md:text-base">
                                        {{ $meta->meta_key }} : {{ $meta->meta_value }}
                                    </h3>
                                @endforeach

                                <h3 class="opacity-80 px-2 lg:px-10 xl:px-16 mb-5 text-sm md:text-base">
                                    <a class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm" href="{{route('front.profile.compares.delete',$product)}}">
                                        حذف 
                                    </a>
                                </h3>
                            </div>

                            @empty

                                <div class="border rounded-3xl shadow-lg flex flex-col p-5 gap-y-5">
                                    ایتمی یافت نشد
                                </div>
                        @endforelse

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
