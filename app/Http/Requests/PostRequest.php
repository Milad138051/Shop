<?php

namespace App\Http\Requests;

use App\Http\Services\Image\ImageService;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'title'=>'required|max:120|min:5',             
                'summary'=>'required|max:300|min:5',
                'body'=>'required|max:600|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u',
                'status'=>'required|numeric|in:0,1',
                'image'=>'required|image|mimes:png,jpg,jpeg,gif',
                'commentable'=>'required|numeric|in:0,1',
                'category_id'=>'required|min:1|max:100000000|exists:post_categories,id'
            ];
        } else {
            return [
                'title'=>'required|max:120|min:2',             
                'summary' =>'required|max:300|min:5',
                'body'=>'required|max:600|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u',
                'status'=>'required|numeric|in:0,1',
                'image'=>'image|mimes:png,jpg,jpeg,gif',
                'commentable'=>'required|numeric|in:0,1',
                'category_id'=>'required|min:1|max:100000000|exists:post_categories,id'
            ];

        }
    }
}
