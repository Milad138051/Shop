<?php

namespace App\Http\Requests\Front\Profile;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'address' => 'required|min:1|max:300',
                'postal_code' => ['required'],
                // 'postal_code' => ['required', new PostalCode()],
                'no' => 'required',
                'unit' => 'required',
                'receiver' => 'sometimes',
                'mobile' => 'required',
            ];
          }else{
            return [
                'address' => 'required|min:1|max:300',
                'postal_code' => ['required'],
                // 'postal_code' => ['required', new PostalCode()],
                'no' => 'required',
                'unit' => 'required',
                'receiver' => 'sometimes',
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
