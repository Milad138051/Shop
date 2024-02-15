@extends('admin.layouts.master')

@section('head-tag')
    <title>جزئیات سفارش</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جزئیات سفارش</h3>


                    {{-- <div class="card-tools">
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام محصول</th>
                                <th>درصد فروش فوق العاده</th>
                                <th>مبلغ فروش فوق العاده</th>
                                <th>تعداد</th>
                                <th>جمع قیمت محصول</th>
                                <th>مبلغ نهایی</th>
                                <th>رنگ</th>
                                <th>گارانتی</th>
                                <th>ویژگی</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($order->orderItems as $item)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->singleProduct->name ?? '-' }}</td>
                                <td>{{ $item->amazingSale->percentage ?? '-' }}</td>
                                <td>{{ $item->amazing_sale_discount_amount ?? '-' }} تومان</td>
                                <td>{{ $item->number }} </td>
                                <td>{{ $item->final_product_price ?? '-' }} تومان </td> 
                                <td>{{ $item->final_total_price ?? '-'}} تومان</td>
                                <td>{{ $item->color->color_name ?? '-' }}</td>
                                <td>{{ $item->guarantee->name ?? '-' }}</td>
                                <td>
                                    @forelse($item->orderItemAttributes as $attribute)
                                    {{ $attribute->categoryAttribute->name ?? '-' }}
                                    :
                                    {{json_decode($attribute->categoryAttributeValue->value)->value  ?? '-'}} <br> 
                                    @empty
                                    -
                                    @endforelse
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
