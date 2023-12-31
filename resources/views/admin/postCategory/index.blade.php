@extends('admin.layouts.master')

@section('head-tag')
<title>دسته بندی پست ها</title>
@endsection


@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">دسته ها</h3>
          <a href="{{route('admin.postCategory.create')}}" class="btn btn-success text-white">ایجاد</a>


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
              <th>id</th>
              <th>name</th>
              <th>description</th>
              <th>image</th>
              <th>status</th>
              <th>tools</th>
            </tr>
           </thead>
        <tbody>
            @foreach ($postCategories as $postCategory)
            <tr>
                <td>{{$postCategory->id}}</td>
                <td>{{$postCategory->name}}</td>
                <td>{{ Str::limit($postCategory->description, 20)}}</td>
                <td>
                  <img src="{{ $postCategory->image ? asset($postCategory->image['indexArray'][$postCategory->image['currentImage']] ) : ' ' }}" alt="" width="100" height="50">
                </td>
                <td>
                    @if($postCategory->status==1)
                    <span class="badge badge-success btn-sm">فعال</span></td>
                    @else
                    <span class="badge bg-danger btn-sm">غیر فعال</span>
                    @endif
                <td>
                    <form action="{{route('admin.postCategory.delete',$postCategory)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger text-white">حذف</button>
                    </form>
                    <a href="{{route('admin.postCategory.edit',$postCategory)}}" class="btn btn-primary text-white">ویرایش</a>
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