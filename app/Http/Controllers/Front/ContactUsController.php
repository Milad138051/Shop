<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactUsRequest;
use App\Models\Front\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(ContactUsRequest $request)
    {
        $inputs=$request->all();
        ContactUs::create($inputs);
        return back()->with('alert-section-success', 'عملیات با موفقیت انجام شد');;
    }
}
