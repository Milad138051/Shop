@extends('front.layouts.master')


@section('head-tag')
    <title>{{ $post->title }}</title>
@endsection

@section('content')
    <div class="max-w-[1440px] mx-auto px-3">
        <div class="mt-0 mb-5 lg:mt-10 lg:mb-8 p-1 md:p-3">
            <div class="md:flex w-full gap-x-7">
                <div class="w-full md:w-8/12 lg:w-9/12">
                    <span class="flex flex-col py-2 px-3 mt-6 lg:mt-0 max-w-5xl rounded-2xl bg-white">
                        <div>
                            <div class="flex flex-wrap gap-x-3 text-xs opacity-75 py-1">
                                <div class="flex">
                                    <div>تاریخ: </div>
                                    <div>{{ jalaliDate($post->created_at) }}</div>
                                </div>
                                <div class="flex">
                                    <div>نویسنده: </div>
                                    <div>{{ $post->user->first_name . ' ' . $post->user->last_name ?? $post > user->name }}
                                    </div>
                                </div>
                                <div class="flex">
                                    <div>دسته بندی: </div>
                                    <div>{{ $post->postCategory->name }}</div>
                                </div>
                                {{-- <div class="flex">
                  <div>امتیاز: </div>
                  <div>4.2</div>
                </div> --}}
                            </div>
                        </div>
                        <img class="rounded-2xl my-3" src="{{ asset($post->image['indexArray']['medium']) }}" alt="">
                        <div>
                            <div class="text-2xl opacity-95 py-3">{{ $post->title }}</div>
                            <div class="opacity-70 pb-3 leading-6 text-sm">
                                {!! $post->body !!}
                            </div>
                        </div>
                    </span>


                    <!-- BOX COMMENTS -->
                    <div class="flex flex-col py-4 px-4 my-6 max-w-5xl rounded-2xl bg-white">
                        <!-- UO COMMENTS -->
                        <div>
                            <div>نظرات</div>
                            @php
                                $commentsCount = App\Models\Content\Comment::where('commentable_type', 'App\Models\Content\Post')
                                    ->where('approved', 1)
                                    ->where('commentable_id', $post->id)
                                    ->count();
                            @endphp
                            <div class="pr-5 opacity-70 text-xs"> {{ $commentsCount }} نظر</div>
                        </div>
                        <!-- COMMENT -->
                        @foreach ($post->activeComments() as $activeComment)
                            @php
                                $author = $activeComment->user()->first();
                            @endphp
                            <div class="bg-gray-50 rounded-xl px-5 py-3 my-2">
                                <div class="flex items-center">
                                    <div>
                                        <img class="w-10"
                                            @if ($author->profile_photo_path) src="{{ asset($author->profile_photo_path) }}" @else src="{{ asset('front-assets/image/team-2.jpg') }}" @endif
                                            alt="">
                                    </div>
                                    <div class="text-sm opacity-60 pr-1">
                                        نوشته شده توسط {{ $author->first_name . ' ' . $author->last_name ?? $author->name }}
                                        در {{ jalaliDate($activeComment->created_at) }}
                                    </div>
                                </div>
                                <div class="opacity-60 text-sm py-3">
                                    {!! $activeComment->body !!}
                                </div>
                                <div>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal-{{ $activeComment->id }}" data-bs-whatever="@mdo"
                                        class="mr-auto px-2 sm:px-4 py-2 opacity-80 md:w-auto text-xs sm:text-sm xl:text-base flex justify-center items-center">
                                        پاسخ
                                    </button>
                                    <!-- start add replay Modal -->
                                    <div class="modal fade" id="exampleModal-{{ $activeComment->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <form
                                                            action="{{ route('front.blogs.add-replay', [$post, $activeComment]) }}"
                                                            id="form-{{ $activeComment->id }}" method="POST">
                                                            @csrf
                                                            <label for="message-text" class="col-form-label">دیدگاه:</label>
                                                            <textarea class="form-control" id="message-text" name="body"></textarea>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">بستن
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                        onclick="document.getElementById('form-{{ $activeComment->id }}').submit();">
                                                        ثبت
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add replay Modal -->
                                </div>
                                <!-- RESPONSE -->

                                @foreach ($activeComment->activeAnswers() as $commentAnswer)
                                @include('front.layouts.partials.blog-comment-child',['comment'=>$commentAnswer])
                                @endforeach
                            </div>
                        @endforeach
                        <!-- BOX SENT COMMENT -->
                        <div>

                        </div>


                        {{-- //send comment --}}
                        <form action="{{ route('front.blogs.add-comment', $post) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="mailTicket"
                                    class="inline-block mb-2 ml-1 font-semibold text-xs text-slate-700">نظر
                                    شما:</label>
                                <textarea cols="30" rows="5" name="body"
                                    class="text-sm block w-full rounded-lg border border-gray-400 bg-white px-3 py-2 font-normal text-gray-700 outline-none focus:border-red-300"></textarea>
                            </div>
                            <button type="submit"
                                class="inline-block px-8 py-2 ml-auto font-semibold text-center text-white bg-red-500 rounded-lg shadow-md text-xs">ارسال
                                نظر</button>
                        </form>

                    </div>
                </div>


                <div class="w-full md:w-4/12 lg:w-3/12 max-w-xl mx-auto">
                    <div class="lg:block p-3 space-y-4 mx-2 md:ml-3 bg-white rounded-2xl">
                        <div class="opacity-90 border-b pb-3">
                            جدیدترین مقاله ها:
                        </div>
                        @foreach ($latests as $item)
                            <a href="{{ route('front.blogs.show-blog', $item) }}" class="flex flex-row items-center p-1">
                                <div class="md:ml-3  mb-3 md:mb-0">
                                    <img class="hover:scale-105 transition rounded-lg w-44"
                                        src="{{ asset($item->image['indexArray']['medium']) }}" alt="" />
                                </div>
                                <div class="w-full px-3 md:px-0">
                                    <div class="mx-auto text-sm h-10 opacity-90">{{ $item->title }}</div>
                                    <div class="text-xs md:flex justify-start opacity-75 mx-auto md:mx-0 pb-3">
                                        <div>{{ jalaliDate($item->created_at) }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
