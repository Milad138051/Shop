@extends('front.layouts.master')


@section('head-tag')
    <title>سفارش های من</title>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <div class="flex flex-col md:flex-row gap-5">

                @include('front.layouts.partials.profile-sidebar')


                @if ($orders->count() > 0)
                    <div class="md:w-8/12 lg:w-9/12">
                        <div class="relative overflow-x-auto shadow-md rounded-xl">

                            <table class="w-full text-sm text-right text-gray-600">
                                <thead class="text-xs text-gray-700 bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            شماره سفارش
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            تاریخ ثبت سفارش
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            وضعیت
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            مجموع
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            جزئیات
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $order)
                                        <tr class="hover:bg-gray-100 transition text-xs border-b">
                                            <th scope="row" class="px-6 py-4 font-medium">
                                                {{ $loop->iteration }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ jalaliDate($order->created_at) }}
                                            </td>
                                            @if ($order->payment_status == 0)
                                                <td class="lg:px-6 py-4 text-red-500">
                                                    پرداخت نشده
                                                </td>
                                            @elseif ($order->payment_status == 1)
                                                <td class="lg:px-6 py-4 text-green-500">
                                                    پرداخت شده
                                                </td>
                                            @elseif ($order->payment_status == 2)
                                                <td class="lg:px-6 py-4 text-yellow-500">
                                                    باطل شده
                                                </td>
                                            @else
                                                <td class="lg:px-6 py-4 text-red-500">
                                                    برگشت داده شده
                                                </td>
                                            @endif

                                            <td class="px-6 py-4">
                                                {{ priceFormat($order->order_final_amount) }} تومان
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('front.profile.showOrder', $order) }}"
                                                    class="text-red-500 border-b border-red-400">مشاهده</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                    </div>
                @else
                    <div class="md:w-8/12 lg:w-9/12 flex flex-col gap-y-5">
                        <div class="border rounded-3xl shadow-lg flex flex-col p-5 gap-y-5">
                            ایتمی یافت نشد
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
