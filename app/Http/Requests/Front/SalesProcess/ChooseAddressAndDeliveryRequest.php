<?php

namespace App\Http\Requests\Front\SalesProcess;

use Illuminate\Foundation\Http\FormRequest;

class ChooseAddressAndDeliveryRequest extends FormRequest
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
    public function rules()
    {
        return [
            'address_id'=>'required|exists:addresses,id',
            'delivery_id'=>'required|exists:delivery,id',
        ];
    }
	
	public function attributes()
	{
		return [
		'address_id'=>'آدرس',
		'delivery_id'=>'شیوه ارسال',
		];
	}
}
