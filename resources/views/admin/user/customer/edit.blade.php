@extends('admin.layouts.master')


@section('head-tag')
    <title>ویرایش مشتری</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ویرایش مشتری ({{$user->name}})</h3>

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
                        <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <form action="{{route('admin.user.customer.update',$user)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="name">نام  کاربری</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="name" value={{old('name',$user->name)}}>
                            @error('name')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="text" name="email"id="email" class="form-control form-control-sm" value="{{ old('email',$user->email) }}">
                            @error('email')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="first_name">نام کوچک</label> 
                            <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" value="{{ old('first_name',$user->first_name) }}">
                            @error('first_name')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" value="{{ old('last_name',$user->last_name) }}">
                            @error('last_name')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="profile_photo_path">تصویر</label>
                            <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control form-control-sm">
                            <img src="{{ asset($user->profile_photo_path) }}" alt="" width="50" height="50" class="mt-3">

                            @error('profile_photo_path')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>
 
                        <div class="form-group">
                            <label for="activation">وضعیت فعالسازی</label>
                            <select name="activation" id="" class="form-control form-control-sm" id="activation">
                                <option value="0" @if(old('activation') == 0) selected @endif>غیرفعال</option>
                                <option value="1" @if(old('activation') == 1) selected @endif>فعال</option>
                            </select>
                            @error('activation')
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
    <script>
        $(document).ready(function() {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');


            $('#form').submit(function(event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
@endsection
