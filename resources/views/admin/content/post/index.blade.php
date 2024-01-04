@extends('admin.layouts.master')

@section('head-tag')
    <title>پست ها</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">پست ها</h3>
                    <a href="{{ route('admin.content.post.create') }}" class="btn btn-success text-white">ایجاد</a>


                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin.alerts.alert-section.success')

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>id</th>
                                <th>title</th>
                                <th>summary</th>
                                <th>image</th>
                                <th>body</th>
                                <th>commentable</th>
                                <th>status</th>
                                <th>tools</th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->summary }}</td>
                                    <td>
                                        <img src="{{ $post->image ? asset($post->image['indexArray'][$post->image['currentImage']]) : ' ' }}"
                                            alt="" width="100" height="50">
                                    </td>
                                    <td>{{ Str::limit($post->body, 20) }}</td>
                                    <td>
                                        @if ($post->commentable == 1)
                                            <span class="badge badge-success btn-sm">بله</span>
                                        @else
                                            <span class="badge bg-danger btn-sm">خیر</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->status == 1)
                                            <span class="badge badge-success btn-sm">فعال</span>
                                        @else
                                            <span class="badge bg-danger btn-sm">غیر فعال</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.content.post.delete', $post) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger text-white delete">حذف</button>
                                        </form>
                                        <a href="{{ route('admin.content.post.edit', $post) }}"
                                            class="btn btn-primary text-white">ویرایش</a>
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




        }
    </script>


    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
