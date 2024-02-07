@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ها</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> تیکت ها</h3>
                    <a href="#" class="btn btn-success text-white disabled">ایجاد</a>


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
                                <th>نویسنده تیکت</th>
                                <th>عنوان تیکت</th>
                                <th>متن تیکت</th>
                                {{-- <th>دسته تیکت</th> --}}
                                {{-- <th>اولویت تیکت</th> --}}
                                <th>ارجاع شده به</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$ticket->user->fullname}}</td>
                                <td>{{$ticket->subject}}</td>
                                <td>{{\Str::limit($ticket->description,15)}}</td>
                                {{-- <td>{{$ticket->category->name}}</td> --}}
                                {{-- <td>{{$ticket->priority->name}}</td> --}}
                                <td>{{$ticket->ticketAdmin ? $ticket->ticketAdmin->user->fullname:'نا مشخص'}}</td>
                                <td class="width-16-rem text-left">
                                   
                                   <a href="{{ route('admin.ticket.show',$ticket->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> مشاهده</a>
    
                                     <a href="{{ route('admin.ticket.change', $ticket->id) }}" class="btn btn-{{ $ticket->status == 1 ? 'success' : 'danger' }} btn-sm"><i class="fa fa-check"></i>
                                         {{$ticket->status ==1 ? 'باز کردن' :'بستن' }}
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
                            {{ $tickets->links('pagination::bootstrap-5') }}
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
