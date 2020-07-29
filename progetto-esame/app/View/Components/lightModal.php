<?php

namespace App\View\Components;

use Illuminate\View\Component;

class lightModal extends Component
{
   public $modalId;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($modalId = 'lightModal')
    {
        $this->modalId = $modalId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.light-modal');
    }
}
