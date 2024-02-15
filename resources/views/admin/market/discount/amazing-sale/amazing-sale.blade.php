@extends('admin.layouts.master')

@section('head-tag')
    <title>فروش شگفت انگیز </title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فروش شگفت انگیز</h3>
                    <a href="{{ route('admin.market.discount.amazingSale.create') }}" class="btn btn-info btn-sm">افزودن کالا به لیست فروش شگفت انگیز  </a>
                    <div class="card-tools">
                        <form action="{{route('admin.market.discount.amazingSale.search')}}" method="POST">
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
                            <th>#</th>
                            <th>نام کالا </th>
                            <th>درصد تخفیف  </th>
                            <th>تاریخ شروع </th>
                            <th> شروع پایان</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($amazingSales as $amazingSale)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{$amazingSale->product->name ?? '-'}}</td>
                                <td>{{$amazingSale->percentage}}%</td>
                                <td>{{jalaliDate($amazingSale->start_date)}}</td>
                                <td>{{jalaliDate($amazingSale->end_date)}}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.market.discount.amazingSale.edit',$amazingSale->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                 
                                     <form class="d-inline" action="{{ route('admin.market.discount.amazingSale.delete', $amazingSale->id) }}" method="post">
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
                <section class="col-12">
                    <section class="my-4 d-flex justify-content-center">
                        <nav>
                            {{ $amazingSales->links('pagination::bootstrap-5') }}
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
