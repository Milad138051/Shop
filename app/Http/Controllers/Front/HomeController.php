<?php

namespace App\Http\Controllers\Front;

use App\Models\Market\Product;
use Illuminate\Http\Request;
use App\Models\Market\Banner;
use App\Http\Controllers\Controller;
use App\Models\Content\Post;
use App\Models\Market\Brand;

class HomeController extends Controller
{
    public function index()
    {
        $sliderShowImages = Banner::where('position', 0)->where('status', 1)->get();
        $fourBanners= Banner::where('position', 3)->where('status', 1)->get();
        $twoBanners= Banner::where('position', 4)->where('status', 1)->get();
        $bannerNearSliderShowImages = Banner::where('position', 1)->where('status', 1)->first();
        $bannerAfterSliderShowImages = Banner::where('position', 2)->where('status', 1)->first();
        $products=Product::orderBy('id','desc')->get();
        $brands=Brand::orderBy('id','desc')->where('status',1)->get();
        $blogs=Post::latest()->where('status',1)->take(4)->get();
        // dd($sliderShowImages);
        return view('front.home',compact('sliderShowImages','fourBanners','twoBanners','bannerNearSliderShowImages','bannerAfterSliderShowImages','products','brands','blogs'));
    }

    public function aboutUs()
    {
        return view('front.about-me');

    }

    public function welcome()
    {
        return view('front.welcome');

    }

}
