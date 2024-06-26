@extends('front.layouts.master')

@section('head-tag')
    <title>ارتباط با ما</title>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl  p-3 md:p-5">
            <!-- SECTION TOP -->
            <div class="flex justify-center items-center lg:my-0">
                <div class="content-center px-4 mt-16 mb-10">
                    <div class="text-center mb-2 opacity-80 text-lg font-semibold md:text-xl">
                        با خیال راحت با تیم پشتیبانی ایران مارکت ارتباط برقرار کنید
                    </div>
                    <div class="text-center opacity-75">
                        اطلاعات فرم را پر کنید تا کارشناسان ما با شما تماس بگیرند
                    </div>
                </div>
            </div>
            <!-- SECTION DOWN -->
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <form action="{{ route('front.contact-us.store') }}" method="post">
                    @csrf
                    <div class="px-5 md:pr-24 grid justify-items-start content-start my-10">
                        <div class="w-full max-w-full shrink-0 md:w-8/12 md:flex-0">
                            <div class="mb-4">
                                <label for="name" class="mb-2 ml-1 text-xs opacity-80">نام و نام خانوادگی:</label>
                                <input type="text" name="name"
                                    class="text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-red-300" />
                            </div>
                            @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-full max-w-full shrink-0 md:w-8/12 md:flex-0">
                            <div class="mb-4">
                                <label for="mobile" class="inline-block mb-2 ml-1 text-xs opacity-80">شماره تماس:</label>
                                <input type="text" name="mobile"
                                    class="text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-red-300" />
                            </div>
                            @error('mobile')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="w-full max-w-full shrink-0 md:w-8/12 md:flex-0">
            <div class="mb-4">
              <label for="email" class="inline-block mb-2 ml-1 text-xs opacity-80">ایمیل:</label>
              <input type="text" name="email" class="text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-red-300" />
            </div>
            @error('email')
            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror
          </div> --}}

                        <div class="w-full max-w-full shrink-0 md:w-10/12 md:flex-0">
                            <div class="mb-4">
                                <label for="description" class="inline-block mb-2 ml-1 text-xs opacity-80">توضیحات:</label>
                                <textarea name="body" cols="20" rows="7"
                                    class="text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-red-300"></textarea>
                            </div>
                            @error('body')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                        <span class="flex justify-center items-center opacity-90 my-5">
                            <button type="submit"
                                class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-sm">ارسال</button>
                        </span>
                </form>
            </div>
            <div class="px-4 lg:px-10 my-10">
                <div class="flex items-center">
                    <span class="inline-block mb-2 ml-1 opacity-80 font-semibold">
                        شماره تماس شرکت:
                    </span>
                    <span class="inline-block mb-2 ml-1 text-sm opacity-75">
                        051-44444444
                    </span>
                </div>
                <div class="flex items-center my-3">
                    <span class="inline-block mb-2 ml-1 opacity-80 font-semibold">
                        ایمیل:
                    </span>
                    <span class="inline-block mb-2 ml-1 text-sm opacity-75">
                        aaaaaaa@gmail.com
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="inline-block mb-2 ml-1 opacity-80 font-semibold">
                        آدرس حضوری:
                    </span>
                    <span class="inline-block mb-2 ml-1 text-sm opacity-75">
                        خراسان رضوی-مشهد-خیابان .....
                    </span>
                </div>
                <div>
                    <iframe class="rounded-3xl w-full my-5"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5487.320972393403!2d59.6102611712093!3d36.28800020180445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6c91ef5993b861%3A0xbc78a4fdeb4d00b5!2z2K3YsdmFINin2YXYp9mFINix2LbYpyDYudmE24zZhyDYp9mE2LPZhNin2YU!5e0!3m2!1sen!2sus!4v1690833786920!5m2!1sen!2sus"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
