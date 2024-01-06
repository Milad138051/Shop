<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'percentage' => 'required|max:100|min:1|numeric',
            'discount_ceiling' => 'required|max:100000000000000|min:1|numeric',
            'minimal_order_amount' => 'required|max:1000000000000|min:1|numeric',
            'status' => 'required|numeric|in:0,1',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
        ];
    }



    public function attributes()
    {
        return
            [
                'title' => 'عنوان مناسبت'
            ];
    }
}
