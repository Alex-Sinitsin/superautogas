<?php

if (! function_exists('active_link')) {

    function active_link($name, $activeClass = 'active-link')
    {
        return \Illuminate\Support\Facades\Route::is($name) ? $activeClass : '';
    }
}
