@extends('admin.layouts.master')


@section('head-tag')
    <title>ایجاد کد تخفیف</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ایجاد کد تخفیف</h3>

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
                        <a href="{{ route('admin.market.discount.copan') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <form action="{{ route('admin.market.discount.copan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">کد کوپن</label>
                            <input type="text" name="code"
                                value="{{ old('code') }}"class="form-control form-control-sm">
                            @error('code')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">نوع کوپن</label>
                            <select name="type" id="type" class="form-control form-control-sm">
                                <option value="0" @if (old('type') == 0) selected @endif>عمومی</option>
                                <option value="1" @if (old('type') == 1) selected @endif>خصوصی</option>
                            </select>
                            @error('type')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">کاربران</label>
                            <select name="user_id" id="users" class="form-control form-control-sm" disabled>
                                @foreach ($users as $user)
                                    <option @if (old('user_id') == $user->id) selected @endif value="{{ $user->id }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">نوع تخفیف</label>
                            <select name="amount_type" id="amount_type" class="form-control form-control-sm">
                                <option value="0" @if (old('amount_type') == 0) selected @endif>درصدی</option>
                                <option value="1" @if (old('amount_type') == 1) selected @endif>عددی</option>
                            </select>
                            @error('amount_type')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">میزان تخفیف</label>
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
                            <label for="">حداکثر تخفیف</label>
                            <input type="text" name="discount_ceiling" value="{{ old('discount_ceiling') }}"
                                class="form-control form-control-sm">
                            @error('discount_ceiling')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">تاریخ شروع</label>
                            <input type="text" value="{{ old('start_date') }}" name="start_date" id="start_date"
                                class="form-control form-control-sm d-none">
                            <input type="text" value="{{ old('start_date') }}" id="start_date_view"
                                class="form-control form-control-sm">
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
                            <input type="text" value="{{ old('end_date') }}" name="end_date" id="end_date"
                                class="form-control form-control-sm d-none">
                            <input type="text" value="{{ old('end_date') }}" id="end_date_view"
                                class="form-control form-control-sm">
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
                                <option value="0" @if (old('status') == 0) selected @endif>غیرفعال</option>
                                <option value="1" @if (old('status') == 1) selected @endif>فعال</option>
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


<script>
    $("#type").change(function(){

    if($('#type').find(':selected').val() == '1') {
        $('#users').removeAttr('disabled');
    }
    else{
        $('#users').attr('disabled', 'disabled');

    }

});

</script>



@endsection

