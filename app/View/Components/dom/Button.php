<?php

namespace App\View\Components\dom;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public
        $type,
        $class,
        $route,
        $name,
        $tooltip,
        $id,
        $position,
        $form,
        $checked,
        $value;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $type = 'button',
        $class = null,
        $route = null,
        $name = null,
        $tooltip = null,
        $id = null,
        $position = null,
        $form = null,
        $checked = null,
        $value = null
    ) {
        $this->type = $type;
        $this->class = $class;
        $this->route = $route;
        $this->name = $name;
        $this->tooltip = $tooltip;
        $this->id = $id;
        $this->position = $position;
        $this->form = $form;
        $this->checked = $checked;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dom.button');
    }
}
