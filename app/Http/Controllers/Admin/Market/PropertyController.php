<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Category;
use App\Http\Controllers\Controller;
use App\Models\Market\CategoryAttribute;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;

class PropertyController extends Controller
{
    public function index()
    {
		$category_attributes=CategoryAttribute::all();
        return view('admin.market.property.index',compact('category_attributes'));
    }

    public function create()
    {
		
		$productCategories=Category::all();
        return view('admin.market.property.create',compact('productCategories'));
    }


    public function store(CategoryAttributeRequest $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success', 'فرم شما با موفقیت ذخیره شد');
    }

    public function edit(CategoryAttribute $categoryAttribute)
    {
       $productCategories=Category::all();
	   return view('admin.market.property.edit',compact('productCategories','categoryAttribute'));

    }


    public function update(CategoryAttributeRequest $request, CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->all();
        $categoryAttribute->update($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success', 'فرم شما با موفقیت ویرایش شد');
    }


    public function destroy(CategoryAttribute $categoryAttribute)
    {
        $result = $categoryAttribute->delete();
        return redirect()->route('admin.market.property.index')->with('swal-success', 'فرم شما با موفقیت حذف شد');
    }}
