<?php

namespace App\Http\Controllers\Front\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Market\ReviewRequest;
use App\Models\market\ProductReview;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product(Product $product)
	{

		// dd(session('shoppingCart'));
		// $relatedProducts=Product::with('category')->whereHas('category',function($q) use ($product){
		// 	$q->where('id',$product->category->id);
		// })->get()->except($product->id);

		$relatedCategoriesIdsDecoded=json_decode($product->related_categories);
		if($relatedCategoriesIdsDecoded!==null){
			$relatedProducts=Product::whereIn('category_id',$relatedCategoriesIdsDecoded)->get();
		}else{
			$relatedProducts=null;
		}		
		return view('front.market.product.product',compact('product','relatedProducts'));
	}

	public function addCommentView(Product $product)
	{
		return view('front.market.product.add-comment',compact('product'));
	}

	public function addReview(ReviewRequest $request)
	{
		if(Auth::check()){
		$datas = array_combine($request->category_attribute_ids, $request->attributeScores);
		$notAllowed=ProductReview::where('product_id',$request->product_id)->where('user_id',auth()->user()->id)->first();
		if($notAllowed==null)
		{
			foreach($datas as $key => $data)
			{
				ProductReview::create([
					'user_id'=>auth()->user()->id,
					'product_id'=>$request->product_id,
					'category_attribute_id'=>$key,
					'category_attribute_score'=>$data,
				]);
			}
			return back()->with('alert-section-success','امتیاز شما با موفقیت ذخیره شد');
			// with('toast-success','امتیاز شما با موفقیت ذخیره شد');
		
		}else{
			return back()->with('alert-section-error','شما قبلا برای این محصول, بررسی ثبت کرده اید');
			// with('toast-error','شما قبلا برای این محصول, بررسی ثبت کرده اید');
		}
	}
	else{
		return back()->with('alert-section-error','برای ثبت بررسی , ابتدا وارد حساب خود شوید');
	}
	
}
	
	public function addComment(Product $product,Request $request)
	{
	if(Auth::check()){

		$request->validate([
		'body'=>'required|max:2000',
		]);
		
        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;
        Comment::create($inputs);
		return redirect()->route('front.market.product',$product->id)->with('alert-section-success',' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
	}
	else{
		return back()->with('alert-section-error','برای ثبت دیدگاه , ابتدا وارد حساب خود شوید');
	}
}
	
	public function addReplay(Product $product,Comment $comment,Request $request)
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
			$inputs['commentable_id'] = $product->id;
			$inputs['commentable_type'] = Product::class;
			Comment::create($inputs);
			return redirect()->route('front.market.product',$product->id)->with('alert-section-success',' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
		}else{
			return back()->with('alert-section-error','برای ثبت دیدگاه , ابتدا وارد حساب خود شوید');
		}
		
	}
	
	public function addToFavorite(Product $product)
	{
	   if(Auth::check())
       {
        $product->user()->toggle([Auth::user()->id]);
        if($product->user->contains(Auth::user()->id)){
            return response()->json(['status' => 1]);
        }
        else{
            return response()->json(['status' => 2]);
        }
       }else{
        return response()->json(['status' => 3]);
	 }
	}
	
	// public function addRate(Product $product,Request $request)
	// {
	// 	if(Auth::check())
	// 	{
    // 		    $productIds=auth()->user()->isUserPurchedProduct($product->id);
	// 		    $productIds=$productIds->unique();				
	// 		}else{
	// 			return back()->with('alert-section-error','خطا');
	// 		}

	// 	auth()->user()->rate($product,$request->rating);
	// 	return back()->with('success','امتیاز شما با موفقیت ذخیره شد');
	// }
	
	
	// public function addToCompare(Product $product)
	// {
	//    if (Auth::check())
    //    {   $user=auth()->user();
	// 	   if($user->compare()->count() > 0)
	// 	   {
	// 		   $userCompareList=$user->compare;
	// 	   }else{
	// 		   $userCompareList=Compare::create(['user_id'=>$user->id]);
	// 	   }
    //        $product->compares()->toggle([$userCompareList->id]);
    //        if($product->compares->contains($userCompareList->id)){
    //         return response()->json(['status' => 1]);
    //        }
    //        else{
    //         return response()->json(['status' => 2]);
    //        }
    //    }else{
    //        return response()->json(['status' => 3]);
	//         }
	// }
	
	}
