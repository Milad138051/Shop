<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\User;
use App\Models\Market\Copan;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\AmazingSale;
use App\Http\Controllers\Controller;
use App\Models\Market\CommonDiscount;
use App\Http\Requests\Admin\Market\CopanRequest;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-copan')->only(['copan']);
        $this->middleware('can:create-copan')->only(['copanStore','copanCreate']);
        $this->middleware('can:edit-copan')->only(['copanUpdate','copanEdit']);
        $this->middleware('can:delete-copan')->only(['copanDestroy']);

        $this->middleware('can:show-commonDiscount')->only(['commonDiscount']);
        $this->middleware('can:create-commonDiscount')->only(['commonDiscountStore','commonDiscountCreate']);
        $this->middleware('can:edit-commonDiscount')->only(['commonDiscountUpdate','commonDiscountEdit']);
        $this->middleware('can:delete-commonDiscount')->only(['commonDiscountDestroy']);

        $this->middleware('can:show-amazingSale')->only(['amazingSale']);
        $this->middleware('can:create-amazingSale')->only(['amazingSaleStore','amazingSaleCreate']);
        $this->middleware('can:edit-amazingSale')->only(['amazingSaleUpdate','amazingSaleEdit']);
        $this->middleware('can:delete-amazingSale')->only(['amazingSaleDestroy']);
    }
    public function copan()
    {
        $copans = Copan::orderBy('id', 'desc')->paginate(10)->withQueryString();
        return view('admin.market.discount.copan.copan', compact('copans'));
    }
    public function copanCreate()
    {
        // dd('inputs');

        $users = User::orderBy('id', 'desc')->get();
        return view('admin.market.discount.copan.copan-create', compact('users'));
    }
    public function copanStore(CopanRequest $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        //date fixed
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int) $realTimestampEnd);

        if ($inputs['type'] == 0) {
            $inputs['user_id'] = null;
        }
        $copan = Copan::create($inputs);
        return redirect()->route('admin.market.discount.copan')->with('swal-success', 'ایتم جدید شما با موفقیت ثبت شد');
    }
    public function copanEdit(Copan $copan)
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.market.discount.copan.copan-edit', compact('copan', 'users'));
    }
    public function copanUpdate(CopanRequest $request, Copan $copan)
    {
        $inputs = $request->all();
        // dd($inputs);
        //date fixed
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int) $realTimestampEnd);

        if ($inputs['type'] == 0) {
            $inputs['user_id'] = null;
        }
        $copan = $copan->update($inputs);
        return redirect()->route('admin.market.discount.copan')->with('swal-success', 'ایتم با موفقیت ویرایش شد');
    }
    public function copanDestroy(Copan $copan)
    {
        $result = $copan->delete();
        return redirect()->route('admin.market.discount.copan')->with('swal-success', 'ایتم با موفقیت حذف شد');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('admin.market.discount.common.common-discount', compact('commonDiscounts'));
    }
    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common.common-discount-create');
    }
    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int) $realTimestampEnd);

        $commonDiscount = CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'ایتم جدید شما با موفقیت ثبت شد');
    }
    public function commonDiscountEdit(CommonDiscount $commonDiscount)
    {
        return view('admin.market.discount.common.common-discount-edit', compact('commonDiscount'));
    }
    public function commonDiscountUpdate(CommonDiscountRequest $request, CommonDiscount $commonDiscount)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int) $realTimestampEnd);

        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'ایتم با موفقیت ویرایش شد');
    }
    public function commonDiscountDestroy(CommonDiscount $commonDiscount)
    {
        $result = $commonDiscount->delete();
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'ایتم با موفقیت حذف شد');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function amazingSale(Request $request)
    {
        if($request->search){
			$resultIds=Product::where('name','LIKE',"%".$request->search."%")->pluck('id')->toArray();
            $amazingSales=AmazingSale::whereIn('product_id',$resultIds)->orderBy('id','DESC')->paginate(10)->withQueryString();
		}else{
            $amazingSales = AmazingSale::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
		}  

        return view('admin.market.discount.amazing-sale.amazing-sale', compact('amazingSales'));
    }
    public function amazingSaleCreate()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('admin.market.discount.amazing-sale.amazing-sale-create', compact('products'));
    }
    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        // dd($inputs);

        //date fixed
        $realTimestampStart = substr($request->start_date, 0, 10);
        $start_date = date("Y-m-d H:i:s", (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $end_date = date("Y-m-d H:i:s", (int) $realTimestampEnd);
        //

        foreach($request->product_id as $id)
        {
            $amazingSale = AmazingSale::create([
                'percentage'=>$request->percentage,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'status'=>$request->status,
                'product_id'=>$id,
            ]);
        }
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'ایتم جدید شما با موفقیت ثبت شد');
    }
    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('admin.market.discount.amazing-sale.amazing-sale-edit', compact('amazingSale', 'products'));
    }
    public function amazingSaleUpdate(amazingSaleRequest $request, AmazingSale $amazingSale)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int) $realTimestampEnd);

        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'ایتم با موفقیت ویرایش شد');
    }
    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $result = $amazingSale->delete();
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'ایتم با موفقیت حذف شد');
    }
}
