<?php
/**
 * @var array $data
 */

/**
 * [
'amount' => $this->currency->amount,
'currency_type' => $this->currency->currency_type,
'payment_type' => $this->currency->getPaymentTypes()[$this->currency->payment_type],
'conversion_rate' => $this->conversion_rate,
'payment_rate' => $this->payment_rate,
'purchase_price'=>$this->purchase_price,
'unit_value_currency' => $this->unit_value_currency,
'value_purchased_currency' => $this->value_purchased_currency,
'conversion_value' => $this->conversion_value
];
 */
?>

<div class="col-md-12">
    <table class="table table-sm" style="font-size: .8rem">
        <thead>
        <tr>
            <th>Valor inicial</th>
            <th>Moeda Destino</th>
            <th>Forma de pagamento</th>
            <th>Valor Un. Moeda destino</th>
            <th>Valor comprado na moeda destino</th>
            <th>Taxa de pagamento</th>
            <th>Taxa de conversão</th>
            <th>Valor usado para conversão</th>
        </tr>

        </thead>
        <tbody>
        <tr>
            <td id="amount-in">{{$data['amount']}}</td>
            <td id="selected-currency-type-to">{{$data['currency_type']}}</td>
            <td id="selected-payment-type">{{$data['payment_type']}}</td>
            <td id="value-currency-unit">{{$data['unit_value_currency']}}</td>
            <td id="value-buy-currency-to">{{$data['value_purchased_currency']}}</td>
            <td id="rate-payment">{{$data['payment_rate']}}</td>
            <td id="rate-conversion">{{$data['conversion_rate']}}</td>
            <td id="used-value-conversion">{{$data['conversion_value']}}</td>
        </tr>
        </tbody>
    </table>
</div>
