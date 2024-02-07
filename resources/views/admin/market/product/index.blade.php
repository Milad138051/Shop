@extends('admin.layouts.master')

@section('head-tag')
    <title>محصولات</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">محصولات</h3>
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-success text-white">ایجاد</a>

                    <div class="card-tools">
                        <form action="{{route('admin.market.product.search')}}" method="POST">
                        <div class="input-group input-group-sm" style="width: 150px;">
                                @csrf
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{request()->search}}">
                        
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                                
                         </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام کالا</th>
                                <th>نام دسته</th>
                                <th> تصویر کالا</th>
                                {{-- <th> اسلاگ</th> --}}
                                <th> برند</th>
                                <th> قیمت</th>
                                <th>دسته </th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                            width="100" height="115">
                                    </td>
                                    {{-- <td>{{ $product->slug }}</td> --}}
                                    <td>{{ $product->brand->persian_name }}</td>
                                    <td>{{ $product->price }} تومان</td>
                                    <td>{{ $product->category->name }}</td>


                                    <td class="width-8-rem text-left">

                                        <a href="{{ route('admin.market.product.gallery.index', $product) }}"
                                            class="dropdown-item text-right"><i class="fa fa-images"></i>
                                            گالری</a>
                                        <a href="{{ route('admin.market.product-color.index', $product) }}"
                                            class="dropdown-item text-right"><i class="fa fa-list-ul"></i>رنگ
                                            کالا</a>
                                        <a href="{{ route('admin.market.guarantee.index', $product) }}"
                                            class="dropdown-item text-right"><i class="fa fa-shield-alt"></i>
                                            گارانتی</a>
                                        <a href="{{ route('admin.market.product.edit', $product->id) }}"
                                            class="dropdown-item text-right"><i class="fa fa-edit"></i> ویرایش</a>
                                        <form action="{{ route('admin.market.product.destroy', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-right delete"><i
                                                    class="fa fa-window-close"></i> حذف</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <section class="col-12">
                    <section class="my-4 d-flex justify-content-center">
                        <nav>
                            {{ $products->links('pagination::bootstrap-5') }}
                        </nav>
                    </section>
                </section>
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
