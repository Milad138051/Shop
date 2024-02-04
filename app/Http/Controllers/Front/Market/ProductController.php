<?php

namespace App\Http\Controllers\Front\Market;

use App\Models\Market\AnswerQuestion;
use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Market\Compare;
use App\Models\Market\Product;
use App\Models\Content\Comment;
use App\Models\Market\CartItem;
use App\Models\Market\Category;
use App\Http\Controllers\Controller;
use App\Models\market\ProductReview;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Front\Market\ReviewRequest;

class ProductController extends Controller
{
    public function product(Product $product)
	{
		// $relatedProducts=Product::with('category')->whereHas('category',function($q) use ($product){
		// 	$q->where('id',$product->category->id);
		// })->get()->except($product->id);
		$product->update(['viewed'=> $product->viewed += 1]);

		$relatedCategoriesIdsDecoded=json_decode($product->related_categories);
		if($relatedCategoriesIdsDecoded!==null){
			$relatedProducts=Product::whereIn('category_id',$relatedCategoriesIdsDecoded)->get()->except($product->id);;
		}else{
			$relatedProducts=null;
		}		
		return view('front.market.product.product',compact('product','relatedProducts'));
	}

	public function products(Request $request,Category $category=null)
	{
		//sorting
		switch($request->sort){
		    case "1":
            $column='created_at';
            $direction='DESC';
            break;	
		
            case "2":
                $column = "price";
                $direction = "DESC";
                break;
            case "3":
                $column = "price";
                $direction = "ASC";
                break;
            case "4":
                $column = "viewed";
                $direction = "DESC";
                break;
            case "5":
                $column = "sold_number";
                $direction = "DESC";
                break;
            default:
                $column = "created_at";
                $direction = "ASC";
        }
		//	
		//selection productCtegory
		if($category){
		$category->update(['viewed'=>$category->viewed += 1]);
		$productModel=$category->products();
		}else{
		$productModel=new Product();
		}
		//
		//search by name
		if($request->search){
			$baseQuery=$productModel->where('name','LIKE',"%".$request->search."%")->orderBy($column,$direction);
		}else{
            $baseQuery=$productModel->orderBy($column, $direction);
		}
		//
		//get selectedBrandsName
		if($request->brands){
			$selectedBrandsArray=[];
			$selectedBrandsColl=Brand::find($request->brands);
			foreach($selectedBrandsColl as $selectedBrandColl){
				array_push($selectedBrandsArray,$selectedBrandColl->original_name);
			}
		}else{
			$selectedBrandsArray=[];
		}
		//
		$brands=Brand::all();
		$categories=Category::whereNull('parent_id')->where('status',1)->get();
		//mahdode price
		$products=$request->min_price && $request->max_price ? $baseQuery->whereBetween('price',[$request->min_price,$request->max_price]) :
		$baseQuery->when($request->min_price,function ($baseQuery) use ($request){
			$baseQuery->where('price','>=',$request->min_price)->get();
		})->when($request->max_price,function ($baseQuery) use ($request){
			$baseQuery->where('price','<=',$request->max_price)->get();
		})->when(!($request->min_price && $request->max_price),function ($baseQuery){
			$baseQuery->get();
		});
		//
		//filter by brands
		$products->when($request->brands,function() use ($request,$products){
			$products->whereIn('brand_id',$request->brands);
		});
		//
        
		// dd($products->get());
		$products = $products->paginate(4);
		
		return view('front.market.products',compact('products','brands','selectedBrandsArray','categories'));
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
		return redirect()->route('front.market.product',$product)->with('alert-section-success',' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
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
			return redirect()->route('front.market.product',$product)->with('alert-section-success',' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
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
       }
	}
	
	public function addRate(Product $product,Request $request)
	{
		if(Auth::check())
		{
    		    $productIds=auth()->user()->isUserPurchedProduct($product->id);
			    $productIds=$productIds->unique();				
			}else{
				return back()->with('alert-section-error','خطا');
			}

		auth()->user()->rate($product,$request->rating);
		return back()->with('alert-section-success','امتیاز شما با موفقیت ذخیره شد');
	}
	
	
	public function addToCompare(Product $product)
	{
	   if (Auth::check())
       { 
		  $user=auth()->user();
		   if($user->compare()->count() > 0)
		   {
			   $userCompareList=$user->compare;
		   }else{
			   $userCompareList=Compare::create(['user_id'=>$user->id]);
		   }
           $product->compares()->toggle([$userCompareList->id]);
           if($product->compares->contains($userCompareList->id)){
            return response()->json(['status' => 1]);
           }
           else{
            return response()->json(['status' => 2]);
           }
       }
	}
	
	public function addQuestion(Product $product,Request $request)
	{
	if(Auth::check()){

		$request->validate([
		'body'=>'required|max:2000',
		]);
		
        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['product_id'] = $product->id;
		// $inputs['approved'] = 1;
		$inputs['status'] = 1;
        AnswerQuestion::create($inputs);
		return redirect()->route('front.market.product',$product)->with('alert-section-success',' سوال شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
	}
	else{
		return back()->with('alert-section-error','برای ثبت سوال , ابتدا وارد حساب خود شوید');
	}
}
	
	public function addQuestionReplay(Product $product,AnswerQuestion $answerQuestion,Request $request)
	{
		if(Auth::check()){
			$request->validate([
				'body'=>'required|max:2000',
			]);
			
			$inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
			$inputs['author_id'] = Auth::user()->id;
			$inputs['parent_id'] = $answerQuestion->id;
			// $inputs['approved'] = 1;
			$inputs['status'] = 1;
			$inputs['product_id'] = $product->id;
			// dd($inputs);
			AnswerQuestion::create($inputs);
			return redirect()->route('front.market.product',$product)->with('alert-section-success',' جواب شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
		}else{
			return back()->with('alert-section-error','برای ثبت جواب , ابتدا وارد حساب خود شوید');
		}
		
	}


	
}
