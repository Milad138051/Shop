@extends('admin.layouts.master')


@section('head-tag')
    <title>ویرایش دسترسی</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">ویرایش دسترسی ({{$permission->name}})</h3>

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
                        <a href="{{ route('admin.user.permission.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <form action="{{ route('admin.user.permission.update',$permission) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="">عنوان دسترسی</label>
                            <input type="text" name="name" value="{{ old('name',$permission->name) }}"
                                class="form-control form-control-sm">
                                @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="">توضیح دسترسی</label>
                                <input type="text" name="description" value="{{ old('description',$permission->description) }}"
                                    class="form-control form-control-sm">
                                    @error('description')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </div>
                        <button type="submit" class="btn btn-success text-white">ثبت</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

