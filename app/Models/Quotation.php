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
    public $attributes = [];

    public function setAttributes($attributes = [])
    {

        if (count($attributes) > 0):
            foreach ($attributes as $key => $value):
                $this->$key = $value;
                $this->attributes[$key] = $value;
            endforeach;
        endif;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public $rules = [
        'amount' => ['required', 'numeric'],
        'currency_type' => 'required',
        'payment_method' => 'required',
    ];

    public $customAttributes = [
        'amount' => 'Valor em BRL',
        'currency_type' => 'Tipo de Moeda',
        'payment_method' => 'Forma de pagamento',

    ];


}
