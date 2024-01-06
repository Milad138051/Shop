@extends('admin.layouts.master')



@section('content')
    <section class="row">


        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظرها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header bg-custom-yellow">
                        کاربر : {{ $comment->user->fullName }}
                        با کد : {{ $comment->author_id }}
                        <h5 class="card-title">عنوان محصول : {{ $comment->commentable->name }}
                            |
                            کد محصول : {{ $comment->commentable->id }}</h5>

                    </section>

                    <section class="card-body">
                        <p class="card-text">{{ $comment->body }}</p>
                    </section>
                </section>

                @if ($comment->parent_id == null)
                    <section>
                        <form action="{{ route('admin.market.comment.answer', $comment->id) }}" method="post">
                            @csrf
                            <section class="row">
                                <section class="col-12">
                                    <div class="form-group">
                                        <label for="answer">پاسخ ادمین</label>
                                        ‍
                                        <textarea id="answer" class="form-control form-control-sm" name="body" rows="4"></textarea>
                                    </div>
                                    @error('answer')
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
                @endif

            </section>
        </section>
    </section>
@endsection
