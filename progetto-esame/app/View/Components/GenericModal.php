<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GenericModal extends Component
{
   public $modalTitle;
   public $modalId;
   public $modalSubmitButton;
   public $modalButton;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalTitle ='Generic Modal' , $modalId = 'GenericModalid' , $modalSubmitButton = 'genericModalSubmit', $modalButton = 'Operation')
    {
        $this->modalTitle = $modalTitle;
        $this->modalId = $modalId;
        $this->modalSubmitButton = $modalSubmitButton;
        $this->modalButton = $modalButton;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.generic-modal');
    }
}
