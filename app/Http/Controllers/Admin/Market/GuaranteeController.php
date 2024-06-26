<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\Guarantee;
use App\Http\Controllers\Controller;

class GuaranteeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:guarantee-product');
    }

    public function index(Product $product)
    {
        return view('admin.market.product.guarantee.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.guarantee.create', compact('product'));
    }


    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price_increase' => 'required|numeric'
        ]);
        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        $guarantee = Guarantee::create($inputs);
        return redirect()->route('admin.market.guarantee.index', $product->id)->with('swal-success', 'گارانتی شما با موفقیت ثبت شد');
    }


    public function destroy(Product $product, Guarantee $guarantee)
    {
        $guarantee->delete();
        return back();
    }
}
