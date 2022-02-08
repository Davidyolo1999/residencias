<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->admin->user_id)],
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ];
    }

    public function userData()
    {
        return ['email' => $this->email];
    }

    public function adminData()
    {
        return Arr::only($this->validated(), ['first_name', 'last_name']);
    }
}
