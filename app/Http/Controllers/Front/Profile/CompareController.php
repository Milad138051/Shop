<?php

namespace App\Http\Controllers\Front\Profile;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class CompareController extends Controller
{
    public function index()
	{
		return view('front.profile.compares');
	}
	
    public function delete(Product $product)
	{
        // dd('ss');
		$user=auth()->user();
		$user->compare->products()->detach($product->id);
		return back()->with('alert-section-success','محصول با موفقیت از لیست حذف شد');
	}

}
