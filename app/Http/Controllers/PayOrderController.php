<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Orders\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    // Tanpa dependency injection
    /* public function store()
    {
        $paymentGateway = new PaymentGateway('usd');
        dd($paymentGateway->charge(2500));
    } */

    // Dengan dependency injection
    public function store(OrderDetails $orderDetails, PaymentGateway $paymentGateway)
    {
        $order = $orderDetails->all();

        echo '<pre>';
        print_r($order);
        print_r($paymentGateway->charge(2500));
        print_r($paymentGateway->charge(5000));
        print_r($paymentGateway->charge(5250));
    }
}
