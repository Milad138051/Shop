@extends('admin.layouts.master')


@section('head-tag')
    <title>ایجاد رنگ کالا</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">

@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ایجاد رنگ کالا</h3>

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
                    <form action="{{ route('admin.market.product-color.store',$product) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">نام رنگ</label>
                            <input type="text" name="color_name" value="{{ old('color_name') }}" class="form-control form-control-sm">
                            @error('color_name')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="color">رنگ</label>
                            <input type="color" name="color" value="{{ old('color') }}" class="form-control form-control-sm form-control-color">
                            @error('color')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">افزایش قیمت</label>
                            <input type="text" name="price_increase" value="{{ old('price_increase') }}" class="form-control form-control-sm">
                            @error('price_increase')
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
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('introduction');
    </script>

    <script>
            $(document).ready(function () {
                $('#published_at_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#published_at'
                })
            });
    </script>

<script>
    $(document).ready(function () {
        var tags_input = $('#tags');
        var select_tags = $('#select_tags');
        var default_tags = tags_input.val();
        var default_data = null;

        if(tags_input.val() !== null && tags_input.val().length > 0)
        {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder : 'لطفا تگ های خود را وارد نمایید',
            tags: true,
            data: default_data
        });
        select_tags.children('option').attr('selected', true).trigger('change');


        $('#form').submit(function ( event ){
            if(select_tags.val() !== null && select_tags.val().length > 0){
                var selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }
        })
    })
</script>

<script>

     $('#meta_copy').on('click',function(){
		 
		 var ele=$(this).parent().prev().clone(true);
		 $(this).before(ele);
	 })


</script>


<script>
    var select_relatedCategories = $('#select_relatedCategories');
    select_relatedCategories.select2({
        placeholder: 'لطفا دسته ها را وارد نمایید',
        multiple: true,
        tags : true
    })
</script>


@endsection
