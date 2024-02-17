@extends('front.layouts.master')


@section('head-tag')
    <title>تیکت های من</title>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <a href="{{route('front.profile.my-tickets.create')}}" class="d-flex justify-content-end btn btn-link btn-sm text-info text-decoration-none mx-1"><i class="fa fa-edit px-1"></i>تیکت جدید</a>
            <div class="flex flex-col md:flex-row gap-5">

                @include('front.layouts.partials.profile-sidebar')


                @if ($tickets->count() > 0)
                    <div class="md:w-8/12 lg:w-9/12">
                        <div class="relative overflow-x-auto shadow-md rounded-xl">

                            <table class="w-full text-sm text-right text-gray-600">
                                <thead class="text-xs text-gray-700 bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                          #
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                          نویسنده
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                           عنوان
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            وضعیت 
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            پیام جدید 
                                        </th>
                                        {{-- <th scope="col" class="px-6 py-3">
                                            تیکت مرجع
                                        </th> --}}
                                        <th scope="col" class="px-6 py-3">
                                            تنظیمات
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($tickets as $ticket)
                                        <tr class="hover:bg-gray-100 transition text-xs border-b">
                                            <th scope="row" class="px-6 py-4 font-medium">
                                                {{ $loop->iteration }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{$ticket->user->fullname}}
                                            </td>

                                            <td class="px-6 py-4">
                                                {{$ticket->subject}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$ticket->status==0 ?'باز' :'بسته'}}
                                            </td>
                                            <td class="px-6 py-4">

                                                @php
                                                $user=auth()->user();
                                                $userTicketIds=$user->tickets->pluck('id');
                                                $unseenTicketsCount=App\Models\Ticket\Ticket::whereIn('ticket_id',$userTicketIds)->where('seen',0)->count();
                                                @endphp

                                                @if ($unseenTicketsCount > 0)
                                                <span style="top: 80%;" class="badge rounded-pill bg-danger mr-4">
                                                {{$unseenTicketsCount}} پیام جدید
                                                </span>
                                                @else
                                                پیام جدید وجود ندارد
                                                @endif
                                            </td>
                                            {{-- <td class="px-6 py-4">
                                                {{$ticket->parent ? $ticket->parent->subject : 'ندارد'}}
                                            </td> --}}
                                            <td class="px-6 py-4">
                                                <a href="{{ route('front.profile.my-tickets.show',$ticket->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>

                                                {{-- <a href="{{ route('front.profile.my-tickets.change', $ticket->id) }}" class="btn btn-{{ $ticket->status == 1 ? 'success' : 'danger' }} btn-sm"><i class="{{ $ticket->status == 1 ? 'fa fa-check' : 'btn-close' }} check"></i> --}}
                                               </a>
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
