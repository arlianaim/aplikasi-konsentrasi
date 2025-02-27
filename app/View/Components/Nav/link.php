<?php

namespace App\View\Components\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class link extends Component
{

    public $label;
    public $href;
    public $active;
    public $dis;

    public function __construct($label, $href, $active = false, $dis = "0")
    {
        $this->label = $label;
        $this->href = $href;
        $this->active = $active ? "active" : "";
        $this->dis = $dis == "0";
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav.link');
    }
}
