<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ValidateMinAndMaxDurationProject implements Rule
{
    private $start;
    private $end;
    private $months;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start, $end)
    {
        $this->start = Carbon::parse($start);
        $this->end = Carbon::parse($end);

        $this->months = $this->start->diffInMonths($this->end);
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
        $months = $this->start->diffInMonths($this->end);

        switch ($months) {
            case 4:
                return true;
            case 5:
                return true;
            case 6:
                return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "La duración minima del proyecto debe de ser entre 4 y 6 meses. Y tienes {$this->months} meses.";
    }
}
