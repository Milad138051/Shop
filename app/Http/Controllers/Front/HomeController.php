<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Content\Post;
use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Market\Banner;
use App\Models\Market\Product;
use App\Models\Market\Category;
use App\Models\Market\AmazingSale;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $sliderShowImages = Banner::where('position', 0)->where('status', 1)->get();
        $fourBanners= Banner::where('position', 3)->where('status', 1)->get();
        $twoBanners= Banner::where('position', 4)->where('status', 1)->get();
        $bannerNearSliderShowImages = Banner::where('position', 1)->where('status', 1)->first();
        $bannerAfterSliderShowImages = Banner::where('position', 2)->where('status', 1)->first();
        $cheapestProducts=Product::orderBy('price','ASC')->get();
        $products=Product::orderBy('id','desc')->get();
        $popularCategories=Category::orderby('viewed','desc')->take(4)->get();
     
        $amazingSalesId=AmazingSale::where('start_date','<',Carbon::now())->where('end_date','>',Carbon::now())->where('status',1)->pluck('product_id');
        $amazingSaleProducts=Product::whereIn('id',$amazingSalesId)->get();
        // dd($amazingSaleProducts);
      
        $brands=Brand::orderBy('id','desc')->where('status',1)->get();
        $blogs=Post::latest()->where('status',1)->take(4)->get();
        return view('front.home',compact('sliderShowImages','fourBanners','twoBanners','bannerNearSliderShowImages','bannerAfterSliderShowImages','cheapestProducts','products','brands','blogs','popularCategories','amazingSaleProducts'));
    }

    public function aboutUs()
    {
        return view('front.about-me');
    }

    public function welcome()
    {
        return view('front.welcome');
    }

    public function contactUs()
    {
        return view('front.contact-us');
    }

}
