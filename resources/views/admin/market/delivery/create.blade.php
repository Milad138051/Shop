@extends('admin.layouts.master')


@section('head-tag')
    <title>ایجاد روش ارسال</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ایجاد روش ارسال</h3>

                    {{-- <div class="card-tools">
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
                        <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info">بازگشت</a>
                    </section>

                    <form action="{{ route('admin.market.delivery.store') }}" method="post" enctype="multipart/form-data"
                        id="form">
                        @csrf

                        <div class="form-group">
                            <label for="">نام روش ارسال</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control form-control-sm">
                            @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">هزینه روش ارسال</label>
                            <input type="text" name="amount" value="{{ old('amount') }}"
                                class="form-control form-control-sm">

                            @error('amount')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">زمان ارسال</label>
                            <input type="text" name="delivery_time" value="{{ old('delivery_time') }}"
                                class="form-control form-control-sm">
                            @error('delivery_time')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">واحد زمان ارسال</label>
                            <input type="text" name="delivery_time_unit" value="{{ old('delivery_time_unit') }}"
                                class="form-control form-control-sm">
                            @error('delivery_time_unit')
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
