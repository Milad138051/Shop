@extends('admin.layouts.master')

@section('head-tag')
    <title>مقدار فرم کالا</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">مقدار فرم کالا ({{$categoryAttribute->name}})</h3>
                    <a href="{{ route('admin.market.property.value.create', $categoryAttribute->id) }}" class="btn btn-success
                        text-white">ایجاد</a>
                        <a href="{{ route('admin.market.property.index') }}" class="btn btn-info">بازگشت</a>


                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام فرم</th>
                                <th>واحد اندازه گیری فرم</th>
                                <th>نام محصول</th>
                                <th>مقدار</th>
                                <th>افزایش قیمت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categoryAttribute->values as $value)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $categoryAttribute->name }}</td>
                                    <td>{{ $categoryAttribute->unit }}</td>
                                    <td>{{ $value->product->name }}</td>
                                    <td>{{ json_decode($value->value)->value }}</td>
                                    <td>{{ json_decode($value->value)->price_increase }} تومان</td>
                                    <td class="width-22-rem text-left">
                                        <a href="{{ route('admin.market.property.value.edit', ['categoryAttribute' => $categoryAttribute->id, 'categoryValue' => $value->id]) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                        <form class="d-inline"
                                            action="{{ route('admin.market.property.value.destroy', ['categoryAttribute' => $categoryAttribute->id, 'categoryValue' => $value->id]) }}"
                                            method="post">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                    class="fa fa-trash-alt"></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        function sweetalertStatusSuccess(msg) {
            $(document).ready(function() {
                Swal.fire({
                    title: msg,
                    text: 'عملیات با موفقیت ذخیره شد',
                    icon: 'success',
                    confirmButtonText: 'باشه',
                });
            });
        }

        function sweetalertStatusError(msg) {
            $(document).ready(function() {
                Swal.fire({
                    title: msg,
                    text: 'هنگام ویرایش مشکلی بوجود امده است',
                    icon: 'error',
                    confirmButtonText: 'باشه',
                });
            });
        }

    </script>


    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
