<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Gallery;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;

class GalleryController extends Controller
{

    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index',compact('product'));
    }


    public function create(Product $product)
    {
        return view('admin.market.product.gallery.create',compact('product'));
    }

    public function store(Request $request,Product $product,ImageService $imageService)
    {
		
       $validated = $request->validate([
          'image' => 'required|image|mimes:png,jpg,jpeg,gif',
        ]);

		
	    $inputs=$request->all();
		
		if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result === false)
            {
                return redirect()->route('admin.market.product.gallery.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

		$inputs['product_id']=$product->id;
        Gallery::create($inputs);
        return redirect()->route('admin.market.product.gallery.index',$product->id)->with('swal-success', 'ایتم با موفقیت ذخیره شد');
		
    }


    public function destroy(Gallery $gallery)
    {
		$gallery->delete();
        return redirect()->route('admin.market.product.gallery.index',$gallery->product->id)->with('swal-success','ایتم مورد نظر با موفقیت حذف شد ');
    }

}
