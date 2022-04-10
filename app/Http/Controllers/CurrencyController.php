<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\ExchangeCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function exchangeCurrency(Request $request)
    {
        $currency = new Currency();

        $currency->setAttributes($request->all());

        $validate = validator($request->all(), $currency->rules, [], $currency->customAttributes);

        if ($validate->fails()) {
            echo view('errors',['errors' => $validate->errors()->all()]);
            exit;
        }

        $response = Http::withoutVerifying()->get('https://economia.awesomeapi.com.br/json/last/BRL-' . $currency->currency_type);

        $data = json_decode($response->body());


        $exchangeCurrency = new ExchangeCurrency($currency, $data->BRL->ask);


        echo view('result_table',['data'=>$exchangeCurrency->getResult()]);
    }
}
