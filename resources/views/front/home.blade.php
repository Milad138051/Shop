@extends('front.layouts.master')

@section('head-tag')
<title>خانه</title>
@endsection

@section('content')
    <!-- MAIN -->
    <!-- HERO SLIDER MOBILE -->

    @include('front.layouts.partials.hero-slider-mobile')

    <div class="max-w-[1440px] mx-auto px-3">

      {{-- @include('front.layouts.home.hero-slider-mobile') --}}

      <!-- HERO SLIDER -->
      @include('front.layouts.partials.hero-slider')
      {{-- done --}}
      <!-- PRODUCT SLIDER 1 -->
      @include('front.layouts.partials.product-slider1')
      {{-- done --}}
      <!-- SECTION IMAGE -->
      @include('front.layouts.partials.section-image')
      {{-- done --}}



      <!-- SUGGESTED CATEGORY PRODUCTS -->
      @include('front.layouts.partials.suggested-category-product')
      
      <!-- 4 IMAGE -->
      @include('front.layouts.partials.4image')
      {{-- done --}}

      <!-- GOOD CATEGORYS -->
      @include('front.layouts.partials.good-categories')


      <!-- PRODUCT SLIDER 2 -->
      @include('front.layouts.partials.product-slider2')
      {{-- done --}}
      
      
      
      <!-- SECTION IMAGE 2 -->
      @include('front.layouts.partials.section-image2')
      {{-- done --}}
      


      <!-- aamzingSales -->
      @if ($amazingSaleProducts->count() > 0)
      @include('front.layouts.partials.off-products')   
      @endif




      <!-- BRANDS -->
      @include('front.layouts.partials.brands')
      {{-- done --}}
      <!-- BLOG -->
      @include('front.layouts.partials.blogs')
      {{-- done --}}
    </div>
@endsection


