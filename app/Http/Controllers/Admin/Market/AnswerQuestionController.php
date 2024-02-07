<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\AnswerQuestion;
use Illuminate\Http\Request;

class AnswerQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-questionAnswer')->only(['index','show']);
        $this->middleware('can:approved-questionAnswer')->only(['approved']);
        $this->middleware('can:answer-questionAnswer')->only(['answer']);
    }

    public function index()
    {
	    $items=AnswerQuestion::orderBy('id','DESC')->paginate(10);		
        return view('admin.market.answer-question.index',compact('items'));
    }


    public function show(AnswerQuestion $answerQuestion)
    {
        $answerQuestion->seen = 1;
        $answerQuestion->save();
        return view('admin.market.answer-question.show', compact('answerQuestion'));
    }

    public function approved(AnswerQuestion $answerQuestion)
    {
        $answerQuestion->approved = $answerQuestion->approved == 0 ? 1 : 0;
        $result = $answerQuestion->save();
        if ($result) {
            return redirect()->route('admin.market.question-answer.index')->with('swal-success', ' وضعیت ایتم با موفقیت تغییر کرد');
        } else {
            return redirect()->route('admin.market.question-answer.index')->with('swal-error', ' خطایی رخ داد');
        }
    }


    public function answer(Request $request, AnswerQuestion $answerQuestion)
    {
        if ($answerQuestion->parent == null) {

            $validated = $request->validate([
                'body' => 'required|min:2|max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'
            ]);

            $inputs = $request->all();
            $inputs['author_id'] = 1;
            $inputs['parent_id'] = $answerQuestion->id;
            $inputs['product_id'] = $answerQuestion->product_id;
            $inputs['approved'] = 1;
            $inputs['status'] = 1;

            AnswerQuestion::create($inputs);
            return redirect()->route('admin.market.question-answer.index')->with('swal-success', 'پاسخ با موفقیت ثبت شد');

        } else {

            return redirect()->route('admin.market.question-answer.index')->with('swal-error', 'خطایی رخ داد');

        }

    }

}
