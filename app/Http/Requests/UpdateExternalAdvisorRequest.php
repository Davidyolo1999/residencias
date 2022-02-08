<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UpdateExternalAdvisorRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->externaladvisor->user_id)],
            'first_name' => 'required|max:255',
            'fathers_last_name' => 'required|max:255',
            'mothers_last_name' => 'required|max:255',
            'sex' => 'required|in:m,f',
            'charge' => 'required|max:255',
            'career' => 'required|max:255',
            'curp' => ['required', 'max:18', Rule::unique('external_advisors', 'curp')->ignore($this->externaladvisor->user_id, 'user_id')],
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

    public function userData()
    {
        return ['email' => $this->email];
    }

    public function externalAdvisorData()
    {
        return Arr::except($this->validated(), ['email']);
    }
}
