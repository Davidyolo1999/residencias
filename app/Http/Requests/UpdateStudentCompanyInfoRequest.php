<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentCompanyInfoRequest extends FormRequest
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
            'business_name' => 'required|max:255',
            'address_name' => 'required|max:255',
            'person_in_charge' => 'required|max:255',
            'person_in_charge_position' => 'required|max:255',
            'email' => 'required|max:255|email',
            'office_phone_number' => 'required|max:10',
            'personal_phone_number' => 'required|max:10',
            'commercial_business' => 'required|max:255',
            'Department_requesting_project' => 'required|max:255',
            'zip_code' => 'required|max:10',
            'date' => [
                'nullable',
                'date'
            ],
            'number_of_agreement' => 'nullable|max:255',
            'sector' => [
                'required',
                Rule::in([Company::PUBLIC, Company::PRIVATED, Company::SOCIAL, Company::EDUCATIONAL])
            ]
        ];
    }
}
