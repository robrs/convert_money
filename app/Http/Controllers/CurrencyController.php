<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Services\QuotationService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function exchangeCurrency(Request $request)
    {
        $quotation = new Quotation();

        $quotationService = new QuotationService($quotation);

        if($quotationService->processData($request)):
            echo view('result_table',['data'=>$quotationService->getResult()]);
        else:
            echo view('errors',['errors' => $quotationService->getErrors()]);
            exit;
        endif;

    }
}
