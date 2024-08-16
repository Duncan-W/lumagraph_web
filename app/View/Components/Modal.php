<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $modalId;
    public $title;
    public $buttonText;
    public $buttonType;
    public $modalContent;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalId, $title, $buttonText, $buttonType, $modalContent)
    {
        $this->modalId = $modalId;
        $this->title = $title;
        $this->buttonText = $buttonText;
        $this->buttonType = $buttonType;
        $this->modalContent = $modalContent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
