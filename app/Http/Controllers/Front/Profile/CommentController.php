<?php

namespace App\Http\Controllers\Front\Profile;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
	    $comments=Comment::orderBy('id','DESC')->where('author_id',auth()->user()->id)->get();
        return view('front.profile.comments',compact('comments'));
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        return back()->with('alert-section-success','نظر با موفقیت حذف باشد');
    }
}
