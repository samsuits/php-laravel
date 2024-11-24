<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyViewController extends Controller
{
    public function myview2()
    {
        return view('myview2');
    }
}
