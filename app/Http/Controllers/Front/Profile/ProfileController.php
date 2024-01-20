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


	///////////////////////////////////////////////////
	//addresses
	public function adresses()
	{
		$addresses=Address::where('user_id',auth()->user()->id)->get();
		return view('front.profile.addresses',compact('addresses'));
	}

	public function addAddress(AddressRequest $request)
	{
		$inputs=$request->all();
		$inputs['user_id']=auth()->user()->id;
		$inputs['postal_code']=convertArabicToEnglish($request->postal_code);
		$inputs['postal_code']=convertPersianToEnglish($inputs['postal_code']);
		Address::create($inputs);
		return back()->with('alert-section-success','ادرس شما با موفقیت ثبت شد');
	}

	public function updateAdresses(AddressRequest $request,Address $address)
	{
		$inputs=$request->all();
		//dd($address,$inputs);
		$inputs['user_id']=auth()->user()->id;
		$inputs['postal_code']=convertArabicToEnglish($request->postal_code);
		$inputs['postal_code']=convertPersianToEnglish($inputs['postal_code']);
		$address->update($inputs);
		return back()->with('alert-sestion-success','ادرس شما با موفقیت ثبت شد');
	}

	public function deleteAddress(Address $address)
	{
		$address->delete();
		return back()->with('alert-section-success', 'آیتم با موفقیت حذف شد');
	}
	///////////////////////////////////////////////////
}
