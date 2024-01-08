@extends('admin.layouts.master')

@section('head-tag')
    <title>سفارشات</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">سفارشات</h3>
                    <a href="" class="btn btn-info btn-sm disabled">ایجاد سفارش </a>


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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>کد سفارش</th>
                                <th>مجموع مبلغ سفارش (بدون تخفیف)</th>
                                <th>مجموع تمامی مبلغ تخفیفات </th>
                                <th>مبلغ تخفیف همه محصولات</th>
                                <th>مبلغ نهایی</th>
                                <th>وضعیت پرداخت</th>
                                <th>شیوه پرداخت</th>
                                <th>بانک</th>
                                <th>شیوه ارسال</th>
                                <th>وضعیت ارسال</th>
                                <th>وضعیت سفارش</th>
                                <th>tools</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$order->id}}</td>
                                <td>{{$order->order_final_amount }} تومان</td>
                                <td>{{$order->order_discount_amount}} تومان</td>
                                <td>{{$order->order_total_products_discount_amount}} تومان</td>
                                <td>{{ $order->order_final_amount -  $order->order_discount_amount }} تومان</td>
                                <td>{{$order->payment_status_value}}</td>
                                <td>{{$order->payment_type_value}}</td>
                                <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>
                                <td>{{$order->delivery->name }}</td>
                                <td>{{$order->delivery_status_value}}</td>
                                <td>{{$order->order_status_value}}</td>
                                <td class="width-8-rem text-left">
                                    
                                            <a href="{{route('admin.market.order.show-factor',$order->id)}}" class="dropdown-item text-right"><i class="fa fa-images"></i> مشاهده فاکتور</a>
                                          
                                            <a href="{{route('admin.market.order.changeSendStatus',$order->id)}}"  class="dropdown-item text-right"><i class="fa fa-list-ul"></i> تغییر وضعیت ارسال</a>
    
                                            <a href="{{route('admin.market.order.changeOrderStatus',$order->id)}}" class="dropdown-item text-right"><i class="fa fa-edit"></i> تغییر وضعیت سفارش</a>
    
                                              <form action="{{route('admin.market.order.delete',$order->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="dropdown-item text-right delete"><i class="fa fa-window-close"></i> حذف</button>
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
