<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-productComment')->only(['index','show']);
        $this->middleware('can:approved-productComment')->only(['approved']);
        $this->middleware('can:answer-productComment')->only(['answer']);
    }

    public function index()
    {
    //    $commentsUnseen=Comment::where('commentable_type','App\Models\Market\Product')->where('seen',0)->get();
	// 	foreach($commentsUnseen as $item){
			
	// 		$item->seen=1;
	// 		$res=$item->save();
	// 	}
	    $comments=Comment::orderBy('id','DESC')->where('commentable_type','App\Models\Market\Product')->paginate(10);
		
        return view('admin.market.comment.index',compact('comments'));

    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show(Comment $comment)
    {
        $comment->seen = 1;
        $comment->save();
        return view('admin.market.comment.show', compact('comment'));
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function delete($id)
    {
        //
    }



    public function approved(Comment $comment)
    {

        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            return redirect()->route('admin.market.comment.index')->with('swal-success', ' وضعیت نظر با موفقیت تغییر کرد');
        } else {
            return redirect()->route('admin.market.comment.index')->with('swal-error', ' خطایی رخ داد');
        }
    }



    public function answer(CommentRequest $request, Comment $comment)
    {
        if ($comment->parent == null) {

            $inputs = $request->all();
            $inputs['author_id'] = 1;
            $inputs['parent_id'] = $comment->id;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['approved'] = 1;
            $inputs['status'] = 1;

            Comment::create($inputs);
            return redirect()->route('admin.market.comment.index')->with('swal-success', 'پاسخ با موفقیت ثبت شد');

        } else {

            return redirect()->route('admin.market.comment.index')->with('swal-error', 'خطایی رخ داد');

        }

    }

}
