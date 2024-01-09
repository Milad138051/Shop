@extends('admin.layouts.master')

@section('head-tag')
    <title>دسترسی ها</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">دسترسی ها</h3>
                    <a href="{{ route('admin.user.permission.create') }}" class="btn btn-info btn-sm">ایجاد دسترسی ها</a>

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
                                <th>نام دسترسی</th>
                                <th>نقش</th>
                                <th>tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$permission->name}}</td>
                                <td>
                                @forelse($permission->roles as $role)
                                
                                <div>
                                {{$role->name}}
                                </div>
                                @empty
                                <div class="text-danger">
                                نقشی یافت نشد
                                </div>
                                @endforelse
                                </td>
                                    
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.user.permission.edit',$permission->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                   
                                     <form class="d-inline" action="{{ route('admin.user.permission.destroy', $permission->id) }}" method="post">
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
@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
