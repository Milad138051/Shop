<?php

namespace App\Http\Requests\Front\Profile;

use App\Rules\NationalCode;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        return[
        'name' => 'nullable|string|min:3',
        'first_name' => 'nullable|string|min:3',
        'last_name' => 'nullable|string|min:3',
        'profile_photo_path'=>'sometimes|image|mimes:png,jpg,jpeg,gif',
        'national_code' => ['sometimes', new NationalCode(), Rule::unique('users')->ignore($this->user()->national_code, 'national_code')],
    ];
    }
}
