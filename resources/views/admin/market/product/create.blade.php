@extends('admin.layouts.master')


@section('head-tag')
    <title>ایجاد محصول</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ایجاد محصول</h3>

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
                        <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>


                    <form action="{{ route('admin.market.product.store') }}" method="post" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        <!-- text input -->
                        <div class="form-group">
                            <label for="">نام کالا</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control form-control-sm">
                            @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">انتخاب دسته</label>
                            <select name="category_id" id="" class="form-control form-control-sm">
                                <option value="">دسته را انتخاب کنید</option>
                                @foreach ($productCategories as $productCategory)
                                    <option value="{{ $productCategory->id }}"
                                        @if (old('category_id') == $productCategory->id) selected @endif>{{ $productCategory->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('category_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">انتخاب برند</label>
                            <select name="brand_id" id="" class="form-control form-control-sm">
                                <option value="">برند را انتخاب کنید</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @if (old('brand_id') == $brand->id) selected @endif>
                                        {{ $brand->original_name }}</option>
                                @endforeach

                            </select>
                            @error('brand_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">تصویر </label>
                            <input type="file" name="image" class="form-control form-control-sm">
                            @error('image')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">قیمت کالا</label>
                            <input type="text" name="price" value="{{ old('price') }}"
                                class="form-control form-control-sm">
                            @error('price')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>دسته های مرتبط به این کالا</label>
                            <select multiple class="form-control form-control-sm" id="select_relatedCategories"
                                name="relatedCategories[]">
                                @foreach ($productCategories as $productCategory)
                                    <option value="{{ $productCategory->id }}">
                                        {{ $productCategory->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('roles')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">توضیحات</label>
                            <textarea name="introduction" id="introduction" class="form-control form-control-sm" rows="6">{{ old('introduction') }}</textarea>
                            @error('introduction')
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

                        <div class="form-group">
                            <label for="marketable">قابل فروش بودن</label>
                            <select name="marketable" id="" class="form-control form-control-sm" id="marketable">
                                <option value="0" @if (old('marketable') == 0) selected @endif>غیرفعال</option>
                                <option value="1" @if (old('marketable') == 1) selected @endif>فعال</option>
                            </select>
                            @error('marketable')
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
                            @error('tags')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">تاریخ انتشار</label>
                            <input type="text" name="published_at" id="published_at"
                                class="form-control form-control-sm d-none">
                            <input type="text" id="published_at_view" class="form-control form-control-sm">
                            @error('published_at')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>



                        <section class="col-12 border-top border-bottom py-3 mb-3">

                            <section class="row">

                                <section class="col-6 col-md-3 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="meta_key[]" class="form-control form-control-sm"
                                            placeholder="ویژگی ...">
                                    </div>
                                    @error('meta_key.*')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </section>

                                <section class="col-6 col-md-3 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="meta_value[]" class="form-control form-control-sm"
                                            placeholder="مقدار ...">
                                    </div>
                                    @error('meta_value.*')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </section>

                            </section>

                            <section>
                                <button id="meta_copy" type="button" class="btn btn-success btn-sm">افزودن</button>
                            </section>


                        </section>



                        <button type="submit" class="btn btn-success text-white">ثبت</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('introduction');
    </script>

    <script>
        $(document).ready(function() {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at'
            })
        });
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

    <script>
        $('#meta_copy').on('click', function() {

            var ele = $(this).parent().prev().clone(true);
            $(this).before(ele);
        })
    </script>


    <script>
        var select_relatedCategories = $('#select_relatedCategories');
        select_relatedCategories.select2({
            placeholder: 'لطفا دسته ها را وارد نمایید',
            multiple: true,
            tags: true
        })
    </script>
@endsection
