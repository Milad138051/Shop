@php
    $author = $answer->user()->first();
@endphp
<div class="bg-gray-100 rounded-xl pl-2 pr-5 sm:pr-8 py-3 mt-2">
    <div class="flex items-center">
        <div>
            <img class="w-10" src="{{asset(auth()->user()->profile_photo_path)}}" alt="">
        </div>
        <div class="text-sm opacity-60 pr-1">
            نوشته شده توسط {{ $author->first_name . ' ' . $author->last_name }}
        </div>
    </div>
    <div class="opacity-60 text-sm py-3">
        {{ $answer->body }}
    </div>
    <div>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
        data-bs-target="#exampleModal-{{ $answer->id }}" data-bs-whatever="@mdo"
            class="mr-auto px-2 sm:px-4 py-2 opacity-80 md:w-auto text-xs sm:text-sm xl:text-base flex justify-center items-center">
            پاسخ
        </button>
        <!-- start add answer Modal -->
        <div class="modal fade" id="exampleModal-{{ $answer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <form action="{{ route('front.market.add-replay-question',[$product,$answer]) }}"
                                id="form-{{ $answer->id }}" method="POST">
                                @csrf
                                <label for="message-text" class="col-form-label">پاسخ:</label>
                                <textarea class="form-control" id="message-text" name="body"></textarea>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                        </button>
                        <button type="submit" class="btn btn-primary"
                            onclick="document.getElementById('form-{{ $answer->id }}').submit();">
                            ثبت
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end add answer Modal -->
    </div>
    @foreach ($answer->activeAnswers() as $i)
    @include('front.layouts.partials.question-asnwer', ['answer' => $i])
    @endforeach
</div>
