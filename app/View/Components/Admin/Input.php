<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{

    public $type;
    public $name;
    public $text;
    public $model;
    public $isRequired;
    public $disabled;
    public $className;

    /**
     * Create a new component instance.
     */
    public function __construct($type = 'text', $name = "", $text = "", $model = "", $isRequired = false, $disabled = false, $className = "")
    {
        $this->type = $type;
        $this->name = $name;
        $this->text = $text;
        $this->model = $model;
        $this->isRequired = $isRequired;
        $this->disabled = $disabled;
        $this->className = $className;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.admin.input');
    }
}
