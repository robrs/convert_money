<?php

namespace App\Services;


use App\Models\ExchangeCurrency;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationService
{

    /**
     * @var Quotation $quotation
     */
    private $quotation;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $result = [];

    /**
     * QuotationService constructor.
     * @param $quotation
     */
    public function __construct($quotation)
    {
        $this->quotation = $quotation;
    }

    public function processData(Request $request)
    {

        $attributes = $request->all();
        // tratar o campo amount recebido do formulário
        $attributes['amount'] = QuotationUtilsService::formatAmountFromForm($attributes['amount']);
        $this->quotation->setAttributes($attributes);

        $validate = validator($attributes, $this->quotation->rules, [], $this->quotation->customAttributes);

        if (!$this->validadeAmountMinMax($this->quotation->amount)) {
            return false;
        }

        if ($validate->fails()) {
            $this->setErrors($validate->errors()->all());
            return false;
        }
        $response = AwesomeApiService::getLast($this->quotation->currency_type);

        $exchangeCurrency = new ExchangeCurrency($this->quotation, $response->BRL->ask);

        $this->setResult($exchangeCurrency);

        return true;
    }

    private function setErrors($errors)
    {
        $this->errors = array_merge($this->errors, $errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param ExchangeCurrency $exchangeCurrency
     */
    private function setResult($exchangeCurrency)
    {
        $this->result = [
            'amount' => $this->formatAmount($this->quotation->amount),
            'currency_type' => $this->quotation->currency_type,
            'payment_type' => QuotationUtilsService::getPaymentMethods()[$this->quotation->payment_method],
            'conversion_rate' => $this->formatAmount($exchangeCurrency->getConversionRate()),
            'payment_rate' => $this->formatAmount($exchangeCurrency->getPaymentRate()),
            'unit_value_currency' => $this->formatAmount($exchangeCurrency->getUnitValueCurrency()),
            'value_purchased_currency' => $this->formatAmount($exchangeCurrency->getValuePurchasedCurrency(), $this->quotation->currency_type),
            'conversion_value' => $this->formatAmount($exchangeCurrency->getConversionValue())
        ];
    }


    /**
     * @param $amount
     * @param string $currency
     * @return string
     */
    private function formatAmount($amount, $currency = 'BRL')
    {
        return QuotationUtilsService::formatAmount($amount, $currency);
    }

    private function validadeAmountMinMax($amount)
    {
        if (empty($amount)):
            return true;
        elseif ($amount >= 1000 && $amount <= 100000):
            return true;
        else:
            $this->setErrors(['O Valor inicial em BRL deve ser entre R$ 1000,00 e R$ 100.000,00']);
            return false;

        endif;

    }

}
