@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">کاربران ادمین</h3>
                    <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-success text-white">ایجاد دستی</a>
                    <a href="{{ route('admin.user.admin-user.create-admin') }}" class="btn btn-warning text-white">ایجاد از بین کاربران موجود</a>


                    <div class="card-tools">
                        <form action="{{route('admin.user.admin-user.index')}}" method="get">
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
                                <th>ایمیل</th>
                                <th>شماره موبایل</th>
                                <th>نام کاربری </th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>نقش</th>
                                <th>دسترسی</th>
                                {{-- <th>وضعیت</th> --}}
                                <th>وضعیت فعالسازی</th>
                                <th>tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $key => $admin)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->mobile }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->first_name }}</td>
                                    <td>{{ $admin->last_name }}</td>
                                    <td>
                                        @forelse($admin->roles as $role)
                                            <div>
                                                {{ $role->name }}
                                            </div>
                                        @empty

                                            <div class="text-danger">
                                                نقشی برای این کاربر تعریف نشده
                                            </div>
                                        @endforelse

                                    </td>

                                    <td>
                                        @forelse($admin->permissions as $permission)
                                            <div>
                                                {{ $permission->name }}
                                            </div>
                                        @empty

                                            <div class="text-danger">
                                                هیچ دسترسی برای این کاربر تعریف نشده
                                            </div>
                                        @endforelse

                                    </td>


                                    {{-- <td>
                                        <label>
                                            <input id="{{ $admin->id }}" onchange="changeStatus({{ $admin->id }})" data-url="{{ route('admin.user.admin-user.status', $admin->id) }}" type="checkbox" @if ($admin->status === 1)
                                            checked
                                                    @endif>
                                        </label>
                                    </td> --}}

                                    <td>
                                        <label>
                                            <input id="{{ $admin->id }}-activation"
                                                onchange="changeActivation({{ $admin->id }})"
                                                data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}"
                                                type="checkbox" @if ($admin->activation === 1) checked @endif>
                                        </label>
                                    </td>


                                    <td class="width-22-rem text-left">
                                        <a href="{{ route('admin.user.admin-user.roles', $admin->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> نقش</a>
                                        <a href="{{ route('admin.user.admin-user.permissions', $admin->id) }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-edit"></i> دسترسی</a>


                                        <a href="{{ route('admin.user.admin-user.edit', $admin->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>

                                        <form class="d-inline"
                                            action="{{ route('admin.user.admin-user.destroy', $admin->id) }}"
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

    <script type="text/javascript">
        function changeActivation(id) {
            var element = $("#" + id + '-activation')
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            // successToast('ایتم با موفقیت فعال شد')
                            sweetalertStatusSuccess('ایتم با موفقیت فعال شد')

                        } else {
                            element.prop('checked', false);
                            // successToast('ایتم با موفقیت غیر فعال شد')
                            sweetalertStatusSuccess('ایتم با موفقیت غیر فعال شد')

                        }
                    } else {
                        element.prop('checked', elementValue);
                        // errorToast('هنگام ویرایش مشکلی بوجود امده است')
                        sweetalertStatusError('هنگام ویرایش مشکلی بوجود امده است')

                    }
                },
                error: function() {
                    element.prop('checked', elementValue);
                    // errorToast('ارتباط برقرار نشد')
                    sweetalertStatusError('ارتباط برقرار نشد')

                }
            });

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
        }
    </script>



    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
