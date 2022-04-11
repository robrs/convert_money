<?php


namespace App\Services;


class QuotationUtilsService
{

    /**
     * @param $amount
     * @return  float
     */
    public static function formatAmountFromForm($amount)
    {
        if (empty($amount)):
            return null;
        endif;

        $amount = str_replace('.', '', $amount);
        $amount = str_replace('.', '', $amount);
        $amount = str_replace(',', '.', $amount);

        return floatVal($amount);

    }

    /**
     * @param $amount
     * @param string $currency
     * @return string
     */
    public static function formatAmount($amount, $currency = 'BRL')
    {
        $simbol = [
            'USD' => 'US$',
            'EUR' => '€',
            'BRL' => 'R$',
            'ARS' => '$'
        ];

        return $simbol[$currency] . ' ' . number_format($amount, 2, ',', '.');
    }

    /**
     * @return array
     */
    public static function getPaymentMethods()
    {
        return [
            'bb' => 'Boleto Bancário',
            'cc' => 'Cartão de Crédito'
        ];
    }

    /**
     * @return array
     */
    public static function getCurrencyTypes()
    {
        return [
            'USD' => 'Dólar dos Estados Unidos (USD)',
            'EUR' => 'Euro (EUR)',
            'ARS' => 'Peso Argentino (ARS)'
        ];
    }

}
