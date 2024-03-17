<?php

namespace App\View\Components\dom;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public String $name,
        public String $type = 'text',
        public String|Null $id = null,
        public String|Bool $label = false,
        public String $class = '',
        public String $placeholder = '',
        public Bool $readonly = false,
        public Bool $disabled = false,
        public String $value = '',
        public String|Null $form = null,
        public Int $col = 10,
        public Int $rows = 5,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dom.input');
    }
}
