@extends('admin.layouts.master')

@section('head-tag')
    <title>انبار</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">انبار</h3>
                    <div class="card-tools">
                        <form action="{{route('admin.market.store.search')}}" method="POST">
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>نام کالا</th>
                                <th>تصویر کالا</th>
                                <th>تعداد قابل فروش</th>
                                <th>تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']] ) }}" alt="" width="100" height="50">
                                </td>
                                <td>{{ $product->marketable_number }}</td>
                                <td class="width-22-rem text-left">
                                    <a href="{{ route('admin.market.store.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i> اصلاح موجودی</a>
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
