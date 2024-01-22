<?php

namespace App\Http\Controllers\Front\Profile;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index()
    {
		return view('front.profile.favorites');
    }

    public function delete(Product $product)
	{
		$user=auth()->user();
		$user->products()->detach($product->id);
		return redirect()->back()->with('alert-section-success','محصول با موفقیت از لیست علاقه مندیهای شما حذف شد');
	}
}
