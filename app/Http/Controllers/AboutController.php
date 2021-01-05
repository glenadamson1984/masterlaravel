<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    // can use the invoke method if only one action is present in the controller
    public function __invoke(): string
    {
        return 'single';
    }
}
