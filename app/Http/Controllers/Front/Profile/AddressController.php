<?php

namespace App\Http\Controllers\Front\Profile;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Profile\AddressRequest;

class AddressController extends Controller
{
	public function index()
	{
		$addresses=Address::where('user_id',auth()->user()->id)->get();
		return view('front.profile.addresses',compact('addresses'));
	}

	public function addAddress(AddressRequest $request)
	{
		// dd('ss');
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
		return back()->with('alert-section-success','ادرس شما با موفقیت ثبت شد');
	}

	public function deleteAddress(Address $address)
	{
		$address->delete();
		return back()->with('alert-section-success', 'آیتم با موفقیت حذف شد');
	}
}
