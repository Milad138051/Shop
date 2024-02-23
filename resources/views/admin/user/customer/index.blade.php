@extends('admin.layouts.master')

@section('head-tag')
    <title>مشتریان</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">مشتریان</h3>
                    <a href="{{ route('admin.user.customer.create') }}" class="btn btn-info btn-sm"> ایجاد کاربر مشتری </a>

                    <div class="card-tools">
                    <form action="{{route('admin.user.customer.index')}}" method="get">
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
                                <th>نام کاربری</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>وضعیت فعالسازی</th>
                                <th>tools</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $key => $user)
                            <tr>
                                <th>{{$key + 1}}</th>
                               <td>{{$user->email}}</td>
                               <td>{{$user->mobile}}</td>
                               <td>{{$user->name}}</td>
                               <td>{{$user->first_name ?? '-'}}</td>
                               <td>{{$user->last_name ?? '-'}}</td>
                                   
                                   <td>
                                       <label>
                                           <input id="{{ $user->id }}-activation" onchange="changeActivation({{ $user->id }})" data-url="{{ route('admin.user.customer.activation', $user->id) }}" type="checkbox" @if ($user->activation === 1)
                                           checked
                                                   @endif>
                                       </label>
                                   </td>
                                   
                               <td class="width-22-rem text-left">
                                   <a href="{{ route('admin.user.customer.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{ route('admin.user.customer.destroy', $user->id) }}" method="post">
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
                            {{ $users->links('pagination::bootstrap-5') }}
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
