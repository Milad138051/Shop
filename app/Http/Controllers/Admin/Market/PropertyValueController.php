<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market\CategoryValue;
use App\Models\Market\CategoryAttribute;
use App\Http\Requests\Admin\Market\CategoryValueRequest;

class PropertyValueController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:value-option');

    }
    public function index(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.index', compact('categoryAttribute'));
    }

    public function create(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.create', compact('categoryAttribute'));
    }

    public function store(CategoryValueRequest $request ,CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $value = CategoryValue::create($inputs);
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)->with('swal-success', 'مقدار فرم کالای جدید شما با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(CategoryAttribute $categoryAttribute,CategoryValue $categoryValue)
    {
	
       return view('admin.market.property.value.edit', compact('categoryAttribute','categoryValue'));

    }

    public function update(CategoryValueRequest $request ,CategoryAttribute $categoryAttribute,CategoryValue $categoryValue)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $value = $categoryValue->update($inputs);
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)->with('swal-success', 'مقدار فرم کالای  شما با موفقیت ویرایش شد');
    }

    public function destroy(CategoryAttribute $categoryAttribute, CategoryValue $categoryValue)
    {
        $result = $categoryValue->delete();
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)->with('swal-success', 'مقدار فرم کالای  شما با موفقیت حذف شد');
    }

}
