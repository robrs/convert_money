const axios = require('axios');

document.getElementById("calcular").addEventListener("click", exchange);

function exchange() {
    document.getElementById('result').innerHTML = 'Aguarde...';
    const amount = document.getElementById('amount').value;
    const payment_type = document.getElementById('payment-type').value;
    const currency_type = document.getElementById('currency-type').value;

    axios.post('/currency', {amount, payment_type, currency_type})
        .then(function (response) {
          document.getElementById('result').innerHTML = response.data;
        })
        .catch(function (error) {
            // manipula erros da requisição
            // console.error(error);
        })
}

function formatValue(amount, currency_type = 'BRL') {
    return new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: currency_type
    }).format(amount);
}




