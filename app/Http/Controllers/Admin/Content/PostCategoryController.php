<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\PostCategoryRequest;

class PostCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-postCategory')->only(['index']);
        $this->middleware('can:create-postCategory')->only(['store','create']);
        $this->middleware('can:edit-postCategory')->only(['update','edit']);
        $this->middleware('can:delete-postCategory')->only(['delete']);
    }

    public function index()
    {
        $postCategories=PostCategory::orderBy('id','Desc')->paginate(10);
        return view('admin.content.postCategory.index',compact('postCategories'));
    }

    public function show()
    {

    }

    public function create()
    {
        return view('admin.content.postCategory.create');
    }

    public function store(PostCategoryRequest $request,ImageService $imageService)
    {
        $inputs=$request->all();
        // dd($request->all());
        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result === false)
            {
                return redirect()->route('admin.content.postCategory.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        PostCategory::create($inputs);
        return to_route('admin.content.postCategory.index')->with('swal-success', 'ایتم  جدید شما با موفقیت ثبت شد');;

    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.content.postCategory.edit',compact('postCategory'));
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
                return redirect()->route('admin.content.postCategory.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
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
        return to_route('admin.content.postCategory.index')->with('swal-success', 'ایتم شما با موفقیت ویرایش شد');;
    }


    public function delete(PostCategory $postCategory)
    {
        $postCategory->delete();
        return to_route('admin.content.postCategory.index')->with('swal-success', 'ایتم شما با موفقیت حذف شد');;
    }
}
