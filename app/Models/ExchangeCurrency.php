<?php

namespace App\Models;


class ExchangeCurrency
{

    /**
     * @var float $payment_rate
     *  Taxa de pagemento
     */
    private $payment_rate;

    /**
     * @var float $conversion_rate
     *  Taxa de conversão
     */
    private $conversion_rate;

    /**
     * @var float $unit_value_currency
     * Valor unitário da moeda destino
     */
    private $unit_value_currency;

    /**
     * @var float $value_purchased_currency
     *  Valor comprado da moeda destino
     */
    private $value_purchased_currency;

    /**
     * @var float $conversion_value
     *  Valor utilizado para conversão
     */
    private $conversion_value;

    /**
     * @var Currency $currency
     * Recebe a instância da classe Currency
     *
     */
    private $currency;

    /**
     * @var float $purchase_price
     *  Valor de compra da moeda destino
     */
    private $purchase_price;

    private $ratesPaymentType = [
        'bb' => 0.0137,
        'cc' => 0.0773
    ];

    /**
     * ExchangeCurrency constructor.
     * @param Currency $currency
     * @param float $bid
     */
    public function __construct($currency, $bid)
    {
        $this->currency = $currency;
        $this->purchase_price = $bid; // valor de compra
        $this->setPaymentRate();
        $this->setConversionRate();
        $this->setUnitValueCurrency();
        $this->setConversionValue();
        $this->setValuePurchasedCurrency();
    }

    private function setPaymentRate()
    {
        $this->payment_rate = $this->currency->amount * $this->ratesPaymentType[$this->currency->payment_type];
    }

    private function setConversionRate()
    {
        $rate = $this->currency->amount <= 3700 ? 0.02 : 0.01;
        $this->conversion_rate = $this->currency->amount * $rate;
    }

    private function setUnitValueCurrency()
    {
        $this->unit_value_currency = 1 / $this->purchase_price;
    }

    private function setConversionValue()
    {
        $this->conversion_value = $this->currency->amount - $this->payment_rate - $this->conversion_rate;
    }

    private function setValuePurchasedCurrency()
    {
        $this->value_purchased_currency = $this->conversion_value * $this->purchase_price;
    }


    public function getResult()
    {

        return [
            'amount' => $this->formatAmount($this->currency->amount),
            'currency_type' => $this->currency->currency_type,
            'payment_type' => $this->currency->getPaymentTypes()[$this->currency->payment_type],
            'conversion_rate' => $this->formatAmount($this->conversion_rate),
            'payment_rate' => $this->formatAmount($this->payment_rate),
            'unit_value_currency' => $this->formatAmount($this->unit_value_currency),
            'value_purchased_currency' => $this->formatAmount($this->value_purchased_currency, $this->currency->currency_type),
            'conversion_value' => $this->formatAmount($this->conversion_value)
        ];
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

        return $simbol[$currency] .' '. number_format($amount, 2, ',', '.');
    }

}
