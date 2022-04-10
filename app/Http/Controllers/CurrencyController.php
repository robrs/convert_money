<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\ExchangeCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function exchangeCurrency(Request $request)
    {
        $quotation = new Quotation();

        $quotation->setAttributes($request->all());

        $validate = validator($request->all(), $quotation->rules, [], $quotation->customAttributes);

        if ($validate->fails()) {
            echo view('errors',['errors' => $validate->errors()->all()]);
            exit;
        }

        $response = Http::withoutVerifying()->get('https://economia.awesomeapi.com.br/json/last/BRL-' . $quotation->currency_type);

        $data = json_decode($response->body());


        $exchangeCurrency = new ExchangeCurrency($quotation, $data->BRL->ask);


        echo view('result_table',['data'=>$exchangeCurrency->getResult()]);
    }
}
