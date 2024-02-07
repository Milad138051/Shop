@extends('admin.layouts.master')

@section('head-tag')
    <title>نقش ها</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">نقش ها</h3>
                    <a href="{{ route('admin.user.role.create') }}" class="btn btn-info btn-sm">ایجاد نقش جدید</a>


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
                                <th>نام نقش</th>
                                <th>دسترسی ها</th>
                                <th>tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>

                                        @if (empty(
                                                $role->permissions()->get()->toArray()
                                            ))
                                            <span class="text-danger">برای این نقش دسترسی تعریف نشده است</span>
                                        @else
                                            @foreach ($role->permissions as $permission)
                                                {{ $permission->name }} <br>
                                            @endforeach
                                        @endif


                                        <br>
                                    </td>

                                    <td class="width-22-rem text-left">
                                        <a href="{{ route('admin.user.role.permission-form', $role->id) }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-user-graduate"></i> دسترسی ها</a>
                                        <a href="{{ route('admin.user.role.edit', $role->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>

                                        <form class="d-inline" action="{{ route('admin.user.role.destroy', $role->id) }}"
                                            method="post">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                    class="fa fa-trash-alt"></i> حذف</button>
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
                            {{ $roles->links('pagination::bootstrap-5') }}
                        </nav>
                    </section>
                </section>
            </div>
            <!-- /.card -->
        </div>
    </div>
    @endsection
    @section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
    @endsection