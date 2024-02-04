@extends('front.layouts.master')

@section('head-tag')
    <title>آدرس های من</title>
@endsection


@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <a class="d-flex justify-content-end btn btn-link btn-sm text-info text-decoration-none mx-1"
                data-bs-toggle="modal" data-bs-target="#add-address"><i class="fa fa-edit px-1"></i>ایجاد آدرس جدید</a>
            <div class="flex flex-col md:flex-row gap-5">
                @include('front.layouts.partials.profile-sidebar')
                <div class="md:w-8/12 lg:w-9/12 flex flex-col gap-y-5">
                @forelse ($addresses as $address)
                        <div class="border rounded-3xl shadow-lg flex flex-col p-5 gap-y-5">
                            <div>
                                <div class="opacity-80">
                                    {{ $address->address }}
                                </div>
                            </div>
                            <div class="md:grid grid-cols-2">
                                <div>
                                    <div class="text-xs opacity-80 mb-1">
                                       نام تحویل گیرنده :
                                    </div>
                                    <div class="text-sm opacity-90">
                                        {{ $address->recipient_name ?? '-' }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="text-xs opacity-80 mb-1">
                                        شماره تلفن همراه:
                                    </div>
                                    <div class="text-sm opacity-90">
                                        {{ $address->mobile ?? '-' }}
                                    </div>
                                </div>
                            </div>
                            <div class="md:grid grid-cols-2">
                                <div>
                                    <div class="text-xs opacity-80 mb-1">
                                        کد پستی:
                                    </div>
                                    <div class="text-sm opacity-90">
                                        {{ $address->postal_code }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs opacity-80 mb-1">
                                        شهر و استان :
                                    </div>
                                    <div class="text-sm opacity-90">
                                        {{ $address->city.'-'.$address->province }}
                                    </div>
                                </div>
                            </div>
                            <div class="md:grid grid-cols-2">
                                <div>
                                    <div class="text-xs opacity-80 mb-1">
                                        واحد:
                                    </div>
                                    <div class="text-sm opacity-90">
                                        {{ $address->unit ?? '-' }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs opacity-80 mb-1">
                                        پلاک:
                                    </div>
                                    <div class="text-sm opacity-90">
                                        {{ $address->no ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <span class="opacity-90">
                                <button
                                    class="px-7 py-2 text-center text-white bg-blue-500 align-middle border-0 rounded-lg shadow-md text-sm"
                                    data-bs-toggle="modal" data-bs-target="#edit-address-{{ $address->id }}">ویرایش
                                    آدرس</button>
                                <a href="{{ route('front.profile.addresses.delete', $address) }}"
                                    class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm">حذف</a>
                            </span>
                        </div>

                    <!-- start edit address Modal -->
                    <section class="modal fade" id="edit-address-{{ $address->id }}" tabindex="-1"
                        aria-labelledby="add-address-label" aria-hidden="true">
                        <section class="modal-dialog">
                            <section class="modal-content">
                                <section class="modal-header">
                                    <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ویرایش آدرس
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </section>
                                <section class="modal-body">
                                    <form class="row" method="post"
                                        action="{{ route('front.profile.addresses.update', $address) }}">
                                        @csrf
                                        @method('PUT')

                                        <section class="col-12 mb-2">
                                            <label for="address" class="form-label mb-1">نشانی</label>
                                            <textarea name="address" class="form-control form-control-sm" id="address" placeholder="نشانی">
                                                {{ old('address',$address->address)}}
                                            </textarea>
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
                                            <input value="{{ old('mobile',$address->mobile)}}" type="text"
                                                name="mobile" class="form-control form-control-sm" id="mobile"
                                                placeholder="شماره موبایل">
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
                                            <input value="{{ old('recipient_name',$address->recipient_name)}}" type="text"
                                                name="recipient_name" class="form-control form-control-sm" id="recipient_name"
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
                                            <input value="{{ old('city',$address->city)}}" type="text"
                                                name="city" class="form-control form-control-sm" id="city"
                                                placeholder="شهر">
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
                                            <input value="{{ old('province',$address->province)}}" type="text"
                                                name="province" class="form-control form-control-sm" id="province"
                                                placeholder="استان">
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
                                            <input value="{{ old('postal_code',$address->postal_code)}}" type="text" name="postal_code"
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
                                            <input type="text" value="{{ old('no',$address->no)}}" name="no"
                                                class="form-control form-control-sm" id="no" placeholder="پلاک">
                                                @error('no')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>

                                        <section class="col-3 mb-2">
                                            <label for="unit" class="form-label mb-1">واحد</label>
                                            <input type="text" value="{{ old('unit',$address->unit)}}" name="unit"
                                                class="form-control form-control-sm" id="unit" placeholder="واحد">
                                                @error('unit')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </section>

                                </section>
                                <section class="modal-footer py-1">
                                    <button type="submit" class="btn btn-sm btn-primary">ثبت
                                        آدرس</button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-dismiss="modal">بستن</button>
                                </section>
                                </form>

                            </section>
                        </section>
                    </section>
                    <!-- end add address Modal -->




                @empty

                    <div class="md:w-8/12 lg:w-9/12 flex flex-col gap-y-5">
                        <div class="border rounded-3xl shadow-lg flex flex-col p-5 gap-y-5">
                            ایتمی یافت نشد
                        </div>
                    </div>
                @endforelse
            </div>

                    <!-- start add address Modal -->
                    <section class="modal fade" id="add-address" tabindex="-1" aria-labelledby="add-address-label"
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
                                    <form class="row" method="post"
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
                                                class="form-control form-control-sm" id="mobile"
                                                placeholder="شماره موبایل">
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
                                            <input value="{{ old('recipient_name') }}" type="text"
                                                name="recipient_name" class="form-control form-control-sm" id="recipient_name"
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
                                            <input value="{{ old('recipient_name') }}" type="text"
                                                name="city" class="form-control form-control-sm" id="city"
                                                placeholder="شهر">
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
                                            <input value="{{ old('province') }}" type="text"
                                                name="province" class="form-control form-control-sm" id="province"
                                                placeholder="استان">
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
                                                class="form-control form-control-sm" id="postal_code"
                                                placeholder="کد پستی">
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

                                </section>
                                <section class="modal-footer py-1">
                                    <button type="submit" class="btn btn-sm btn-primary">ثبت
                                        آدرس</button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-dismiss="modal">بستن</button>
                                </section>
                                </form>

                            </section>
                        </section>
                    </section>
                    <!-- end add address Modal -->

            </div>
        </div>
    </div>
@endsection
