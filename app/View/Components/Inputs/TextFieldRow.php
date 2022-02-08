<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class TextFieldRow extends Component
{
    public $name;
    public $label;
    public $type;
    public $defaultValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $type = 'text', $defaultValue = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->defaultValue = $defaultValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.text-field-row');
    }
}
