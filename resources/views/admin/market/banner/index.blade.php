@extends('admin.layouts.master')

@section('head-tag')
    <title>بنر ها</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">بنر ها</h3>
                    <a href="{{ route('admin.market.banner.create') }}" class="btn btn-info btn-sm">ایجاد بنر</a>


                    {{-- <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div> --}}
                </div>

                @include('admin.alerts.alert-section.success')

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>عنوان بنر</th>
                                <th>تصویر</th>
                                <th>url</th>
                                <th>جایگاه</th>
                                <th>وضعیت</th>
                                <th>tools</th>
                            </tr>
                            @foreach ($banners as $banner)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $banner->title }}</td>
                                <td>
                                    <img src="{{ asset($banner->image) }}" alt="" width="100" height="50">
                                </td>

                                <td>{{$banner->url}}</td>
                                <td>{{$positions[$banner->position] }}</td>

                                <td>
                                    <label>
                                        <input id="{{ $banner->id }}" onchange="changeStatus({{ $banner->id }})"
                                               data-url="{{ route('admin.market.banner.status', $banner->id) }}"
                                               type="checkbox" @if ($banner->status === 1)
                                               checked
                                                @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.market.banner.edit',$banner->id)}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش
                                    </a>

                                    <form class="d-inline"
                                          action="{{ route('admin.market.banner.destroy', $banner->id) }}"
                                          method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                    class="fa fa-trash-alt"></i> حذف
                                        </button>
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
                            {{ $banners->links('pagination::bootstrap-5') }}
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
        function changeStatus(id) {
            var element = $("#" + id)
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            // successToast('ایتم با موفقیت فعال شد')
                            sweetalertStatusSuccess('ایتم با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked', false);
                            // successToast('ایتم با موفقیت غیر فعال شد')
                            sweetalertStatusSuccess('ایتم با موفقیت غیر فعال شد')
                        }
                    }
                    else {
                        element.prop('checked', elementValue);
                        // errorToast('هنگام ویرایش مشکلی بوجود امده است')
                        sweetalertStatusError('هنگام ویرایش مشکلی بوجود امده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    // errorToast('ارتباط برقرار نشد')
                    sweetalertStatusError('ارتباط برقرار نشد')
                }
            });

            function sweetalertStatusSuccess(msg) {
                $(document).ready(function () {
                    Swal.fire({
                        title: msg,
                        text: 'عملیات با موفقیت ذخیره شد',
                        icon: 'success',
                        confirmButtonText: 'باشه',
                    });
                });
            }

            function sweetalertStatusError(msg) {
                $(document).ready(function () {
                    Swal.fire({
                        title: msg,
                        text: 'عملیات با موفقیت ذخیره شد',
                        icon: 'error',
                        confirmButtonText: 'باشه',
                    });
                });
            }
        }
    </script>


    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection