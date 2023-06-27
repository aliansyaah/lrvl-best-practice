<?php

namespace App\Orders;

use App\Billing\BankPaymentGateway;
use App\Billing\PaymentGatewayContract;

class OrderDetails
{
    private $paymentGateway;

    /* 
     * Whenever OrderDetails gets created, it requests a BankPaymentGateway.
     * Laravel going to look inside the CONTAINER (AppServiceProvider) to find a BankPaymentGateway.
    */
    public function __construct(PaymentGatewayContract $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function all()
    {
        $this->paymentGateway->setDiscount(500);

        return [
            'name' => 'Victor',
            'address' => 'Jl. Pasteur'
        ];
    }
}