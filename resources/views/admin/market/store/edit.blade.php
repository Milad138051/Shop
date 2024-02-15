@extends('admin.layouts.master')


@section('head-tag')
    <title>انبار</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> ویرایش انبار برای ({{$product->name}})</h3>

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
                        <a href="{{ route('admin.market.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <form action="{{ route('admin.market.store.update', $product->id) }}" method="POST">
                        @method('put')
                        @csrf

                        <div class="form-group">
                            <label for="">تعداد قابل فروش</label>
                            <input type="text" name="marketable_number" value="{{ old('marketable_number', $product->marketable_number) }}" class="form-control form-control-sm">
                            @error('marketable_number')
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


