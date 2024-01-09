<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $route = Route::current();
        if($route->getName() === 'admin.user.role.store')
        {
            return [
                'name' => 'required|max:120|min:1',
                'description' => 'required|max:200|min:1',
                'permissions.*' => 'exists:permissions,id'
            ];
        }
        elseif($route->getName() === 'admin.user.role.update')
        {
            return [
                'name' => 'required|max:120|min:1',
                'description' => 'required|max:200|min:1',
            ];
        }
          elseif($route->getName() === 'admin.user.role.permission-update')
        {
            return [
                'permissions.*' => 'exists:permissions,id'
            ];
        }
    }
}
