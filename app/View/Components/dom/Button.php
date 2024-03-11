<?php

namespace App\View\Components\dom;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct(
        public String $type = 'button',
        public String|Null $class = null,
        public String|Null $route = null,
        public String|Null $name = null,
        public array|Null $tooltip = null,
        public String|Null $id = null,
        public String|Null $position = null,
        public String|Null $form = null,
    ) {
        // Code ...
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dom.button');
    }
}
