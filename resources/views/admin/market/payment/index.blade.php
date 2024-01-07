@extends('admin.layouts.master')

@section('head-tag')
    <title>پرداخت ها</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">پرداخت ها</h3>
                    <a href="#" class="btn btn-info btn-sm disabled">پرداخت جدید</a>


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
                                <th>کد تراکنش</th>
                                <th>بانک</th>
                                <th>پرداخت کننده</th>
                                <th>وضعیت پرداخت</th>
                                <th>نوع پرداخت</th>
                                <th>tools</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>
                                   {{$payment->paymentable->transaction_id ?? '-' }}
                                </td>
                                <td>
                                   {{$payment->paymentable->gateway ?? '-' }}
                                </td>
                                <td>{{$payment->user->name ?? '-'}}</td>
                                
								<td>  
								@if($payment->status==0) پرداخت نشده
                                    @elseif($payment->status==1) پرداخت شده
                                    @elseif($payment->status==2) باطل شده
                                    @else برگشت داده شده
                                @endif
                                </td>
                                
								<td>
                                    @if($payment->type==0) آنلاین
                                    @elseif($payment->type==1)در محل
                                    @endif
                                </td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.market.payment.show',$payment->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> مشاهده</a>
									
									<a href="{{route('admin.market.payment.paid',$payment->id)}}" class="btn btn-success btn-sm">پرداخت شده</a> 
									<a href="{{route('admin.market.payment.notPaid',$payment->id)}}" class="btn btn-danger btn-sm">پرداخت نشده</a>
                                    <a href="{{route('admin.market.payment.canceled',$payment->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-close"></i> باطل کردن</a>
                                    <a href="{{route('admin.market.payment.returned',$payment->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> برگرداندن</a>        
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
