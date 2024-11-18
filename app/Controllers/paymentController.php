<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use System\Services\Payment\PaymentModelFactory;
use App\Models\OrderModel;
use App\Models\CartModel;
use App\Models\PaymentModel;
use App\Models\MongoModel;

class paymentController extends BaseController{

    protected $paymentMethod;
    protected $amount;
    protected $orderModel;
    protected $paymentModel;
    protected $cartModel;
    protected $mongoModel;

    public function __construct(){

        parent::__construct();
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
        $this->paymentModel = new PaymentModel();
        $this->mongoModel = new MongoModel();
    }

    public function view(){
        $orderDataJson = $this->request->getPost('orderData');
        $orderData = json_decode($orderDataJson, true);
        return view('userpanel/payment', ['orderData' => $orderData]);
        
    }

    public function processPayment(){
        $metadata['info'] = "User initiated checkout";
        $this->mongoModel->addAction("/payment",$metadata);
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
        $requestData = session()->get('requestData');
        $info = "success";

        $this->cartModel->deletefromCartbyuserId($userId);
        $this->orderModel->saveOrder($userId, $address_id, $total_amount, $info, $paymentID);

        $this->mongoModel->addTransaction($paymentID, $payment_data, $requestData, $userId);
        $run_query = $this->paymentModel->insertdetails($paymentID, $userId);
        session()->remove('payment_method');
        session()->remove('orderData');
        session()->remove('paymentId');
        session()->remove('payment_data');
        session()->remove('requestData');
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
        if(!$paymentID){
            if(session()->get('payment_method')=='cashfree'){
                $paymentID = isset($payment_data[0]['cf_payment_id']) ? $payment_data[0]['cf_payment_id'] : null;
            }
            else{
                $paymentID ="Transaction not performed";
            }
        }
        $requestData = session()->get('requestData');

        $this->orderModel->saveOrder($userId, $address_id, $total_amount, $info, $paymentID);
        $run_query = $this->paymentModel->insertdetails($paymentID, $userId);
       
        $this->mongoModel->addTransaction($paymentID, $payment_data, $requestData, $userId);
        session()->remove('payment_method');
        session()->remove('orderData');
        session()->remove('paymentId');
        session()->remove('payment_data');
        session()->remove('requestData');
        return redirect()->to('/orderinfo')->with('status', $info)->with('orderData', $orderData);
    }

    public function viewOrderPage(){
        $userId = session()->get('id');
        $info = $this->orderModel->getorderIdTotalamtandstatusbyUserId($userId);
        return view("/userpanel/ordersinfo",['info' => $info]);
    }

    public function storePaymentId(){
        $paymentData = $this->request->getJSON(assoc: true);
        $paymentMethod = $paymentData['payment_method'];
        $paymentService = PaymentModelFactory::create($paymentMethod);
        $result = $paymentService->storePaymentId($paymentData);
        return $this->response->setJSON( $result);
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

    public function viewDetail($transaction_id){

        $result = $this->mongoModel->findbypaymentId($transaction_id);
        $resultArray = json_decode(json_encode($result), true);
        $responseData = json_decode($resultArray['response_data'], true);
        return view("/userpanel/pay_details", ['resultArray' => $resultArray, 'responseData' => $responseData, 'transaction_id' => $transaction_id]);
    }
}