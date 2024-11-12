<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use System\Services\Payment\PaymentModelFactory;
use App\Models\OrderModel;
use App\Models\CartModel;
use App\Models\PaymentModel;

class paymentController extends BaseController{

    protected $paymentMethod;
    protected $amount;
    protected $orderModel;
    protected $paymentModel;
    protected $cartModel;
    

    public function __construct(){

        parent::__construct();
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
        $this->paymentModel = new PaymentModel();
    }

    public function view(){
        $orderDataJson = $this->request->getPost('orderData');
        $orderData = json_decode($orderDataJson, true);
        return view('userpanel/payment', ['orderData' => $orderData]);
        
    }

    public function processPayment(){
        $orderData = json_decode($this->request->getPost('orderData'));
        $paymentMethod = $this->request->getPost('payment_method');
        session()->set('payment_method', $paymentMethod);
        $amount = $this->request->getPost('amount');
        $payment = PaymentModelFactory::create($paymentMethod);
        $response = $payment->processPayment($orderData);
        return $response;
    }
    
    public function vieworderInfo(){
        return view("/orderstatus");
    }

    public function success() {

        $orderData = session()->get('orderData');
        $userId = session()->get('id');
        $paymentID = session()->get('paymentId');
        $address_id =  $orderData->addressId;
        $total_amount =  $orderData->total;
        $payment_data = session()->get('payment_data');
        $info = "success";

        $this->cartModel->deletefromCartbyuserId($userId);
        $this->orderModel->saveOrder($userId, $address_id, $total_amount, $info, $paymentID);

        $run_query = $this->paymentModel->insertdetails($paymentID, $payment_data, $userId);
        session()->remove('payment_method');
        session()->remove('orderData');
        session()->remove('paymentId');
        session()->remove('payment_data');
        return redirect()->to('/orderinfo')->with('status', $info)->with('orderData', $orderData);
    }

    public function failed() {

        $orderData = session()->get('orderData');
        $userId = session()->get('id');
        $paymentID = session()->get('paymentId');
        $address_id =  $orderData->addressId;
        $total_amount =  $orderData->total;
        $info = "Failed";
        $payment_data = session()->get('payment_data');
        if(!$payment_data){
            $payment_data = json_encode(['gateway' => 'razorpay','status'=> 'Unexpected payment failed']);
        }

        $this->orderModel->saveOrder($userId, $address_id, $total_amount, $info, $paymentID);
        $run_query = $this->paymentModel->insertdetails($paymentID, $payment_data, $userId);
        session()->remove('payment_method');
        session()->remove('orderData');
        session()->remove('paymentId');
        session()->remove('payment_data');
        return redirect()->to('/orderinfo')->with('status', $info)->with('orderData', $orderData);
    }

    public function viewOrderPage(){
        $userId = session()->get('id');
        $info = $this->orderModel->getorderIdTotalamtandstatusbyUserId($userId);
        return view("/userpanel/ordersinfo",['info' => $info]);
    }

    public function storePaymentId(){
        $paymentData = $this->request->getJSON(true);
        $paymentMethod = $paymentData['payment_method'];
        $paymentService = PaymentModelFactory::create($paymentMethod);
        $result = $paymentService->storePaymentId($paymentData);
        return $this->response->setJSON($result);
    }

    public function fetch(){

        $orderId = $this->request->getGet('order_id');
        $paymentMethod = session()->get('payment_method');
        $paymentService = PaymentModelFactory::create($paymentMethod);
        $result = $paymentService->fetch_payment_status($orderId);

        if(!isset($result['payment_statuses'][0])){
            session()->set('payment_data',json_encode(['gateway' => 'cashfree_sandbox','status'=> 'Unexpected payment failed']));
        }
        else{
            session()->set('payment_data', $result['transaction_details']);
        }
        if(isset($result['payment_statuses'][0]) && $result['payment_statuses'][0] == "SUCCESS"){
           return redirect()->to('/payment-success');
        }
        else{
           return redirect()->to('/payment-failed');
        }
    }
}