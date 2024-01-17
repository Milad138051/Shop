<?php

namespace App\Http\Requests\Front\Market;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:products,id',
            // 'user_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:users,id',
            // <!-- 'category_attribute_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:categoery_attributes,id', -->
            'attribute-*' => 'required|numeric|exists:category_attributes,id',
        ];
    }
}
