@extends('admin.layouts.master')

@section('head-tag')
    <title>پیام های شما</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    
                        @if (request()->route()->getName()=='admin.content.contact-us.unseen')
                        پیام های دیده نشده
                        @else
                        همه پیام ها
                        @endif
                    
                    </h3>
                    <a href="#" class="btn btn-success text-white disabled">ایجاد</a>

{{-- 
                    <div class="card-tools">
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
                                {{-- <th>id</th> --}}
                                <th>متن پیام</th>
                                <th>نام کاربر</th>
                                <th>شماره تلفن</th>
                                <th>تنظیمات</th>
                            </tr>
                            @foreach ($messages as $message)
                                <tr>
                                    {{-- <td>{{ $faq->id }}</td> --}}
                                    <td>{{Str::limit($message->body , 40)}}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->mobile }}</td>

                                    <td>
                                        <a href="{{ route('admin.content.contact-us.show', $message) }}"
                                            class="btn btn-primary text-white">نمایش</a>
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
