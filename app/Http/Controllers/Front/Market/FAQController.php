<?php

namespace App\Http\Controllers\Front\Market;

use App\Models\Content\FAQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    public function index()
    {
        $faqs=FAQ::orderBy('id','DESC')->get();
        return view('front.faq',compact('faqs'));

    }
}
