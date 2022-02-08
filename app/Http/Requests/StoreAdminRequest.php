<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function userData()
    {
        return [
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => User::ADMIN_ROLE,
        ];
    }

    public function adminData()
    {
        return Arr::only($this->validated(), ['first_name', 'last_name']);
    }
}
