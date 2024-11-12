<?php
namespace System\Services\Payment;

use GuzzleHttp\Client;
use OpenAPI\Client\Api\OrdersApi;
use OpenAPI\Client\Model\CFOrderRequest;
use OpenAPI\Client\Model\CFOrderPayRequest;

class CashfreePaymentService{
    protected $appId;
    protected $secretKey;
    protected $apiInstance;

    public function __construct(){
        $this->appId = '';
        $this->secretKey = '';
        $this->apiInstance = new OrdersApi(client: new Client(['base_uri' => 'https://sandbox.cashfree.com/pg']));
    }

    public function processPayment($orderData){
        $amount = round($orderData->total, 2);
        session()->set('orderData', $orderData);
        $orderId = 'TEJAS-'.uniqid();//custm orderid

        $transactionData = new CFOrderRequest([
            'order_id' => $orderId,
            'order_amount' => $amount,
            'order_currency' => 'INR',
            'customer_details' => [
                'customer_id' => 'CUST123',
                'customer_name' => 'John Doe',
                'customer_email' => 'john.doe@example.com',
                'customer_phone' => '9999999999'
            ],
            'order_meta' => [
                'return_url' => base_url('/fetch_payment_status?order_id='. $orderId) 
            ],
            'order_expiry_time' => null,
            'order_note' => 'Payment for Order #' . uniqid(),
            'order_tags' => null,
            'order_splits' => null
        ]);

        try {
            $result = $this->apiInstance->createOrder($this->appId, $this->secretKey, '2022-01-01', false, uniqid(), uniqid(), $transactionData);
            
            return view('/userpanel/cashfree_checkout', ['data' => $result, 'orderData' => $orderData]);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function verifyPayment($orderId){
        try {
            $result = $this->apiInstance->getOrder($this->appId, $this->secretKey, $orderId, '2022-01-01', false, uniqid(), uniqid());
            if ($result['order_status'] === 'PAID') {
                return ['status' => 'success'];
            }
            return ['status' => 'failed'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function fetch_payment_status($orderId){

        $url = "https://sandbox.cashfree.com/pg/orders/$orderId/payments";

        $headers = [
            "x-api-version: 2023-08-01",
            "x-client-id: {$this->appId}",
            "x-client-secret: {$this->secretKey}"
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $transactions = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($transactions)) {
            throw new Exception("Failed to decode JSON response: " . json_last_error_msg());
        }
    
        $transactionDetails = json_encode($transactions, JSON_PRETTY_PRINT);
        $paymentStatuses = []; 
        foreach ($transactions as $transaction) {
            $paymentStatuses[] = $transaction['payment_status'];
        }
        return [
            'transaction_details' => $transactionDetails,
            'payment_statuses' => $paymentStatuses
        ];
    }
}