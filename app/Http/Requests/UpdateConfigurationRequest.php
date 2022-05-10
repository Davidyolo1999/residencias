<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigurationRequest extends FormRequest
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
        'unit'=>'required|max:255',
        'address'=>'required|max:255',
        'person_in_charge'=>'required|max:255',
        'person_in_charge_position'=>'required|max:255',
        'person_in_charge_position_abbreviation'=>'required|max:255',
        'email'=>'required|max:255',
        'office_phone_number'=>'required|max:255',
        'personal_phone_number'=>'required|max:255',
        'institution_code'=>'required|max:255',
        ];
    }
}
