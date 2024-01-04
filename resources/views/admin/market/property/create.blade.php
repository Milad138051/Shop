@extends('admin.layouts.master')


@section('head-tag')
    <title>ایجاد فرم کالا</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ایجاد فرم کالا</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.market.property.index') }}" class="btn btn-info">بازگشت</a>
                    </section>

                    <form action="{{ route('admin.market.property.store') }}" method="post" enctype="multipart/form-data"
                        id="form">
                        @csrf

                        <div class="form-group">
                            <label for="">نام فرم</label>
                            <input name="name" type="text" class="form-control form-control-sm"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="">واحد اندازه گیری</label>
                            <input name="unit" type="text" class="form-control form-control-sm"
                                value="{{ old('unit') }}">
                            @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">دسته والد</label>
                            <select name="category_id" id="" class="form-control form-control-sm">
                                <option value="">دسته را انتخاب کنید</option>
                                @foreach ($productCategories as $productCategory)
                                    <option value="{{ $productCategory->id }}"
                                        @if (old('category_id') == $productCategory->id) selected @endif>
                                        {{ $productCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
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
