<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Services\QuotationUtilsService;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'currency' => new Quotation(),
            'paymentMethods'=> QuotationUtilsService::getPaymentMethods(),
            'currencyTypes' => QuotationUtilsService::getCurrencyTypes()
        ]);
    }
}
