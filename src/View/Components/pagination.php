<?php

namespace MrShaneBarron\pagination\View\Components;

use Illuminate\View\Component;

class pagination extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('ld-pagination::components.pagination');
    }
}
