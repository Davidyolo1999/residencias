<?php

namespace App\Rules;

use App\Models\Project;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProgressInsideProjectDates implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $project = Project::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('user_id', Auth::user()->id)
            ->exists();

        return $project;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No estas dentro de los tiempos del proyecto.';
    }
}
