@extends('admin.layouts.master')


@section('head-tag')
    <title>ایجاد گالری کالا</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">

@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ایجاد گالری کالا ({{$product->name}})</h3>

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
                        <a href="{{ route('admin.market.product.gallery.index',$product) }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>


                    <form action="{{ route('admin.market.product.gallery.store',$product) }}" method="post" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        <div class="form-group">
                            <label for="image">تصویر</label>
                            <input type="file" class="form-control form-control-sm" name="image" id="image">
                            @error('image')

                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                               <strong>{{$message}}</strong>
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
