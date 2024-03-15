<?php

namespace App\View\Components\messages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toasts extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public String $type = 'success',
        public Bool $close = true,
        public Bool $icon = true,
        public Int $delay = 5000,
        public String $autohide = 'true',
        public String $position = 'top-0 end-0'
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.messages.toasts');
    }
}
