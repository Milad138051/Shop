@extends('front.layouts.master')

@section('head-tag')
    <title>سبد خرید</title>
@endsection


@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <li>{{ $error }}</li>
                        </div>
                    @endforeach
                </ul>
            @endif

            <div>
                <div class="text-lg md:text-xl opacity-70 mb-3">
                    انتخاب آدرس و روش ارسال
                </div>
                <form action="{{ route('front.sales-process.choose-address-and-delivery') }}" id="a-form-final">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 px-5 md:px-20">
                        {{-- address                     --}}
                        <div class="mb-4">
                            @if ($addresses->count() > 0)
                                <label for="address"
                                    class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">آدرس:</label>
                                <select name="address_id" id="address" required
                                    class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300">
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}">
                                            {{ $address->city . '-' . $address->province . '-' . $address->address . '- پلاک ' . $address->no . '- واحد ' . $address->unit }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('address_id')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            @else
                                <a href="" class="btn btn sm btn-danger block w-full rounded-lg px-3 py-2 mt-4"
                                    data-bs-toggle="modal" data-bs-target="#add-addres">ایجاد
                                    ادرس جدید</a>
                            @endif
                        </div>
                        {{-- //delivery --}}
                        <div class="mb-4">
                            <label for="delivery" class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">روش
                                ارسال:</label>
                            <select name="delivery_id" id="delivery" required
                                class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300">
                                @foreach ($deliveryMethods as $method)
                                    <option value="{{ $method->id }}">
                                        {{ $method->name . ' با هزینه ' . PriceFormat($method->amount) . ' تومان' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('delivery_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </form>


                <!-- start add address Modal -->
                <section class="modal fade" id="add-addres" tabindex="-1" aria-labelledby="add-address-label"
                    aria-hidden="true">
                    <section class="modal-dialog">
                        <section class="modal-content">
                            <section class="modal-header">
                                <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ایجاد آدرس
                                    جدید</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </section>
                            <section class="modal-body">
                                <form class="row" method="post" id="a-form"
                                    action="{{ route('front.profile.add-address') }}">
                                    @csrf

                                    <section class="col-12 mb-2">
                                        <label for="address" class="form-label mb-1">نشانی</label>
                                        <textarea name="address" class="form-control form-control-sm" id="address" placeholder="نشانی">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                    <section class="col-12 mb-2">
                                        <label for="mobile" class="form-label mb-1">شماره
                                            موبایل</label>
                                        <input value="{{ old('mobile') }}" type="text" name="mobile"
                                            class="form-control form-control-sm" id="mobile" placeholder="شماره موبایل">
                                        @error('mobile')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                    <section class="col-12 mb-2">
                                        <label for="recipient_name" class="form-label mb-1">
                                            نام تحویل گیرنده</label>
                                        <input value="{{ old('recipient_name') }}" type="text" name="recipient_name"
                                            class="form-control form-control-sm" id="recipient_name"
                                            placeholder="نام تحویل گیرنده">
                                        @error('recipient_name')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                    <section class="col-12 mb-2">
                                        <label for="city" class="form-label mb-1">
                                            شهر</label>
                                        <input value="{{ old('recipient_name') }}" type="text" name="city"
                                            class="form-control form-control-sm" id="city" placeholder="شهر">
                                        @error('city')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                    <section class="col-12 mb-2">
                                        <label for="province" class="form-label mb-1">
                                            استان</label>
                                        <input value="{{ old('province') }}" type="text" name="province"
                                            class="form-control form-control-sm" id="province" placeholder="استان">
                                        @error('province')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="col-6 mb-2">
                                        <label for="postal_code" class="form-label mb-1">کد
                                            پستی</label>
                                        <input value="{{ old('postal_code') }}" type="text" name="postal_code"
                                            class="form-control form-control-sm" id="postal_code" placeholder="کد پستی">
                                        @error('postal_code')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="col-3 mb-2">
                                        <label for="no" class="form-label mb-1">پلاک</label>
                                        <input type="text" value="{{ old('no') }}" name="no"
                                            class="form-control form-control-sm" id="no" placeholder="پلاک">
                                    </section>

                                    <section class="col-3 mb-2">
                                        <label for="unit" class="form-label mb-1">واحد</label>
                                        <input type="text" value="{{ old('unit') }}" name="unit"
                                            class="form-control form-control-sm" id="unit" placeholder="واحد">
                                        @error('unit')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                </form>
                            </section>

                            <section class="modal-footer py-1">
                                <button type="submit" form="a-form" class="btn btn-sm btn-primary">ثبت
                                    آدرس</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-bs-dismiss="modal">بستن</button>
                            </section>
                        </section>
                    </section>
                </section>
                <!-- end add address Modal -->
                </form>
            </div>


            <div class="border shadow-xl rounded-2xl mx-auto max-w-xl mt-7 flex flex-col gap-y-5 py-5 px-5 md:px-20">
                <div class="flex justify-between">
                    @php
                        $totalProductPrice = 0;
                        $totalDiscount = 0;
                    @endphp

                    @foreach ($cartItems as $cartItem)
                        @php
                            $totalProductPrice += $cartItem->cartItemProductPrice() * $cartItem->number;
                            $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->number;
                        @endphp
                    @endforeach
                    <div>
                        قیمت کالاها ({{ $cartItem->count() }}):
                    </div>
                    <div class="flex gap-x-1">
                        <div id="total_product_price">
                            {{ priceFormat($totalProductPrice) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <div>
                        تخفیف کالاها
                    </div>
                    <div class="flex gap-x-1">
                        <div id="total_discount">
                            {{ priceFormat($totalDiscount) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="text-red-600">
                        مجموع نهایی:
                    </div>
                    <div class="flex gap-x-1">
                        <div id="total_price">
                            {{ priceFormat($totalProductPrice - $totalDiscount) }}
                        </div>
                        <div>
                            تومان
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center opacity-90 my-5">
                <button
                    class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm"
                    form="a-form-final" type="submit">ثبت
                    و پرداخت</button>
            </div>
        </div>
    </div>
@endsection
