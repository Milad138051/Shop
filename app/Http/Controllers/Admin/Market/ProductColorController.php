<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use App\Http\Controllers\Controller;

class ProductColorController extends Controller
{

    public function index(Product $product)
    {
        return view('admin.market.product.color.index',compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.color.create',compact('product'));
    }

    public function store(Request $request,Product $product)
    {
       $validated = $request->validate([
            'color_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'price_increase' => 'required|numeric',
        ]);
		$inputs = $request->all();
        // dd($inputs);
		$inputs['product_id']=$product->id;
		ProductColor::create($inputs);
        return redirect()->route('admin.market.product-color.index', $product->id)->with('swal-success', 'رنگ جدید شما با موفقیت ثبت شد');
		
    }


    public function destroy(ProductColor $productcolor)
    {
        $result = $productcolor->delete();
        return redirect()->route('admin.market.product-color.index',$productcolor->product->id)->with('swal-success', 'رنگ شما با موفقیت حذف شد');
    }}
