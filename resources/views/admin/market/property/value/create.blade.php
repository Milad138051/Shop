@extends('admin.layouts.master')


@section('head-tag')
    <title>مقدار فرم کالا</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">مقدار فرم کالا ({{ $categoryAttribute->name }})</h3>
{{-- 
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="card-body">

                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.market.property.value.index',$categoryAttribute) }}" class="btn btn-info">بازگشت</a>
                    </section>
                    
                    <form action="{{ route('admin.market.property.value.store', $categoryAttribute->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">انتخاب محصول</label>
                            <select name="product_id" id="" class="form-control form-control-sm">
                                <option value=""> محصول را انتخاب کنید</option>
                                @foreach ($categoryAttribute->category->products as $product)
                                    <option value="{{ $product->id }}" @if (old('product_id') == $product->id) selected @endif>
                                        {{ $product->name }}</option>
                                @endforeach
                            </select>

                            @error('product_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">مقدار</label>
                            <input type="text" name="value" value="{{ old('value') }}"
                                class="form-control form-control-sm">
                            @error('value')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">افزایش قیمت</label>
                            <input type="text" name="price_increase" value="{{ old('price_increase') }}"
                                class="form-control form-control-sm">
                            @error('price_increase')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-success text-white">ثبت</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
