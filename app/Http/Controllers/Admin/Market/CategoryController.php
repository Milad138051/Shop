<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Category;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $productCategories =Category::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.category.index', compact('productCategories'));
    }


    public function create()
    {
		// $categories = Category::all();
        $categories = Category::where('parent_id', null)->get();
        return view('admin.market.category.create', compact('categories'));
    }


    public function store(CategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
     //   dd($inputs);
        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
         if($result === false)
        {
            return redirect()->route('admin.market.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
         }  
		}
       
        $inputs['image'] = $result;
        Category::create($inputs);
        return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی جدید شما با موفقیت ثبت شد');
    }


    public function show($id)
    {
        //
    }

    public function edit(Category $productCategory)
    {
    //    $parent_categories = Category::all()->except($productCategory->id);
       $parent_categories = Category::where('parent_id', null)->get()->except($productCategory->id);
       return view('admin.market.category.edit', compact('productCategory', 'parent_categories'));
    }

    public function update(CategoryRequest $request, Category $productCategory, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image'))
        {
            if(!empty($productCategory->image))
            {
                $imageService->deleteDirectoryAndFiles($productCategory->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.market.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        else{
            if(isset($inputs['currentImage']) && !empty($productCategory->image))
            {
                $image = $productCategory->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $productCategory->update($inputs);
        return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی شما با موفقیت ویرایش شد');
    }


    public function delete(Category $productCategory)
    {
       $result = $productCategory->delete();
       return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی شما با موفقیت حذف شد');
    }
}
