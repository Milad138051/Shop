@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">نظرات محصولات</h3>
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
                                <th>id</th>
                                <th>comment</th>
                                <th>answer to</th>
                                <th>user</th>
                                <th>product_id</th>
                                <th>product_name</th>
                                <th>type</th>
                                <th>status</th>
                                <th>tools</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{Str::limit($comment->body, 10)}}</td>
                                    <td>
                                    @if ($comment->parent_id ==null)
                                    والدی ندارد
                                    @else
                                    {{Str::limit($comment->parent->body, 10)}}
                                    @endif
                                    </td>
                                    <td>{{ $comment->user->fullName ?? $comment->user->first_name.''.$comment->user->last_name }}</td>
                                    <td>{{ $comment->commentable->id }}</td>
                                    <td>{{ $comment->commentable->name }}</td>
                                    <td>{{$comment->parent_id ? 'جواب ' : 'کامنت کاربر'}}</td>
                                    <td>
                                        @if ($comment->approved == 1)
                                            <span class="badge badge-success btn-sm">تایید شده</span>
                                        @else
                                            <span class="badge bg-danger btn-sm">در انتظار تایید</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <form action="{{route('admin.comment.delete',$comment)}}" method="post">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger text-white">حذف</button>
                  </form> --}}
                                        <a href="{{ route('admin.market.comment.show', $comment) }}"
                                            class="btn btn-primary text-white">نمایش</a>
                                        <a href="{{ route('admin.market.comment.approved', $comment) }}"
                                            class="btn btn-warning text-white">تغییر وضعیت</a>
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
                            {{ $comments->links('pagination::bootstrap-5') }}
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


    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
