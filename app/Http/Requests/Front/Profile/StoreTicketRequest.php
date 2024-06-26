<?php

namespace App\Http\Requests\Front\Profile;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'subject' => 'required|min:2|max:100|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,?؟ ]+$/u',
            'description' => 'required|min:2|max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,?؟ ]+$/u',
            // 'priority_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:ticket_priorities,id',
            // 'category_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:ticket_categories,id',
		    'file' => 'mimes:png,jpg,jpeg,gif',

        ];
    }
}
