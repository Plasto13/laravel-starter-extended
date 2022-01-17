<?php

namespace Modules\Core\View\Component;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('core::components.card');
    }
}