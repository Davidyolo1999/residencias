<?php

namespace App\View\Components;

use App\Models\Period;
use Illuminate\View\Component;

class PeriodModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $existPeriod = Period::where('start', '<=', now())
            ->where('end', '>=', now())
            ->exists();

        return view('components.period-modal', [
            'existPeriod' => $existPeriod
        ]);
    }
}
