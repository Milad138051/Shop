<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-post')->only(['index']);
        $this->middleware('can:create-post')->only(['store','create']);
        $this->middleware('can:edit-post')->only(['update','edit']);
        $this->middleware('can:delete-post')->only(['delete']);
    }

    public function index()
    {
        $posts=Post::orderBy('id','DESC')->paginate(10);
        return view('admin.content.post.index',compact('posts'));
    }
    
    public function show()
    {

    }

    public function create()
    {
        $postCategories=PostCategory::all();
        return view('admin.content.post.create',compact('postCategories'));
    }

    public function store(PostRequest $request,ImageService $imageService)
    {
        $inputs=$request->all();
        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
            $inputs['author_id']= 1;
        }

        Post::create($inputs);
        return to_route('admin.content.post.index')->with('swal-success', 'ایتم  جدید شما با موفقیت ثبت شد');

    }

    public function edit(Post $post)
    {
        $postCategories=PostCategory::all();
        return view('admin.content.post.edit',compact('post','postCategories'));
    }

    public function update(PostRequest $request,Post $post,ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image'))
        {
            if(!empty($post->image))
            {
                $imageService->deleteDirectoryAndFiles($post->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        else{
            if(isset($inputs['currentImage']) && !empty($post->image))
            {
                $image = $post->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $post->update($inputs);
        return to_route('admin.content.post.index')->with('swal-success', 'ویرایش  شما با موفقیت ثبت شد');;
    }


    public function delete(Post $post)
    {
        $post->delete();
        return to_route('admin.content.post.index')->with('swal-success', 'ایتم شما با موفقیت حذف شد');;
    }
}


