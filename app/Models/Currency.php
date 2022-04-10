<?php

namespace App\Models;


class Currency
{

    /**
     * @var float $ammount
     */
    public $amount;

    /**
     * @var string $currency_type
     * ex: USD, EUR
     */
    public $currency_type;

    /**
     * @var string
     */
    public $payment_type;

    /**
     * @var array
     */
    private $paymentTypes = [
        'bb' => 'Boleto Bancário',
        'cc' => 'Cartão de Crédito'
    ];

    private $currencyTypes = [
        'USD' => 'Dólar Americano',
        'EUR' => 'Euro',
        'ARS' => 'Peso Argentino'
    ];

    public function setAttributes($attributes = [])
    {
        if (count($attributes) > 0):
            foreach ($attributes as $key => $value):
                $this->$key = $value;
            endforeach;
        endif;
    }

    public $rules = [
        'amount' => ['required',''],
        'currency_type' => 'required',
        'payment_type' => 'required',
    ];

    public $customAttributes = [
        'amount' => 'Valor em R$',
        'currency_type' => 'Tipo de Moeda',
        'payment_type' => 'Forma de pagamento',

    ];

    public function getPaymentTypes()
    {
        return $this->paymentTypes;
    }

    public function getCurrencyTypes()
    {
        return $this->currencyTypes;
    }
}
