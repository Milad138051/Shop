<?php

namespace App\Http\Requests\Front\Profile;

use App\Rules\PostalCode;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // dd('sss');
        if($this->isMethod('post')){
            return [
                'address' => 'required|min:1|max:300',
                'mobile' => 'required',
                'recipient_name' => 'required|string',
                'city' => 'required',
                'province' => 'required',
                // 'postal_code' => ['required'],
                'postal_code' => ['required', new PostalCode()],
                'no' => 'required',
                'unit' => 'required',
            ];
          }else{
            return [
                'address' => 'required|min:1|max:300',
                // 'postal_code' => ['required'],
                'postal_code' => ['required', new PostalCode()],
                'no' => 'required',
                'unit' => 'required',
                'city' => 'required',
                'province' => 'required',
                'recipient_name' => 'required|string',
                'mobile' => 'required',
            ];
          }
    }

    public function attributes()
    {
        return [
            'unit' => 'واحد',
            'mobile' => 'موبایل گیرنده',
        ];
    }
}
