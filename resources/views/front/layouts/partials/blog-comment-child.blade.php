@php
    $authorr = $comment->user()->first();
@endphp

<div class="bg-gray-100 rounded-xl pl-2 pr-5 sm:pr-8 py-3">
    <div class="flex items-center">
        <div>
            <img class="w-10"
                @if ($authorr->profile_photo_path) src="{{ asset($authorr->profile_photo_path) }}" @else src="{{ asset('front-assets/image/team-2.jpg') }}" @endif
                alt="">
        </div>
        <div class="text-sm opacity-60 pr-1">
            نوشته شده توسط
            {{ $authorr->first_name . ' ' . $authorr->last_name ?? $authorr->name }} در
            {{ jalaliDate($comment->created_at) }}
        </div>
    </div>
    <div class="opacity-60 text-sm py-3">
        {!! $comment->body !!}
    </div>
    <div>
        <button type="button" data-bs-toggle="modal"
        data-bs-target="#exampleModal-{{ $comment->id }}" data-bs-whatever="@mdo"
            class="mr-auto px-2 sm:px-4 py-2 opacity-80 md:w-auto text-xs sm:text-sm xl:text-base flex justify-center items-center">
            پاسخ
        </button>
        <!-- start add replay Modal -->
        <div class="modal fade" id="exampleModal-{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <form action="{{ route('front.blogs.add-replay', [$post, $comment]) }}"
                                id="form-{{ $comment->id }}" method="POST">
                                @csrf
                                <label for="message-text" class="col-form-label">دیدگاه:</label>
                                <textarea class="form-control" id="message-text" name="body"></textarea>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                        </button>
                        <button type="submit" class="btn btn-primary"
                            onclick="document.getElementById('form-{{ $comment->id }}').submit();">
                            ثبت
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end add replay Modal -->
    </div>
    @foreach ($comment->activeAnswers() as $answer)
        @include('front.layouts.partials.blog-comment-child', ['comment' => $answer])
    @endforeach
</div>
