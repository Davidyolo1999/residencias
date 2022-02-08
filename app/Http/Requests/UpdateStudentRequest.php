<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->student->user_id)],
            'first_name' => 'required|max:255',
            'fathers_last_name' => 'required|max:255',
            'mothers_last_name' => 'required|max:255',
            'account_number' => 'required|max:255',
            'sex' => 'required|in:m,f',
            'curp' => ['required', 'max:18', Rule::unique('students', 'curp')->ignore($this->student->user_id, 'user_id')],
            'career_percentage' => 'required|numeric|min:0|max:100',
            'phone_number' => 'required|numeric|digits:10',
            'career_id' => 'required|exists:careers,id',
            'teacher_id' => 'required|exists:teachers,user_id',
            'external_advisor_id' => 'required|exists:external_advisors,user_id',
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
    public function userData()
    {
        return ['email' => $this->email];
    }

    public function studentData()
    {
        return Arr::except($this->validated(), ['email']);
    }
}
