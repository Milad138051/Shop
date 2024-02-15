@extends('admin.layouts.master')


@section('head-tag')
    <title>دسترسی های کاربر ادمین</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">دسترسی های کاربر ادمین ({{$admin->name}})</h3>

                    {{-- <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>
                    <section>
                        <form action="{{route('admin.user.admin-user.permissions.store',$admin)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <section class="row">
        
                               <section class="col-12">
                                    <div class="form-group">
                                        <label>دسترسی ها</label>
                                        <select multiple class="form-control form-control-sm" id="select_permissions" name="permissions[]">
                                            @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}" @foreach ($admin->permissions as $user_permission)
                                                @if($user_permission->id === $permission->id)
                                                selected
                                                @endif
                                                @endforeach>
                                                {{ $permission->name }}
                                            </option>
                                            @endforeach
        
                                        </select>
                                    </div>
                                    @error('permissions')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </section>
    
                                <section class="col-12">
                                    <button class="btn btn-primary btn-sm">ثبت</button>
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
        tags : true
    })
</script>

@endsection
