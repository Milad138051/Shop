@extends('admin.layouts.master')


@section('head-tag')
    <title>ویرایش تخفیف عمومی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ویرایش تخفیف عمومی</h3>

                        {{-- <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="جستجو">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div> --}}
                </div>

                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.market.discount.commonDiscount') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <form action="{{ route('admin.market.discount.commonDiscount.update', $commonDiscount->id) }}" method="post">
                        @method('put')
                        @csrf


                        <div class="form-group">
                            <label for="">درصد تخفیف</label>
                            <input type="text" class="form-control form-control-sm" name="percentage" value="{{ old('percentage', $commonDiscount->percentage) }}">
                            @error('percentage')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>



                        <div class="form-group">
                            <label for="">حداکثر تخفیف</label>
                            <input type="text" name="discount_ceiling" value="{{ old('discount_ceiling', $commonDiscount->discount_ceiling) }}" class="form-control form-control-sm">
                            @error('discount_ceiling')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>


                        <div class="form-group">
                            <label for="">حداقل مبلغ خرید</label>
                            <input type="text" name="minimal_order_amount" value="{{ old('minimal_order_amount', $commonDiscount->minimal_order_amount) }}" class="form-control form-control-sm">
                            @error('minimal_order_amount')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>


                        <div class="form-group">
                            <label for="">عنوان مناسبت</label>
                            <input type="text" name="title" value="{{ old('title', $commonDiscount->title) }}" class="form-control form-control-sm">
                            @error('title')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>


                        <div class="form-group">
                            <label for="">تاریخ شروع</label>
                            <input type="text" name="start_date" value="{{old('start_date',$commonDiscount->start_date)}}" id="start_date" class="form-control form-control-sm d-none">
                            <input type="text" value="{{old('start_date',$commonDiscount->start_date)}}" id="start_date_view" class="form-control form-control-sm">
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
                            <input type="text" name="end_date" value="{{old('end_date',$commonDiscount->end_date)}}" id="end_date" class="form-control form-control-sm d-none">
                            <input type="text" value="{{old('end_date',$commonDiscount->end_date)}}"  id="end_date_view" class="form-control form-control-sm">
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
                                <option value="0" @if (old('status', $commonDiscount->status) == 0) selected @endif>غیرفعال</option>
                                <option value="1" @if (old('status', $commonDiscount->status) == 1) selected @endif>فعال</option>
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

