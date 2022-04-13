const axios = require('axios');

document.getElementById("calcular").addEventListener("click", exchange);

function exchange() {
    document.getElementById('result').innerHTML = 'Aguarde...';
    const amount = document.getElementById('amount').value;
    const payment_method = document.getElementById('payment-method').value;
    const currency_type = document.getElementById('currency-type').value;

    axios.post('/currency', {amount, payment_method, currency_type, token})
        .then(function (response) {
          document.getElementById('result').innerHTML = response.data;
        });
}








