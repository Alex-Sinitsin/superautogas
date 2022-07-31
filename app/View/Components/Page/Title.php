<?php

namespace App\View\Components\Page;

use Illuminate\View\Component;

class Title extends Component
{
    public $title = '';
    public $icon = '';
    public $subtitle = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $title, $icon)
    {
        $this->title = $title;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page.title');
    }
}
