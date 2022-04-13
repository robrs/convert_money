<?php

namespace App\Models;

class ExchangeCurrency
{

    /**
     * @var float $payment_fee
     *  Taxa de pagemento
     */
    private $payment_fee;

    /**
     * @var float $conversion_fee
     *  Taxa de conversão
     */
    private $conversion_fee;

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

    /**
     *
     */
    const  PAYMENT_METHODS = [
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
        $this->setPaymentFee();
        $this->setConversionFee();
        $this->setUnitValueCurrency();
        $this->setConversionValue();
        $this->setValuePurchasedCurrency();
    }

    private function setPaymentFee()
    {
        $paymentMethodClass = '\\App\\Services\\' . self::PAYMENT_METHODS[$this->quotation->payment_method] . 'PaymentMethodService';

        $this->payment_fee = (new $paymentMethodClass)->calculate($this->quotation->amount);
    }

    private function setConversionFee()
    {
        $fee = $this->quotation->amount <= 3700 ? 0.02 : 0.01;
        $this->conversion_fee = $this->quotation->amount * $fee;
    }

    private function setUnitValueCurrency()
    {
        $this->unit_value_currency = 1 / $this->purchase_price;
    }

    private function setConversionValue()
    {
        $this->conversion_value = $this->quotation->amount - $this->payment_fee - $this->conversion_fee;
    }

    private function setValuePurchasedCurrency()
    {
        $this->value_purchased_currency = $this->conversion_value * $this->purchase_price;
    }

    public function getPaymentFee()
    {
        return $this->payment_fee;
    }

    public function getConversionFee()
    {
        return $this->conversion_fee;
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
