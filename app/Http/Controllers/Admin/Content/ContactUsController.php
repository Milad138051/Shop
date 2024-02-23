<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Front\ContactUs;


class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-contact-us');
    }

    public function index()
    {
        $messages = ContactUs::orderBy('id', 'desc')->paginate(10)->withQueryString();
        return view('admin.content.contact-us.index', compact('messages'));
    }

    public function unseen()
    {
        $messages = ContactUs::orderBy('id', 'desc')->where('seen',0)->paginate(10)->withQueryString();
        return view('admin.content.contact-us.index', compact('messages'));
    }

    public function show(ContactUs $contactUs)
    {
        $contactUs->seen = 1;
        $contactUs->save();
        return view('admin.content.contact-us.show', compact('contactUs'));
    }
}
