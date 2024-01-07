<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Delivery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\DeliveryRequest;

class DeliveryController extends Controller
{
    public function index()
    {
        $delivery_methods = Delivery::all();
        return view('admin.market.delivery.index', compact('delivery_methods'));
    }

    public function create()
    {
        return view('admin.market.delivery.create');
    }


    public function store(DeliveryRequest $request)
    {
        $inputs = $request->all();
        $delivery = Delivery::create($inputs);
        return redirect()->route('admin.market.delivery.index')->with('swal-success', 'روش ارسال جدید شما با موفقیت ثبت شد');
    }


    public function show($id)
    {
        //
    }

    public function edit(Delivery $delivery)
    {
        return view('admin.market.delivery.edit', compact('delivery'));
    }


    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        $inputs = $request->all();
        $delivery->update($inputs);
        return redirect()->route('admin.market.delivery.index')->with('swal-success', 'روش ارسال شما با موفقیت ویرایش شد');
    }

   
    public function destroy(Delivery $delivery)
    {
        $result = $delivery->delete();
       return redirect()->route('admin.market.delivery.index')->with('swal-success', 'روش ارسال شما با موفقیت حذف شد');
    }

}
