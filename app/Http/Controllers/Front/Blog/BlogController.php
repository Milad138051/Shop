<?php

namespace App\Http\Controllers\Front\Blog;

use App\Models\Content\Post;
use Illuminate\Http\Request;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Models\Content\PostCategory;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {   
        $categories=PostCategory::all();
        $posts=Post::orderBy('id','DESC')->paginate(5)->withQueryString();
        $latests=Post::latest()->where('status',1)->take(5)->get();

        return view('front.blog.blogs',compact('categories','posts','latests'));
    }
    public function indexCategory(PostCategory $postCategory)
    {
        $posts=Post::where('category_id',$postCategory->id)->paginate(5)->withQueryString();
        $latests=Post::latest()->where('status',1)->take(5)->get();
        return view('front.blog.blogsCategory',compact('posts','latests','postCategory'));
    }

    public function showBlog(Post $post)
    {
        // dd($post);
        $latests=Post::latest()->where('status',1)->take(5)->get();
        return view('front.blog.show-blog',compact('post','latests'));
    }

    public function addComment(Post $post,Request $request)
	{
	if(Auth::check()){

		$request->validate([
		'body'=>'required|max:2000',
		]);
		
        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['commentable_id'] = $post->id;
        $inputs['commentable_type'] = Post::class;
        Comment::create($inputs);
		return back()->with('alert-section-success',' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
	}
	else{
		return back()->with('alert-section-error','برای ثبت دیدگاه , ابتدا وارد حساب خود شوید');
	}
}

public function addReplay(Post $post,Comment $comment,Request $request)
{
    if(Auth::check()){

        $request->validate([
            'body'=>'required|max:2000',
        ]);
        
        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['parent_id'] = $comment->id;
        //$inputs['approved'] = 1;
        //$inputs['status'] = 1;
        $inputs['commentable_id'] = $post->id;
        $inputs['commentable_type'] = Post::class;
        Comment::create($inputs);
        return back()->with('alert-section-success',' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
    }else{
        return back()->with('alert-section-error','برای ثبت دیدگاه , ابتدا وارد حساب خود شوید');
    }
    
}
}
