<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
        // dd(request()->all());
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|min:2',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'description' => 'required|string|max:500|min:5',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'status' => 'required|numeric|in:0,1',
            ];
        } else {
            return [
                'name' => 'required|string|min:2',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'description' => 'required|string|max:500|min:5',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'status' => 'required|numeric|in:0,1',
            ];
        }
    }
}
