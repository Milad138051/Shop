@extends('admin.layouts.master')

@section('head-tag')
    <title>روش ارسال</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">روش ارسال</h3>
                    <a  href="{{ route('admin.market.delivery.create') }}" class="btn btn-success text-white">ایجاد</a>


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
                                <th>نام روش ارسال</th>
                                <th>هزینه ارسال</th>
                                <th>زمان ارسال</th>
                                <th>وضعیت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($delivery_methods as $delivery_method)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $delivery_method->name }}</td>
                                <td>{{ $delivery_method->amount }} تومان</td>
                                <td>{{ $delivery_method->delivery_time . ' - ' . $delivery_method->delivery_time_unit }}</td>
                                <td>
                                    <label>
                                        <input id="{{ $delivery_method->id }}" onchange="changeStatus({{ $delivery_method->id }})" data-url="{{ route('admin.market.delivery.status', $delivery_method->id) }}" type="checkbox" @if ($delivery_method->status === 1)
                                        checked
                                        @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.delivery.edit', $delivery_method->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{ route('admin.market.delivery.destroy', $delivery_method->id) }}" method="post">
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
    function changeStatus(id){
        var element = $("#" + id)
        var url = element.attr('data-url')
        var elementValue = !element.prop('checked');

        $.ajax({
            url : url,
            type : "GET",
            success : function(response){
                if(response.status){
                    if(response.checked){
                        element.prop('checked', true);
                        // successToast('ایتم با موفقیت فعال شد')
                        sweetalertStatusSuccess('ایتم با موفقیت فعال شد')

                    }
                    else{
                        element.prop('checked', false);
                        // successToast('ایتم با موفقیت غیر فعال شد')
                        sweetalertStatusSuccess('ایتم با موفقیت غیر فعال شد')

                    }
                }
                else{
                    element.prop('checked', elementValue);
                    // errorToast('هنگام ویرایش مشکلی بوجود امده است')
                    sweetalertStatusError('هنگام ویرایش مشکلی بوجود امده است')

                }
            },
            error : function(){
                element.prop('checked', elementValue);
                // errorToast('ارتباط برقرار نشد')
                sweetalertStatusError('ارتباط برقرار نشد')

            }
        });

        function sweetalertStatusSuccess(msg){
            $(document).ready(function (){
                Swal.fire({
                    title:msg,
                    text:'عملیات با موفقیت ذخیره شد',
                    icon: 'success',
                    confirmButtonText: 'باشه',
                });
            });
        }

        function sweetalertStatusError(msg){
            $(document).ready(function (){
                Swal.fire({
                    title:msg,
                    text:'هنگام ویرایش مشکلی بوجود امده است',
                    icon: 'error',
                    confirmButtonText: 'باشه',
                });
            });
        }
    }
</script>


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
