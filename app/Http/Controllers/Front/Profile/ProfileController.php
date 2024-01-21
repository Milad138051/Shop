<?php

namespace App\Http\Controllers\Front\Profile;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Front\Profile\AddressRequest;
use App\Http\Requests\Front\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
	public function profile()
	{
		return view('front.profile.profile');
	}


	public function updateView()
	{
		return view('front.profile.profile-update');
	}

	public function update(UpdateProfileRequest $request,ImageService $imageService)
	{
		$inputs =$request->all();
        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'profile_photo_path');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return back()->with('alert-section-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
		$user = auth()->user();
		$user->update($inputs);
		return redirect()->back()->with('alert-section-success', 'اطلاعات حساب شما با موفقیت  ثبت شد');
	}

}
