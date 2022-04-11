<?php

namespace App\Services;

use App\Interfaces\IPaymentMethod;

class BankSlipPaymentMethodService implements IPaymentMethod
{
    /**
     * @param float $amount
     * @return float
     */
    public function calculate($amount)
    {
        return $amount * 0.0137;
    }
}
