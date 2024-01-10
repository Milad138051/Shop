@extends('admin.layouts.master')


@section('head-tag')
    <title>ویرایش بنر</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ویرایش بنر</h3>

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
                        <a href="{{ route('admin.market.banner.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <form action="{{ route('admin.market.banner.update',$banner) }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="">عنوان بنر</label>
                            <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title',$banner->title) }}">
                            @error('title')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="url">آدرس URL</label>
                            <input type="text" name="url" class="form-control form-control-sm" value="{{old('url',$banner->url)}}">
                            @error('url')

                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
    
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="image">تصویر</label>
                            <input type="file" class="form-control form-control-sm" name="image" id="image">
                            <img src="{{ asset($banner->image) }}" alt="" width="100" height="50" class="mt-3">

                            @error('image')

                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                               <strong>{{$message}}</strong>
                             </span>
     
                             @enderror
                        </div>


                        <div class="form-group">
                            <label for="status">وضعیت</label>
                            <select name="status" id="status" class="form-control form-control-sm" id="status">
                                <option value="0" @if(old('status',$banner->status)==0) selected @endif>غیرفعال</option>
                                <option value="1" @if(old('status',$banner->status)==1) selected @endif>فعال</option>
                            </select>
                            @error('status')

                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
    
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="position">جایگاه</label>
                     
                             <select name="position"  class="form-control form-control-sm">
                                <option value="">یک مورد را انتخاب کنید</option>
                                @foreach ($positions as $key=> $position)
                                <option value="{{ $key }}" @if(old('position',$banner->position) == $key) selected @endif>{{ $position }}
                                </option>
                                @endforeach
                            </select>

                            @error('position')

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

