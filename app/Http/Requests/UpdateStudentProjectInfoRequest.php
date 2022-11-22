<?php

namespace App\Http\Requests;

use App\Rules\ValidateMinAndMaxDurationProject;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentProjectInfoRequest extends FormRequest
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
            'title' => 'required|max:255',
            'start_date' => [
                'required',
                'date_format:Y-m-d',
                new ValidateMinAndMaxDurationProject($this->start_date, $this->end_date)
            ],
            'end_date' => [
                'required',
                'date_format:Y-m-d',
                'after:start_date',
                new ValidateMinAndMaxDurationProject($this->start_date, $this->end_date)
            ],
            'schedule' => 'required|max:255',
            'general_objective' => 'required|max:255',
            'specific_objectives' => 'required|array|min:1',
            'specific_objectives.*' => 'required|max:255',
            'justification' => 'required',
            'activity_schedule_image' => 'image',
        ];
    }
}
