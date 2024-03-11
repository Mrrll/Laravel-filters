<?php

namespace App\View\Components\nav;

use App\Traits\LinksNav;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Links extends Component
{
    use LinksNav;

    public $links;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public String|Null $name = null,
        public String|Null $class = null
    ) {
        $this->links = $this->Links();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav.links');
    }
}
