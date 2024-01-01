@extends('admin.layouts.master')


@section('head-tag')
<title>ویرایش پست</title>
@endsection


@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">

<div class="card-header">
    <h3 class="card-title">ویرایش پست</h3>

    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

        <div class="input-group-append">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </div>
  </div>

<div class="card-body">
    <form action="{{route('admin.content.post.update',$post)}}" method="post" enctype="multipart/form-data">
      @method('put')  
      @csrf
      <!-- text input -->
      <div class="form-group">
        <label>تیتر</label>
        <input type="text" class="form-control" name="title" value="{{old('title',$post->title)}}">
        @error('title')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <label>خلاصه</label>
        <input type="text" class="form-control" name="summary" value="{{old('summary',$post->summary)}}">
        @error('summary')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>


      <div class="form-group">
        <label>تصویر</label>
        <input type="file" class="form-control" name="image">
        @error('image')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>

      <section class="row">
        @php
            $number = 1;
        @endphp
        @foreach ($post->image['indexArray'] as $key => $value )
            <section class="col-md-{{ 6 / $number }}">
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="currentImage" value="{{ $key }}" id="{{ $number }}" @if($post->image['currentImage'] == $key) checked @endif>
                    <label for="{{ $number }}" class="form-check-label mx-2">
                        <img src="{{ asset($value) }}" class="w-100" alt="">
                    </label>
                </div>
            </section>
            @php
                $number++;
            @endphp
        @endforeach

    </section>

      <div class="form-group">
        <label>دسته</label>
        <select class="form-control" name="category_id">
          @foreach ($postCategories as $postCategory)
          <option @if(old('status', $post->category_id) == $postCategory->id) selected @endif value="{{$postCategory->id}}">{{$postCategory->name}}</option>  
          @endforeach
        </select>
        @error('category_id')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>


      <div class="form-group">
        <label>وضعیت</label>
        <select class="form-control" name="status">
          <option  @if(old('status', $post->status) == 1) selected @endif value="1" >فعال</option>
          <option  @if(old('status', $post->status) == 0) selected @endif value="0">غیر فعال</option>
        </select>
        @error('status')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <label>قابلیت کامنت گذاری</label>
        <select class="form-control" name="commentable">
          <option @if(old('status', $post->commentable) == 1) selected @endif value="1">فعال</option>
          <option @if(old('status', $post->commentable) == 0) selected @endif value="0">غیر فعال</option>
        </select>
        @error('commentable')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>

      <!-- textarea -->
      <div class="form-group">
        <label>متن</label>
        <textarea name="body" id="description" class="form-control" rows="3">{{old('body',$post->body)}}</textarea>
        @error('body')
        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
        <strong>
            {{ $message }}
        </strong>
        </span>
        @enderror
      </div>
      <button type="submit" class="btn btn-success text-white">ثبت</button>

    </form>
    
</div>
</div>
</div>
</div>

  @endsection


  @section('script')
  <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
  <script>
    CKEDITOR.replace('description');
  </script>
  @endsection