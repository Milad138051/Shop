@extends('admin.layouts.master')


@section('head-tag')
    <title>ویرایش کاربر ادمین</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ویرایش کاربر ادمین</h3>

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
                        <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <form action="{{route('admin.user.admin-user.update',$user)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">نام کاربری</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="name" value={{old('name',$user->name)}}>
                            @error('name')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="first_name">نام کوچک</label>
                            <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" value={{old('first_name',$user->first_name)}}>
                            @error('first_name')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text" class="form-control form-control-sm" name="last_name" id="last_name" value={{old('last_name',$user->last_name)}}>
                            @error('last_name')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="profile_photo_path">تصویر</label>
                            <input type="file" class="form-control form-control-sm" name="profile_photo_path" id="profile_photo_path">
                            <img src="{{ asset($user->profile_photo_path) }}" alt="" width="50" height="50" class="mt-3">
                            @error('profile_photo_path')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="activation">نقش</label>
                            <select name="user_type" id="user_type" class="form-control form-control-sm">
                                <option @if(old('user_type',$user->user_type)==1) selected @endif value="1">ادمین</option>
                                <option @if(old('user_type',$user->user_type)==0) selected @endif value="0">مشتری</option>
                            </select>
                            @error('activation')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="activation">وضعیت فعال سازی</label>
                            <select name="activation" id="activation" class="form-control form-control-sm">
                                <option @if(old('activation',$user->activation)==0) selected @endif value="0">غیر فعال</option>
                                <option @if(old('activation',$user->activation)==1) selected @endif value="1">فعال</option>
                            </select>
                            @error('activation')
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


