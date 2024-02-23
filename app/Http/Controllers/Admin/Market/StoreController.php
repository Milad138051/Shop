<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreRequest;

class StoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:store-show');
    }
    
    public function index(Request $request)
    {
        if($request->search){
            $products=Product::where('name','LIKE',"%".$request->search."%")->orderBy('id','DESC')->paginate(1)->withQueryString();
		}else{
            $products=Product::orderBy('created_at','desc')->paginate(10)->withQueryString();
		}   
        
        return view('admin.market.store.index',compact('products'));
    }

    public function edit(Product $product)
    {
        return view('admin.market.store.edit', compact('product'));
    }


    public function update(StoreRequest $request, Product $product)
    {
        $inputs = $request->all();
        $product->update($inputs);
        return redirect()->route('admin.market.store.index')->with('swal-success', 'موجودی  با موفقیت ویرایش شد');
    }

}
