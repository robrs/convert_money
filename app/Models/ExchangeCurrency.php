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
     * @var Quotation $quotation
     */
    private $quotation;

    /**
     * @var float $purchase_price
     *  Valor de compra da moeda destino
     */
    private $purchase_price;

    private $paymentMethods = [
        'bb' => 'BankSlip',
        'cc' => 'CreditCard'
    ];

    /**
     * ExchangeCurrency constructor.
     * @param Quotation $quotation
     * @param float $bid
     */
    public function __construct($quotation, $bid)
    {
        $this->quotation = $quotation;
        $this->purchase_price = $bid;
        $this->setPaymentRate();
        $this->setConversionRate();
        $this->setUnitValueCurrency();
        $this->setConversionValue();
        $this->setValuePurchasedCurrency();
    }

    private function setPaymentRate()
    {
        $paymentMethodClass = '\\App\\Services\\' . $this->paymentMethods[$this->quotation->payment_method] . 'PaymentMethodService';

        $this->payment_rate = (new $paymentMethodClass)->calculate($this->quotation->amount);
    }

    private function setConversionRate()
    {
        $rate = $this->quotation->amount <= 3700 ? 0.02 : 0.01;
        $this->conversion_rate = $this->quotation->amount * $rate;
    }

    private function setUnitValueCurrency()
    {
        $this->unit_value_currency = 1 / $this->purchase_price;
    }

    private function setConversionValue()
    {
        $this->conversion_value = $this->quotation->amount - $this->payment_rate - $this->conversion_rate;
    }

    private function setValuePurchasedCurrency()
    {
        $this->value_purchased_currency = $this->conversion_value * $this->purchase_price;
    }

    public function getPaymentRate()
    {
        return $this->payment_rate;
    }

    public function getConversionRate()
    {
        return $this->conversion_rate;
    }

    public function getUnitValueCurrency()
    {
        return $this->unit_value_currency;
    }

    public function getConversionValue()
    {
        return $this->conversion_value;
    }

    public function getValuePurchasedCurrency()
    {
        return $this->value_purchased_currency;
    }
}
