@extends('admin.layouts.master')

@section('head-tag')
    <title>سوالات متداول</title>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">سوالات متداول</h3>
                    <a href="{{ route('admin.content.faq.create') }}" class="btn btn-success text-white">ایجاد</a>

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
                                <th>answer</th>
                                <th>question</th>
                                <th>tools</th>
                            </tr>
                            @foreach ($faqs as $faq)
                                <tr>
                                    {{-- <td>{{ $faq->id }}</td> --}}
                                    <td>{{ $faq->question }}</td>
                                    <td>{{ Str::limit($faq->answer, 20) }}</td>
                        
                                    <td>
                                        <form action="{{ route('admin.content.faq.delete', $faq) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger text-white delete">حذف</button>
                                        </form>
                                        {{-- <a href="{{ route('admin.content.post.edit', $post) }}"
                                            class="btn btn-primary text-white">ویرایش</a> --}}
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
    </script>


    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
