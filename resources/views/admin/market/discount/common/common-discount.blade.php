@extends('admin.layouts.master')

@section('head-tag')
    <title>تخفیف عمومی</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تخفیف عمومی</h3>
                    <a href="{{ route('admin.market.discount.commonDiscount.create') }}" class="btn btn-success text-white">ایجاد</a>


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
                                <th>درصد تخفیف</th>
                                <th>سقف تخفیف </th>
                                <th> عنوان مناسبت</th>
                                <th>تاریخ شروع </th>
                                <th> شروع پایان</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commonDiscounts as $commonDiscount)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{$commonDiscount->percentage}}%</td>
                                <td>{{$commonDiscount->discount_ceiling}} تومان</td>
                                <td>{{$commonDiscount->title}}</td>
                                <td>{{jalaliDate($commonDiscount->start_date)}}</td>
                                <td>{{jalaliDate($commonDiscount->end_date)}}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.discount.commonDiscount.edit', $commonDiscount->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    
                                    <form class="d-inline" action="{{ route('admin.market.discount.commonDiscount.delete', $commonDiscount->id) }}" method="post">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
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
