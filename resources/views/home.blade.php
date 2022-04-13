<?php
/**
 * @var array $paymentMethods
 * @var array $currencyTypes
 */
?>

    <!DOCTYPE html>
<html lang="pt-BR">
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
    <h4 class="card-title">Conversor de Moedas</h4>
    <div class="card card-light">
        <div class="card-header">
            <form id="quotation-form">
                <div class="row">
                    <div class="col-md-4">
                        <label for="titulo">Valor em BRL:</label>
                        <input
                            id="amount"
                            class="form-control money"
                            type="text"
                            name="amount"
                            inputmode="numeric">
                    </div>
                    <div class="col-md-4">
                        <label for="categoria-id">Para:</label>
                        <select id="currency-type" name="currency_type" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($currencyTypes as $key=>$type)
                                <option
                                    value="{{$key}}">{{$type}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="payment-method">Forma de pagamento</label>
                        <select id="payment-method" name="payment_method"
                                class="form-control">
                            <option value="">Selecione</option>
                            @foreach($paymentMethods as $key=>$type)
                                <option
                                    value="{{$key}}">{{$type}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <button
                        id="calcular"
                        type="button" class="btn btn-primary btn-sm">
                        <i class="fas fa-folder"></i> Calcular
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row" id="result"></div>
        </div>

        <div class="card-footer">

        </div>
    </div>
    <hr>

</div>
<script type="module" src="{{url(mix('js/app.js'))}}"></script>
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"
        integrity="sha256-u7MY6EG5ass8JhTuxBek18r5YG6pllB9zLqE4vZyTn4=" crossorigin="anonymous"></script>
</body>

</html>
