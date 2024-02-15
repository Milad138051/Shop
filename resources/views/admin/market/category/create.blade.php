@extends('admin.layouts.master')


@section('head-tag')
    <title>ایجاد دسته ها</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ایجاد دسته</h3>

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

                    
                    <form action="{{ route('admin.market.category.store') }}" method="post" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        <!-- text input -->
                        <div class="form-group">
                            <label>نام</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>والد</label>
                            <select class="form-control" name="parent_id">
                                <option value="">منوی اصلی</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('parent_id') == $category->id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>تصویر</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="tags">تگ ها</label>
                            <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                value="{{ old('tags') }}">
                            <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                            </select>
                        </div>
                        @error('tags')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror


                        <div class="form-group">
                            <label>نمایش در منو</label>
                            <select class="form-control" name="show_in_menu">
                                <option value="1">فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                            @error('show_in_menu')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>وضعیت</label>
                            <select class="form-control" name="status">
                                <option value="1">فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                            @error('status')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <!-- textarea -->
                        <div class="form-group">
                            <label>متن</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            @error('description')
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
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>

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
