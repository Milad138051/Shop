<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\FAQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-faq');

    }

    public function index()
    {
        $faqs=FAQ::orderBy('id','desc')->get();
        return view('admin.content.faq.index',compact('faqs'));
    }


    public function create()
    {
        return view('admin.content.faq.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'question'=>'required|max:2000',
            'answer'=>'required|max:2000',
            ]);
            $inputs=$request->all();
            FAQ::create($inputs);
            return to_route('admin.content.faq.index')->with('swal-success', 'ایتم شما با موفقیت ثبت شد');;
        }
}
