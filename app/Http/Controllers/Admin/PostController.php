<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::orderBy('id','DESC')->get();
        return view('admin.post.index',compact('posts'));
    }
    
    public function show()
    {

    }

    public function create()
    {
        $postCategories=PostCategory::all();
        return view('admin.post.create',compact('postCategories'));
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
                return redirect()->route('admin.post.index');
                // ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
            $inputs['author_id']= 1;
        }

        Post::create($inputs);
        return to_route('admin.post.index');

    }

    public function edit(Post $post)
    {
        $postCategories=PostCategory::all();
        return view('admin.post.edit',compact('post','postCategories'));
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
                return redirect()->route('admin.post.index');
                // ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
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
        return to_route('admin.post.index');
    }


    public function delete(Post $post)
    {
        $post->delete();
        return to_route('admin.post.index');
    }
}


