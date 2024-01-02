@extends('admin.layouts.master')


@section('head-tag')
<title>ویرایش برند ها</title>
@endsection


@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">

<div class="card-header">
    <h3 class="card-title">ویرایش برند</h3>

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
    <form action="{{route('admin.market.brand.update',$brand)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
      <!-- text input -->
      <div class="form-group">
        <label>نام انگلیسی</label>
        <input type="text" class="form-control" name="original_name" value="{{ old('original_name', $brand->original_name) }}">
        @error('original_name')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <label>نام فارسی</label>
        <input type="text" class="form-control" name="persian_name" value="{{ old('persian_name', $brand->persian_name) }}">
        @error('persian_name')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>


        <div class="form-group">
            <label for="image">تصویر</label>
            <input type="file" class="form-control form-control-sm" name="logo" id="image">
        </div>
        @error('image')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
        @enderror

        <section class="row">
            @php
                $number = 1;
            @endphp
            @foreach ($brand->logo['indexArray'] as $key => $value )
                <section class="col-md-{{ 6 / $number }}">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="currentImage" value="{{ $key }}" id="{{ $number }}" @if($brand->logo['currentImage'] == $key) checked @endif>
                        <label for="{{ $number }}" class="form-check-label mx-2">
                            <img src="{{ asset($value) }}" class="w-100" alt="">
                        </label>
                    </div>
                </section>
                @php
                    $number++;
                @endphp
            @endforeach
        </section>

      <div class="form-group">
        <label>وضعیت</label>
        <select class="form-control" name="status">
          <option @if(old('status', $brand->status) == 1) selected @endif value="1">فعال</option>
          <option @if(old('status', $brand->status) == 0) selected @endif value="0">غیر فعال</option>
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