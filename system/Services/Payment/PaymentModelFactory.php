<?php

namespace System\Services\Payment;


use System\Services\Payment\Paytm;
use System\Services\Payment\Stripe;
use System\Services\Payment\Razorpay;
use System\Services\Payment\CashfreePaymentService;

class PaymentModelFactory{

    public static function create($type){
        switch($type){
            case 'paytm':
                return new Paytm();
            case 'razorpay':
                return new Razorpay();
            case 'stripe':
                return new Stripe();
            case 'cashfree':
                return new CashfreePaymentService();  
        }
    }
}