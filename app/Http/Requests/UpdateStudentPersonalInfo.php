<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentPersonalInfo extends FormRequest
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
            'phone_number' => 'required|numeric|digits:10',
            'state_id' => [
                'required',
                Rule::exists('locations', 'id')->whereNull('parent_id'),
            ],
            'municipality_id' => [
                'required',
                Rule::exists('locations', 'id')->where('parent_id', $this->state_id),
            ],
            'locality_id' => [
                'required',
                Rule::exists('locations', 'id')->where('parent_id', $this->municipality_id),
            ],
        ];
    }
}
