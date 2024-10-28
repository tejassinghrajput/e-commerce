<?php

namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\FeedbackModel;


class dashboardController extends BaseController{

    protected $orderModel;
    protected $feedbackModel;

    public function __construct(){
        parent::__construct();
        $this->orderModel = new OrderModel();
        $this->feedbackModel = new FeedbackModel();
    }

    public function viewDashboard(){
        if(!$this->sessioncheck){
            return redirect()->to('/login');
        }

        if(session()->get('email')!==null){
            $orderdata = $this->orderModel->getAllOrders();
            session()->setFlashdata('orderdata',$orderdata);
            return view('/userpanel/dashboard');
        }
        else{
            return redirect()->to('/login');
        }
    }
    public function orderDetails($id){

        if(!$this->sessioncheck){
            return redirect()->to('/login');
        }
        $orderinfo = $this->orderModel->getOrderById($id);
        $feedbackinfo = $this->feedbackModel->getFeedbackByOrderId($id);
        if($orderinfo){
            session()->setFlashdata('orderinfo',$orderinfo);
        }
        else{
            session()->setFlashdata('orderinfo',[]);
        }
        if(!empty($feedbackinfo) && is_array($feedbackinfo)){
            $sum=0;
            $count=0;
            $average=0;
            foreach($feedbackinfo as $feedback){
                if(isset($feedback['star'])){
                    $sum+=$feedback['star'];
                    $count++;
                }
                $average = $count > 0 ? $sum / $count : 0;
            }
            session()->setFlashdata('feedbackinfo',$feedbackinfo);
            session()->setFlashdata('sum',$average);
        }
        else{
            session()->setFlashdata('feedbackinfo',[]);
        }
        return view('/userpanel/orderdetails');
    }
}