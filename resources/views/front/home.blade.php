@extends('front.layouts.master')

@section('head-tag')
<title>خانه</title>
@endsection

@section('content')
    <!-- MAIN -->
    <!-- HERO SLIDER MOBILE -->

    @include('front.layouts.home.hero-slider-mobile')

    <div class="max-w-[1440px] mx-auto px-3">

      {{-- @include('front.layouts.home.hero-slider-mobile') --}}

      <!-- HERO SLIDER -->
      @include('front.layouts.home.hero-slider')
      {{-- done --}}
      <!-- PRODUCT SLIDER 1 -->
      @include('front.layouts.home.product-slider1')
      {{-- done --}}
      <!-- SECTION IMAGE -->
      @include('front.layouts.home.section-image')
      {{-- done --}}



      <!-- SUGGESTED CATEGORY PRODUCTS -->
      @include('front.layouts.home.suggested-category-product')
      
      <!-- 4 IMAGE -->
      @include('front.layouts.home.4image')
      {{-- done --}}

      <!-- GOOD CATEGORYS -->
      @include('front.layouts.home.good-categories')


      <!-- PRODUCT SLIDER 2 -->
      @include('front.layouts.home.product-slider2')
      {{-- done --}}
      
      
      
      <!-- SECTION IMAGE 2 -->
      @include('front.layouts.home.section-image2')
      {{-- done --}}
      
      <!-- OFF PRODUCTS -->
      @include('front.layouts.home.off-products')




      <!-- BRANDS -->
      @include('front.layouts.home.brands')
      {{-- done --}}
      <!-- BLOG -->
      @include('front.layouts.home.blogs')
      {{-- done --}}
    </div>
@endsection


