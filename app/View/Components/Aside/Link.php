<?php

namespace App\View\Components\Aside;

use Illuminate\View\Component;

class Link extends Component
{
    public $title = '';
    public $icon = '';
    public $link = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $icon, $link)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.aside.link');
    }
}
