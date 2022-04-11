<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
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
    public $payment_method;

    /**
     * @var array
     */
    private $paymentMethods = [
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
        'payment_method' => 'required',
    ];

    public $customAttributes = [
        'amount' => 'Valor em R$',
        'currency_type' => 'Tipo de Moeda',
        'payment_method' => 'Forma de pagamento',

    ];

    public function getPaymentMethods()
    {
        return $this->paymentMethods;
    }

    public function getCurrencyTypes()
    {
        return $this->currencyTypes;
    }

}
