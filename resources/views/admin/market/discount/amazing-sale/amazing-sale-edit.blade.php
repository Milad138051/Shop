@extends('admin.layouts.master')


@section('head-tag')
    <title>ویرایش فروش شگفت انگیز</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ویرایش فروش شگفت انگیز</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="جستجو">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.market.discount.amazingSale') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <form action="{{ route('admin.market.discount.amazingSale.update',$amazingSale) }}" method="post">
                        @csrf

                        @method('put')

                        <div class="form-group">
                            <label for="">انتخاب کالا</label>
                            <select name="product_id" id="" class="form-control form-control-sm">
                                <option value="">کالا را انتخاب کنید</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}" @if(old('product_id',$amazingSale->product_id) == $product->id) selected @endif>{{ $product->name }}</option>
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
                            <label for="">درصد تخفیف</label>
                            <input type="text" class="form-control form-control-sm" name="percentage" value="{{ old('percentage',$amazingSale->percentage) }}">
                            @error('percentage')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>



                        <div class="form-group">
                            <label for="">تاریخ شروع</label>
                            <input type="text" name="start_date" id="start_date" class="form-control form-control-sm d-none" value="{{old('start_date',$amazingSale->start_date)}}">
                            <input type="text" id="start_date_view" class="form-control form-control-sm" value="{{old('start_date',$amazingSale->start_date)}}">
                            @error('start_date')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>


                        <div class="form-group">
                            <label for="">تاریخ پایان</label>
                            <input type="text" name="end_date" id="end_date" class="form-control form-control-sm d-none" value="{{old('end_date',$amazingSale->end_date)}}">
                            <input type="text" id="end_date_view" class="form-control form-control-sm"  value="{{old('end_date',$amazingSale->end_date)}}">
                            @error('end_date')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>


                        <div class="form-group">
                            <label for="status">وضعیت</label>
                            <select name="status" id="" class="form-control form-control-sm" id="status">
                                <option value="0" @if(old('status',$amazingSale->status) == 0) selected @endif>غیرفعال</option>
                                <option value="1" @if(old('status',$amazingSale->status) == 1) selected @endif>فعال</option>
                            </select>
                            @error('status')
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


@section('script')

    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>


    <script>
            $(document).ready(function () {
                $('#start_date_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#start_date'
                }),
                 $('#end_date_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#end_date'
                })
            });
    </script>
@endsection

