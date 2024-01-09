<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        // dd('dd');
        if($this->isMethod('post')){

            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'mobile' => ['required','digits:11', 'unique:users'],
                'email' => ['required','string','email','unique:users'],
                'password' => ['required','unique:users', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',
            ];
        }
        else{
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',
                'user_type'=>'required|numeric|in:0,1',

            ];
        }
    }
}
