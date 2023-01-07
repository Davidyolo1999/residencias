<?php

namespace App\Http\Requests;

use App\Rules\ProgressInsideProjectDates;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreProjectProgressRequest extends FormRequest
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
            'description' => 'required',
            'project_id' => [
                'required',
                Rule::exists('projects', 'id')->where('user_id', Auth::user()->id),
                new ProgressInsideProjectDates()
            ]
        ];
    }
}
