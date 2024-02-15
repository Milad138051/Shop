@extends('admin.layouts.master')

@section('head-tag')
    <title>رنگ کالا</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">رنگ کالا ({{ $product->name }})</h3>
                    <a href="{{ route('admin.market.product-color.create', $product->id) }}"
                        class="btn btn-success text-white">ایجاد</a>
                            <a href="{{ route('admin.market.product.index') }}" class="btn btn-info">بازگشت</a>
                            


                    {{-- <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام کالا</th>
                                <th>نام رنگ</th>
                                <th>رنگ</th>
                                <th>افزایش قیمت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($product->colors))
                                @foreach ($product->colors as $color)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $color->color_name }}</td>
                                        <td>
                                            <span
                                                style="border-radius:40%;width:20px;height:20px;background:{{ $color->color }};display:block;border:1px solid gray"></span>
                                        </td>
                                        <td>{{ $color->price_increase }} تومان</td>


                                        <td width=100px>
                                            <form action="{{ route('admin.market.product-color.destroy', $color->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                        class="fa fa-trash-alt"></i> حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            @endif
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
