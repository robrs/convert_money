<?php
/**
 * @var array $data
 */
?>
<h4>Resultado</h4>
<div class="col-md-12">
    <table class="table table-sm table-bordered" style="font-size: .8rem">
        <thead>
        <tr class="table-secondary">
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
            <td>{{$data['amount']}}</td>
            <td>{{$data['currency_type']}}</td>
            <td>{{$data['payment_type']}}</td>
            <td>{{$data['unit_value_currency']}}</td>
            <td>{{$data['value_purchased_currency']}}</td>
            <td>{{$data['payment_rate']}}</td>
            <td>{{$data['conversion_rate']}}</td>
            <td>{{$data['conversion_value']}}</td>
        </tr>
        </tbody>
    </table>
</div>
