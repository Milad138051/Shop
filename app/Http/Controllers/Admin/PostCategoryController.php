<?php

namespace App\Http\Controllers\Admin;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\PostCategoryRequest;

class PostCategoryController extends Controller
{
    public function index()
    {
        $postCategories=PostCategory::orderBy('id','Desc')->get();
        return view('admin.postCategory.index',compact('postCategories'));
    }

    public function show()
    {

    }

    public function create()
    {
        return view('admin.postCategory.create');
    }

    public function store(PostCategoryRequest $request,ImageService $imageService)
    {
        $inputs=$request->all();
        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result === false)
            {
                return redirect()->route('admin.postCategory.index');
                // ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        PostCategory::create($inputs);
        return to_route('admin.postCategory.index');

    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.postCategory.edit',compact('postCategory'));
    }

    public function update(PostCategoryRequest $request,PostCategory $postCategory,ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image'))
        {
            if(!empty($postCategory->image))
            {
                $imageService->deleteDirectoryAndFiles($postCategory->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.postCategory.index');
                // ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        else{
            if(isset($inputs['currentImage']) && !empty($postCategory->image))
            {
                $image = $postCategory->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $postCategory->update($inputs);
        return to_route('admin.postCategory.index');
    }


    public function delete(PostCategory $postCategory)
    {
        $postCategory->delete();
        return to_route('admin.postCategory.index');
    }
}
