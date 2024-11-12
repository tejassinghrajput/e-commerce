<?php
namespace App\Libraries;

use Cashfree\Pg\PaymentGateway;
use Cashfree\Pg\Exceptions\CashfreeException;

class CashfreeLibrary
{
    private $pg;

    public function __construct()
    {
        // Set up credentials directly here
        $appId = 'your_client_id';        // Replace with your actual client ID
        $secretKey = 'your_secret_key';    // Replace with your actual secret key
        $environment = 'TEST';             // Use 'LIVE' for production

        // Initialize PaymentGateway instance
        $this->pg = new PaymentGateway($appId, $secretKey, $environment);
    }

    public function createOrder(array $orderDetails)
    {
        try {
            // Use the SDK to create an order
            return $this->pg->order->create($orderDetails);
        } catch (CashfreeException $e) {
            // Log the error
            log_message('error', 'Cashfree Error: ' . $e->getMessage());
            return ['error' => 'Payment creation failed: ' . $e->getMessage()];
        }
    }
}
