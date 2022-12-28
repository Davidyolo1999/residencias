<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePeriodRequest extends FormRequest
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
            'name' => ['required', Rule::unique('periods', 'name')->ignore($this->period->id, 'id')],
            'start' => ['required', 'date', 'before_or_equal:end', Rule::unique('periods', 'start')->ignore($this->period->id, 'id')],
            'end' => ['required', 'date', 'after_or_equal:start', Rule::unique('periods', 'end')->ignore($this->period->id, 'id')],
        ];
    }
}
