<?php

namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\FeedbackModel;
use App\Models\UserModel;

class dashboardController extends BaseController{

    protected $orderModel;
    protected $feedbackModel;
    protected $userModel;
    public function __construct(){
        parent::__construct();
        $this->orderModel = new OrderModel();
        $this->feedbackModel = new FeedbackModel();
        $this->userModel = new UserModel();
    }

    public function viewDashboard(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }
        $selectedCategories = $this->request->getGet('categories') ?? [];
        $allOrders = $this->orderModel->getAllOrders();
        $feedbackdata = $this->feedbackModel->getallaverageratings();
        $averageratings = [];
        foreach ($feedbackdata as $feedback) {
            $averageratings[$feedback['order_id']] = $feedback['avg_star'];
        }

        if (!empty($selectedCategories)) {
            $filteredOrders = array_filter($allOrders, function($order) use ($selectedCategories) {
                return in_array($order['category'], $selectedCategories);
            });
            $orderdata = empty($filteredOrders) ? ['no_results' => true] : $filteredOrders;
        } else {
            $orderdata = $allOrders;
        }
        if (empty($orderdata) || (isset($orderdata['no_results']) && $orderdata['no_results'])) {
            session()->setFlashdata('message', lang('messages.categories_error'));
        }
        return view('/userpanel/dashboard', [
            'orderdata' => $orderdata,
            'averageRatings' => $averageratings,
            'selectedCategories' => $selectedCategories
        ]);
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

    public function searchOrder(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }
        $search  = $this->request->getGet('search');

        if (empty($search )) {
            return redirect()->to('/dashboard');
        }    
        $data['search'] = $search;
        $results = $this->orderModel->searchOrdersByProductName($search );

        if ($results->getNumRows() > 0) {
            $data['orderdata']=$results->getResultArray();
        } else {
            $data['orderdata'] = [];
            session()->setFlashdata('message',lang('messages.no_search_data'));
        }
        $data['selectedCategories'] = [];
        $data['averageRatings'] = [];
        return view('userpanel/dashboard', $data);
    }

    public function filterOrders(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }
        $selectedCategories = $this->request->getGet('categories') ?? [];
        if(empty($selectedCategories)){
            return redirect()->to('/dashboard');
        }
        $results = $this->orderModel->getOrdersByCategories($selectedCategories);

        if ($results->getNumRows() > 0) {
            $orderdata = $results->getResultArray();
        } else {
            $orderdata = ['no_results' => true];
            session()->setFlashdata('message', lang('messages.categories_error'));
        }
        $feedbackdata = $this->feedbackModel->getallaverageratings();
        $averageratings = [];
        foreach ($feedbackdata as $feedback) {
            $averageratings[$feedback['order_id']] = $feedback['avg_star'];
        }
        session()->set('filtered_orderdata', $orderdata);
        session()->set('filtered_averageRatings', $averageratings);
        session()->set('selected_categories', $selectedCategories);
        return redirect()->to('/dashboard?' . http_build_query(['categories' => $selectedCategories]));
    }

    public function viewProfile(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }
        $userid=$this->session->get('id');
        $userdetails=$this->userModel->getUserbyID($userid);
        $this->session->setFlashdata('userdetails', $userdetails);
        return view("/userpanel/viewprofile");
    }
}