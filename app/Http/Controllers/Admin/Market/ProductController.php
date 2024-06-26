<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\Category;
use App\Models\Market\ProductMeta;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\ProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-product')->only(['index']);
        $this->middleware('can:create-product')->only(['store','create']);
        $this->middleware('can:edit-product')->only(['update','edit']);
        $this->middleware('can:delete-product')->only(['destroy']);
    }
    public function index(Request $request)
    {
        if ($request->search) {
			$products=Product::where('name','LIKE',"%".$request->search."%")->orderBy('created_at','desc')->paginate(2)->withQueryString();
        }
        else{
            $products=Product::orderBy('created_at','desc')->paginate(10)->withQueryString();
        }

        return view('admin.market.product.index',compact('products'));
    }

    public function create()
    {
		
		$productCategories=Category::all();
		$brands=Brand::all();
        return view('admin.market.product.create',compact('productCategories','brands'));
    }
    public function store(ProductRequest $request, ImageService $imageService)
    {
		
        $inputs = $request->all();
		$inputs['related_categories'] = json_encode($request->relatedCategories);
		
		//date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');
            $result = $imageService->createIndexAndSave($request->file('image'));
         if($result === false)
         {
            return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
         }      
         $inputs['image'] = $result;
	    }
      
        DB::transaction(function () use ($request, $inputs) {
			//dd($inputs);
        $product = Product::create($inputs);
		/////////////////////////////////////////////
        $metas = array_combine($request->meta_key, $request->meta_value);
        foreach($metas as $key => $value){
            $meta = ProductMeta::create([
                'meta_key' => $key,
                'meta_value' => $value,
                'product_id' => $product->id
            ]);
        }
    });
		////////////////////////////////////////////////////////////////////
		
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول شما با موفقیت ثبت شد');
    }

    public function edit(Product $product)
    {		
        $productCategories=Category::all();
		$brands=Brand::all();
		
        return view('admin.market.product.edit',compact('productCategories','brands','product'));
    }

    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

		$inputs['related_categories'] = json_encode($request->relatedCategories);


        if ($request->hasFile('image')) {
            if (!empty($product->image)) {
                $imageService->deleteDirectoryAndFiles($product->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        } else {
            if (isset($inputs['currentImage']) && !empty($product->image)) {
                $image = $product->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
		DB::transaction(function () use ($request, $inputs,$product) {
		$inputs['slug'] =null;
		$product->update($inputs);
		
		if($request->meta_key and $request->meta_value !== null){
		ProductMeta::where('product_id',$product->id)->forceDelete();
		}
		
		$metas = array_combine($request->meta_key, $request->meta_value);
		
        foreach($metas as $key => $value){
            $meta = ProductMeta::create([
                'meta_key' => $key,
                'meta_value' => $value,
                'product_id' => $product->id
            ]);
		 }
		});
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول  شما با موفقیت ویرایش شد');
	
		
    }
     public function destroy(Product $product)
    {
        $result = $product->delete();
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول  شما با موفقیت حذف شد');
    }

}
