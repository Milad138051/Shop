@extends('front.layouts.master')

@section('head-tag')
<title>بلاگ</title>

<style>
    a{
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<div class="max-w-[1440px] mx-auto px-3">
    <div class="my-5 lg:my-10 p-1 md:p-3">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        @foreach ($categories->chunk(4) as $groupes)
        @foreach ($groupes as $groupe)
        <div class="grid gap-4">
            <a href="#" class="relative hover:scale-105 transition">
                <img class="h-auto w-full rounded-xl" src="{{asset($groupe->image['indexArray']['medium'])}}" alt="">
                <div class="absolute top-0 bg-neutral-900 bg-opacity-70 rounded-xl w-full h-full flex justify-center items-center text-center text-white text-lg md:text-xl">
                  {{$groupe->name}}
                </div>
              </a>                 
            </div>
            @endforeach
        @endforeach


      </div>

      <div class="md:flex w-full mt-14 gap-x-7">
        <div class="w-full md:w-8/12 lg:w-9/12">
            @foreach ($posts as $post)
            <a href="{{route('front.blogs.show-blog',$post)}}" class="flex flex-col sm:flex md:flex-row items-center shadow-sm p-2 mx-auto my-6 max-w-md md:max-w-full rounded-2xl bg-white ">
                <div class="md:ml-6 mb-3 md:mb-0">
                  <img class="hover:scale-105 transition rounded-xl w-full md:w-auto mx-auto max-h-56" src="{{asset($post->image['indexArray']['medium'])}}" alt="" />
                </div>
                <div class="grid gap-y-5 w-full">
                  <div class="text-lg opacity-80 md:mx-0 md:h-10 pt-3 flex justify-start items-center">{{$post->title}}</div>
                  <div class="text-sm opacity-80 md:h-16 flex justify-start items-start">{{Str::limit($post->summary,90)}}</div>
                  <div class="flex justify-end text-xs opacity-75 md:gap-x-2 my-auto md:mx-0">
                    <div>{{$post->user->first_name.' '.$post->user->last_name ?? $post>user->name}}</div>
                    <div>{{jalaliDate($post->created_at)}}</div>
                  </div>
                </div>
              </a>
            @endforeach
          

          <div class="mb-10">
            {{$posts->links()}}
          </div>
        </div>

        <div class="w-full md:w-4/12 lg:w-3/12 max-w-xl mx-auto">
          <div class="lg:block p-3 space-y-4 mx-2 md:ml-3 bg-white rounded-2xl">
            <div class="opacity-90 border-b pb-3">
               جدیدترین مقاله ها:
            </div>
            @foreach ($latests as $item)
            <a href="{{route('front.blogs.show-blog',$item)}}" class="flex flex-row items-center p-1">
                <div class="md:ml-3  mb-3 md:mb-0">
                  <img class="hover:scale-105 transition rounded-lg w-44" src="{{asset($item->image['indexArray']['medium'])}}" alt="" />
                </div>
                <div class="w-full px-3 md:px-0">
                  <div class="mx-auto text-sm h-10 opacity-90">{{$item->title}}</div>
                  <div class="text-xs md:flex justify-start opacity-75 mx-auto md:mx-0 pb-3">
                    <div>{{jalaliDate($item->created_at)}}</div>
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