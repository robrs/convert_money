<?php

namespace App\Interfaces;

interface IPaymentMethod
{
    /**
     * @param  float $amount
     * @return float
     */
    public function calculate($amount);
}
