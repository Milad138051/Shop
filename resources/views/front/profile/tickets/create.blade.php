@extends('front.layouts.master')


@section('head-tag')
    <title>تیکت های من</title>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
            <a href="{{route('front.profile.my-tickets.create')}}" class="d-flex justify-content-end btn btn-link btn-sm text-info text-decoration-none mx-1"><i class="fa fa-edit px-1"></i>تیکت جدید</a>
            <div class="flex flex-col md:flex-row gap-5">

                @include('front.layouts.partials.profile-sidebar')


                    <div class="md:w-8/12 lg:w-9/12">
                        <div class="relative overflow-x-auto shadow-md rounded-xl">

                            <section class="my-3">
                                <form action="{{ route('front.profile.my-tickets.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <section class="row">
                                        <section class="col-12">
                                            <div class="form-group">
                                                <label for="" class="">عنوان</label>
                                                ‍<input class="form-control form-control-sm" rows="4" name="subject"
                                                    value="{{ old('subject') }}" />
                                            </div>
                                            @error('subject')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                            @enderror
                                        </section>

                                        <section class="col-12">
                                            <div class="form-group">
                                                <label for="" class="my-2">متن</label>
                                                ‍<textarea class="form-control form-control-sm" rows="4"
                                                    name="description">{{ old('description') }}</textarea>
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
    
    
                                        <section class="col-12 my-3">
                                            <button class="btn btn-primary btn-sm">ثبت</button>
                                        </section>
                                    </section>
                                </form>
                            </section>


                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
