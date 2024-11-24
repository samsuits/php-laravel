<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    public function index()
    {
        return 'Hello, World!';
    }

    public function greet($name)
    {
        return 'Hello, ' . $name . '!';
    }

    public function sum($num1, $num2)
    {
        return $num1 + $num2;
    }
}
