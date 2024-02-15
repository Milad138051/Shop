@extends('admin.layouts.master')

@section('head-tag')
    <title>گالری محصول</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">گالری تصاویر ({{ $product->name }})</h3>
                    <a href="{{ route('admin.market.product.gallery.create', $product) }}"
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
                                <th>تصویر</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($product->images))
                                @foreach ($product->images as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>
                                            <img src="{{ asset($item->image['indexArray'][$item->image['currentImage']]) }}"
                                                alt="" width="100" height="50">
                                        </td>


                                        <td width=100px>
                                            <form action="{{ route('admin.market.product.gallery.destroy', $item->id) }}"
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
