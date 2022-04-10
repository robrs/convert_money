<?php

namespace App\Http\Controllers;

use App\Models\Currency;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'currency' => new Currency()
        ]);
    }
}
