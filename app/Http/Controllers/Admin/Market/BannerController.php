<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Banner;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\BannerRequest;

class BannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-banner')->only(['index']);
        $this->middleware('can:create-banner')->only(['craete', 'store']);
        $this->middleware('can:update-banner')->only(['edit', 'update','status']);
        $this->middleware('can:delete-banner')->only(['destroy']);

        // $this->middleware('role:market-admin');
        // $this->middleware('role:super-admin');
        // $this->middleware('role:operator')->only(['create']);
        // $this->middleware('role:accounting')->only(['store']);
        // $this->middleware('role:operator')->only(['edit']);
        // $this->middleware('can:show-category')->only(['index']);
        // $this->middleware('can:update-category')->only(['edit', 'update']);
    }

    public function index()
    {
		$banners=Banner::orderby('created_at','desc')->paginate(10)->withQueryString();
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
