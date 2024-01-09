@extends('admin.layouts.master')


@section('head-tag')
    <title>دسترسی های نقش</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">دسترسی های نقش ({{ $role->name }})</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>
                    <section>
                        <form action="{{ route('admin.user.role.permission-update', $role) }}" method="post">
                            @csrf
                            @method('put')
                            <section class="row">

                                <section class="col-12">
                                    <section class="row border-top mt-3 py-3">

                                        <section class="col-12 col-md-5">
                                            <div class="form-group">
                                                <label for="">نام نقش:</label>
                                                <section>{{ $role->name }}</section>
                                            </div>
                                        </section>

                                        <section class="col-12 col-md-5">
                                            <div class="form-group">
                                                <label for="">توضیح نقش:</label>
                                                <section>{{ $role->description }}</section>
                                            </div>
                                        </section>


                                        @php
                                            $rolePermissionsArray = $role->permissions->pluck('id')->toArray();
                                        @endphp
                                        @foreach ($permissions as $key => $permission)
                                            <section class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                                        value="{{ $permission->id }}" id="{{ $permission->id }}"
                                                        @if (in_array($permission->id, $rolePermissionsArray)) checked @endif>
                                                    <label for="{{ $permission->id }}"
                                                        class="form-check-label mr-3 mt-1">{{ $permission->name }}</label>
                                                </div>

                                                <div class="mt-2">
                                                    @error('permissions.' . $key)
                                                        <span class="alert_required bg-danger text-white p-1 rounded"
                                                            role="alert">
                                                            <strong>
                                                                {{ $message }}
                                                            </strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </section>
                                        @endforeach


                                        <section class="col-12 col-md-2">
                                            <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                                        </section>

                                    </section>
                                </section>

                            </section>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        var select_roles = $('#select_permissions');
        select_roles.select2({
            placeholder: 'لطفا دسترسی ها را وارد نمایید',
            multiple: true,
            tags: true
        })
    </script>
@endsection
