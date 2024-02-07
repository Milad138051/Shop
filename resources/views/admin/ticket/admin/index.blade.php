@extends('admin.layouts.master')

@section('head-tag')
    <title>ادمین تیکت ها</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ادمین تیکت ها</h3>
                    <a href="#" class="btn btn-success text-white disabled">ایجاد</a>

                    <div class="card-tools">
                        <form action="{{route('admin.ticket.admin.search')}}" method="POST">
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
                                <th>#</th>
                                <th>نام ادمین</th>
                                <th>ایمیل ادمین</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($admins as $key => $admin)

                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $admin->fullName }}</td>
                                <td>{{ $admin->email }}</td>
                                
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.ticket.admin.set', $admin->id) }}" class="btn btn-{{ $admin->ticketAdmin == null ? 'success' : 'danger' }} btn-sm"><i class="fa fa-check"></i>
                                    {{ $admin->ticketAdmin == null ? 'اضافه' : 'حذف' }}
                                    </a>
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
                            {{ $admins->links('pagination::bootstrap-5') }}
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

@endsection
