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

    private $errors;

    private $result;

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
        $this->quotation->setAttributes($request->all());
        $validate = validator($request->all(), $this->quotation->rules, [], $this->quotation->customAttributes);

        if ($validate->fails()) {
            $this->setErrors($validate->errors()->all());
            return false;
        }

        $this->setAmount();

        $response = AwesomeApiService::getLast($this->quotation->currency_type);

        $exchangeCurrency = new ExchangeCurrency($this->quotation, $response->BRL->ask);

        $this->setResult($exchangeCurrency);

        return true;
    }

    private function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @param ExchangeCurrency $exchangeCurrency
     */
    private function setResult($exchangeCurrency)
    {
        $this->result = [
            'amount' => $this->formatAmount($this->quotation->amount),
            'currency_type' => $this->quotation->currency_type,
            'payment_type' => $this->quotation->getPaymentMethods()[$this->quotation->payment_method],
            'conversion_rate' => $this->formatAmount($exchangeCurrency->getConversionRate()),
            'payment_rate' => $this->formatAmount($exchangeCurrency->getPaymentRate()),
            'unit_value_currency' => $this->formatAmount($exchangeCurrency->getUnitValueCurrency()),
            'value_purchased_currency' => $this->formatAmount($exchangeCurrency->getValuePurchasedCurrency(), $this->quotation->currency_type),
            'conversion_value' => $this->formatAmount($exchangeCurrency->getConversionValue())
        ];
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
     * @param $amount
     * @param string $currency
     * @return string
     */
    private function formatAmount($amount, $currency = 'BRL')
    {
        $simbol = [
            'USD' => 'US$',
            'EUR' => '€',
            'BRL' => 'R$',
            'ARS' => '$'
        ];

        return $simbol[$currency] . ' ' . number_format($amount, 2, ',', '.');
    }

    private function setAmount()
    {
        $amount = $this->quotation->amount;
        $amount = str_replace('.','',$amount);
        $amount = str_replace('.','',$amount);
        $amount  = str_replace(',','.',$amount);

        $this->quotation->amount = $amount;

    }
}
