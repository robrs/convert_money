<?php
/**
 * @var \App\Models\Currency $currency
 */
?>

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conversor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container" style="padding:20px">
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="card card-light">
        <div class="card-header">
            <h4 class="card-title">Conversor</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="titulo">Valor em R$</label>
                    <input id="amount" class="form-control" type="text" name="amount">
                    <div style=" display:none; color: red"></div>
                </div>

                <div class="col-md-4">
                    <label for="categoria-id">Moeda</label>
                    <select id="currency-type" name="currency_type" class="form-control">
                        <option value="">Selecione</option>
                        @foreach($currency->getCurrencyTypes() as $key=>$type)
                            <option
                                value="{{$key}}">{{$type}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="payment-type">Forma de pagamento</label>
                    <select id="payment-type" name="payment_type"
                            class="form-control">
                        <option value="">Selecione</option>
                        @foreach($currency->getPaymentTypes() as $key=>$type)
                            <option
                                value="{{$key}}">{{$type}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer" style="margin-top: 10px">
            <button
                id="calcular"
                type="button" class="btn btn-primary">
                <i class="fas fa-folder"></i> Calcular
            </button>
        </div>
    </div>
    <hr>
    <div class="row" id="result">

    </div>
</div>
<script type="module" src="{{url(mix('js/app.js'))}}"></script>
</body>

</html>
