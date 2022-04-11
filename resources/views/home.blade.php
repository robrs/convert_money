<?php
/**
 * @var \App\Models\Quotation $currency
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
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="card card-light">
        <div class="card-header">
            <h4 class="card-title">Conversor</h4>
        </div>
        <div class="card-body">
            <form id="quotation-form">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="titulo">Valor em R$</label>
                        <input id="amount" class="form-control money" type="text" name="amount" inputmode="numeric">
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
                        <label for="payment-method">Forma de pagamento</label>
                        <select id="payment-method" name="payment_method"
                                class="form-control">
                            <option value="">Selecione</option>
                            @foreach($currency->getPaymentMethods() as $key=>$type)
                                <option
                                    value="{{$key}}">{{$type}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
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
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" integrity="sha256-u7MY6EG5ass8JhTuxBek18r5YG6pllB9zLqE4vZyTn4=" crossorigin="anonymous"></script>
</body>

</html>
