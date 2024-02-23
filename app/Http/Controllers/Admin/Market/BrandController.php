<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\BrandRequest;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-brand')->only(['index']);
        $this->middleware('can:create-brand')->only(['craete', 'store']);
        $this->middleware('can:update-brand')->only(['edit', 'update']);
        $this->middleware('can:delete-brand')->only(['delete']);

    }
    public function index()
    {
	    $brands = Brand::orderBy('id','desc')->paginate(10)->withQueryString();
        return view('admin.market.brand.index',compact('brands'));

    }


    public function create()
    {
        return view('admin.market.brand.create');
    }

    public function store(BrandRequest $request,ImageService $imageService)
    {
         $inputs = $request->all();
        if($request->hasFile('logo'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brands');
            $result = $imageService->createIndexAndSave($request->file('logo'));

            if($result === false)
            {
                return redirect()->route('admin.market.brand.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        }

        Brand::create($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'ایتم با موفقیت ذخیره شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit',compact('brand'));
    }


      public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {
        $inputs = $request->all();
        // dd($inputs);

        if($request->hasFile('logo'))
        {
            if(!empty($brand->logo))
            {
                $imageService->deleteDirectoryAndFiles($brand->logo['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brands');
            $result = $imageService->createIndexAndSave($request->file('logo'));
            if($result === false)
            {
                return redirect()->route('admin.market.brand.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        }
        else{
            if(isset($inputs['currentImage']) && !empty($brand->logo))
            {
                $image = $brand->logo;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['logo'] = $image;
            }
        }
        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'ایتم با موفقیت ویرایش شد');
    }

    public function delete(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.market.brand.index')->with('swal-success','ایتم مورد نظر با موفقیت حذف شد ');
    }
}
