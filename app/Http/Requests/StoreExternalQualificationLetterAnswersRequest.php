<?php

namespace App\Http\Requests;

use App\Models\ExternalQualificationLetter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExternalQualificationLetterAnswersRequest extends FormRequest
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
            'first_answer' => [
                'required',
                Rule::in(ExternalQualificationLetter::RESPONSE_TYPE)
            ],
            'second_answer' => [
                'required',
                Rule::in(ExternalQualificationLetter::RESPONSE_TYPE)
            ],
            'third_answer' => [
                'required',
                Rule::in(ExternalQualificationLetter::RESPONSE_TYPE)
            ],
            'fourth_answer' => [
                'required',
                Rule::in(ExternalQualificationLetter::RESPONSE_TYPE)
            ],
            'fifth_answer' => [
                'required',
                Rule::in(ExternalQualificationLetter::RESPONSE_TYPE)
            ],
            'observations' => 'required|max:255',
        ];
    }
}
