@extends('admin.layouts.master')

@section('head-tag')
    <title>کد تخفیف</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">کد تخفیف</h3>
                    <a href="{{ route('admin.market.discount.copan.create') }}" class="btn btn-success text-white">ایجاد</a>

{{-- 
                    <div class="card-tools">
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
                                <th>کد تخفیف</th>
                                <th>میزان تخفیف</th>
                                <th>نوع تخفیف</th>
                                <th>سقف تخفیف</th>
                                <th>نوع کوپن</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($copans as $copan)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $copan->code }}</td>
                                <td>{{ $copan->amount }} تومان</td>
                                <td>{{ $copan->amount_type == 0 ? 'درصدی' : 'عددی' }}</td>
                                <td>{{ $copan->discount_ceiling ?? '-' }} تومان </td>
                                <td>{{ $copan->type == 0 ? 'عمومی' : 'خصوصی' }}</td>
                                <td>{{ jalaliDate($copan->start_date) }}</td>
                                <td>{{ jalaliDate($copan->end_date) }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.market.discount.copan.edit',$copan->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    
                                    <form class="d-inline" action="{{ route('admin.market.discount.copan.delete', $copan->id) }}" method="post">
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
                            {{ $copans->links('pagination::bootstrap-5') }}
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
