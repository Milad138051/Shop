<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Models\Market\Banner;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\BannerRequest;

class BannerController extends Controller
{
    public function index()
    {
		$banners=Banner::orderby('created_at','desc')->simplePaginate(15);
		$positions=Banner::$positions;
        return view('admin.market.banner.index',compact('banners','positions'));
    }


    public function create()
    {
		$positions=Banner::$positions;
        return view('admin.market.banner.create',compact('positions'));
    }


    public function store(BannerRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banners');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.banner.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        $banner = Banner::create($inputs);
        return redirect()->route('admin.market.banner.index')->with('swal-success', 'بنر  جدید شما با موفقیت ثبت شد');
    }

    public function edit(Banner $banner)
    {
		$positions=Banner::$positions;
        return view('admin.market.banner.edit',compact('banner','positions'));
    }


    public function update(BannerRequest $request, Banner $banner,ImageService $imageService)
    {
        $inputs = $request->all();
        // dd($inputs);
        if ($request->hasFile('image')) {
            if (!empty($banner->image)) {
                $imageService->deleteImage($banner->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banners');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.banner.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        $banner->update($inputs);
        return redirect()->route('admin.market.banner.index')->with('swal-success', 'بنر  شما با موفقیت ویرایش شد');
    }


    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.market.banner.index')->with('swal-success','ایتم مورد نظر با موفقیت حذف شد ');
    }
	
	 public function status(Banner $banner)
    {
      $banner->status=$banner->status==0 ? 1 : 0 ;
      $result=$banner->save();
      if ($result) {
		  
        if ($banner->status==0) {
          return response()->json(['status'=>true,'checked'=>false]);
        }else {
          return response()->json(['status'=>true,'checked'=>true]);
        }
      }
	  else{
        return response()->json(['status'=>false]);
     }
	}


}
