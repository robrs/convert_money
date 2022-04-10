<?php

namespace App\Http\Controllers;

use App\Models\Quotation;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'currency' => new Quotation()
        ]);
    }
}
