    @php
        $author = $comment->user()->first();
    @endphp
    <div class="bg-gray-50 rounded-xl px-3 sm:px-5 py-3 my-2"
        style="border: 1px solid rgba(249,128,128,var(--tw-border-opacity))">

        <div class="flex flex-col items-stat gap-y-2">
            <div class="flex items-center">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal-{{ $comment->id }}" data-bs-whatever="@mdo">
                    پاسخ
                </button>
                <!-- start add answer-replay Modal -->
                <div class="modal fade" id="exampleModal-{{ $comment->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <form action="{{ route('front.market.add-replay', [$product, $comment]) }}"
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
                <!-- end add answer-replay Modal -->
                <div class="text-xs opacity-60 pr-1">
                    ارسال شده توسط

                    @if (empty($author->first_name) && empty($author->last_name))
                        {{ $author->name }}
                    @else
                        {{ $author->first_name . ' ' . $author->last_name }}
                    @endif
                </div>
                <div class="text-xs opacity-60 pr-1">
                    {{ jalaliDate($comment->created_at) }}
                </div>
            </div>
        </div>
        <div>
            <div class="opacity-60 text-sm py-3">
                {{ $comment->body }}
            </div>
            @foreach ($comment->activeAnswers() as $commentAnswer)
            @include('front.layouts.partials.comment-child',['comment'=>$commentAnswer])
            @endforeach
        </div>
    </div>
