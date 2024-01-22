@extends('front.layouts.master')


@section('head-tag')
<title>نظرات من</title>
@endsection

@section('content')

<div class="max-w-[1440px] mx-auto px-3">
    <div class="bg-white shadow-xl my-5 lg:my-10 rounded-xl md:rounded-2xl p-3 md:p-5">
      <div class="flex flex-col md:flex-row gap-5">

        
        @include('front.layouts.partials.profile-sidebar')

        <div class="md:w-8/12 lg:w-9/12 flex flex-col gap-y-5">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="hidden md:table-header-group text-xs text-gray-700 bg-gray-50">
              <tr>
                <th scope="col" class="py-3">
                  <span class="sr-only">تصویر</span>
                </th>
                <th scope="col" class="md:pr-6 py-3">
                نام محصول \ پست
                </th>
                <th scope="col" class="pr-5 py-3">
                  نظر
                </th>
                <th scope="col" class="pr-5 py-3">
                  نوع
                </th>
                <th scope="col" class="px-6 py-3">
                  وضعیت
                </th>
                <th scope="col" class="px-3 py-3">
                  عملیات
                </th>
              </tr>
            </thead>
            <tbody class="grid grid-cols-1 sm:grid-cols-2 md:contents gap-5">
                @forelse ($comments as $comment)
                <tr class="bg-white hover:bg-gray-50 grid grid-cols-1 justify-items-center md:table-row border-x sm:border-x-0 sm:border-b">
                    <td class="px-2 py-4">
                      <img src="./assets/image/productSlider/2.jpg" class="w-48 md:w-28 max-w-full max-h-full rounded-lg" alt="">
                    </td>
                    <td class="md:pr-6 py-4 text-xs opacity-90 text-gray-900">
                      {{$comment->commentable->name ?? $comment->commentable->title}}
                    </td>
                    <td class="px-3 py-4 max-w-md text-xs">
                    {{Str::limit($comment->body, 15)}}
                    </td>
                    <td class="px-3 py-4 max-w-md text-xs">
                        @if ($comment->commentable_type=='App\Models\Market\Product')
                            برای محصول
                            @else
                            برای پست
                        @endif
                    </td>
                    @if($comment->approved==1)
                    <td class="px-6 py-4 text-sm opacity-90 text-green-500">
                      تایید شده
                    </td>
                    @else
                    <td class="px-6 py-4 text-sm opacity-90 text-yellow-500">
                        در انتظار تایید
                      </td>
                    @endif
                    <td class="px-3 py-4">
                        <form action="{{route('front.profile.comments.delete',$comment)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class=" text-red-600">حذف</button>
                        </form>
                    </td>
                  </tr>    
                  @empty
                  <div class="md:w-8/12 lg:w-9/12 flex flex-col gap-y-5">
                    <div class="border rounded-3xl shadow-lg flex flex-col p-5 gap-y-5">
                        ایتمی یافت نشد
                    </div>
                </div>  
                @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection