@extends('front.layouts.master')


@section('head-tag')
    <title>تیکت های من</title>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <div class="flex flex-col md:flex-row gap-5">

                @include('front.layouts.partials.profile-sidebar')


                <div class="md:w-8/12 lg:w-9/12">
                    <div class="relative overflow-x-auto shadow-md rounded-xl">

                        <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                            <a href="{{ route('front.profile.my-tickets') }}" class="btn btn-danger btn-sm">بازگشت</a>
                        </section>

                        <section class="card mb-3">
                            <section class="card-header text-white bg-danger">
                                {{ $ticket->user->fullname ?? $child->user->name}}
                            </section>
                            <section class="card-body">
                                <h5 class="card-title">
                                    {{ $ticket->subject }}
                                </h5>
                                <p class="card-text">
                                    {{ $ticket->description }}
                                </p>
                            </section>

                            @if ($ticket->file()->count() > 0)
                                <section class="card-footer">
                                    <a class="btn btn-success" href="{{ asset($ticket->file->file_path) }}" download>دانلود
                                        ضمیمه</a>
                                </section>
                            @endif
                        </section>

                        <hr>




                        <div class="border my-2">
                            @foreach ($ticket->children->sortBy('id') as $child)
                                <section class="card m-4">
                                    <section
                                        class="card-header bg-{{ $child->reference_id == null ? 'danger ' : 'light ' }}d-flex justify-content-between {{ $child->reference_id == null ? 'text-white ' : ' ' }}">

                                        <div>
                                            @if ($child->reference_id == null)
                                                {{ $child->user->fullName ?? $child->user->name}}
                                            @else
                                                {{-- {{ $child->ticketAdmin->first_name.' '.$child->ticketAdmin->last_name }} --}}
                                                ادمین
                                            @endif
                                        </div>

                                        <small>{{ jdate($child->created_at) }}</small>
                                    </section>
                                    <section class="card-body">
                                        <p class="card-text">
                                            {{ $child->description }}
                                        </p>
                                    </section>

                                    @if ($child->file()->count() > 0)
                                        <section class="card-footer">
                                            <a class="btn btn-success" href="{{ asset($child->file->file_path) }}"
                                                download>دانلود
                                                ضمیمه</a>
                                        </section>
                                    @endif
                                </section>
                            @endforeach
                        </div>



                        @if (!$ticket->status==1)
                        <section>
                            <form action="{{ route('front.profile.my-tickets.answer', $ticket->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <section class="row">
                                    <section class="col-12">
                                        <div class="form-group">
                                            <label for="description">پاسخ تیکت</label>
                                            ‍
                                            <textarea class="form-control form-control-sm"name="description" id="description" rows="4"></textarea>
                                        </div>
                                        @error('description')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>


                                    <section class="col-12 my-2">
                                        <div class="form-group">
                                            <label for="file">فایل</label>
                                            <input type="file" class="form-control form-control-sm" name="file"
                                                id="file">
                                        </div>
                                        @error('file')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>


                                    <section class="col-12 m-2">
                                        <button class="btn btn-primary btn-sm">ارسال</button>
                                    </section>
                                </section>
                            </form>
                        </section>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
