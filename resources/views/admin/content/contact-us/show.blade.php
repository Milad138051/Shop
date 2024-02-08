@extends('admin.layouts.master')



@section('content')
    <section class="row">


        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش پیام 
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.contact-us.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header bg-custom-yellow">
                        نام کاربر : {{ $contactUs->name }}
                        با شماره : {{ $contactUs->mobile }}

                    </section>

                    <section class="card-body">
                        <p class="card-text">{{ $contactUs->body }}</p>
                    </section>
                </section>

            </section>
        </section>
    </section>
@endsection
