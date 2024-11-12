<?php

namespace System\Services\Payment;

use Razorpay\Api\Api;

class Razorpay{

    protected $apiKey;
    protected $apiSecret;
    protected $api;

    public function __construct() {
        $this->apiKey = '';
        $this->apiSecret = '';
        $this->api = new Api($this->apiKey, $this->apiSecret);
    }

    public function processPayment($orderData)
    {
        $amount = round($orderData->total*100);
        $transactionData = [
            'receipt'         => 'receipt#1',
            'amount'          => $amount,
            'currency'        => 'INR',
            'payment_capture' => 1
        ];

        $razorpayOrder = $this->api->order->create($transactionData);

        $data = [
            'key'               => $this->apiKey,
            'amount'            => $amount,
            'currency'          => 'INR',
            'order_id'          =>  $razorpayOrder->id,
            'name'              => 'Acme Corp',
            'description'       => 'Test Transaction',
            'image'             => 'https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png',
            'prefill'           => [
                'name'              => 'John Doe',
                'email'             => 'john.doe@example.com',
                'contact'           => '9999999999',
            ],
            'notes'             => [
                'address'           => 'Corporate Office',
                'merchant_order_id' => '12312321',
            ],
            'theme'             => [
                'color'             => '#3399cc'
            ]
        ];
        return view('/userpanel/razorpay_checkout', ['data' => $data, 'orderData' => $orderData]);
    }

    public function verifyPayment($payment_id){
        try {
            $payment = $this->api->payment->fetch($payment_id);
            if ($payment->status === 'captured') {
                return ['status' => 'success'];
            } else {
                return ['status' => 'failed'];
            }
        }
        catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function storePaymentId($paymentData){
        if (isset($paymentData['razorpay_payment_id'])) {
            session()->set('paymentId',$paymentData['razorpay_payment_id']);
            session()->set('payment_data',json_encode($paymentData));
            $verification = $this->verifyPayment($paymentData['razorpay_payment_id']);
            if ($verification['status'] === 'success') {
                return ['status' => 'success'];
            } else {
                return ['status' => 'failed'];
            }
            return ['status' => 'error'];
        }
    }
}