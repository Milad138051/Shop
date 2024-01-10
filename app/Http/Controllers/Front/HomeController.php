<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Market\Banner;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $sliderShowImages = Banner::where('position', 0)->where('status', 1)->get();
        $bannerNearSliderShowImages = Banner::where('position', 1)->where('status', 1)->first();
        return view('front.home',compact('sliderShowImages','bannerNearSliderShowImages'));
    }
}
