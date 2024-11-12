<?php

namespace App\Controllers;
use App\Models\ProductsModel;
use App\Models\FeedbackModel;
use App\Models\UserModel;

class dashboardController extends BaseController{

    protected $productsModel;
    protected $feedbackModel;
    protected $userModel;
    public function __construct(){
        parent::__construct();
        $this->productsModel = new ProductsModel();
        $this->feedbackModel = new FeedbackModel();
        $this->userModel = new UserModel();
    }

    public function viewDashboard(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }
        $selectedCategories = $this->request->getGet('categories') ?? [];
        $allOrders = $this->productsModel->getAllOrders();
        $feedbackdata = $this->feedbackModel->getallaverageratings();
        $averageratings = [];
        foreach ($feedbackdata as $feedback) {
            $averageratings[$feedback['order_id']] = $feedback['avg_star'];
        }

        if (!empty($selectedCategories)) {
            $filteredOrders = array_filter($allOrders, function($product) use ($selectedCategories) {
                return in_array($product['category_name'], $selectedCategories);
            });
            $productdata = empty($filteredOrders) ? ['no_results' => true] : $filteredOrders;
        } else {
            $productdata = $allOrders;
        }
        if (empty($productdata) || (isset($productdata['no_results']) && $productdata['no_results'])) {
            session()->setFlashdata('message', lang('messages.categories_error'));
        }
        return view('/userpanel/dashboard', [
            'productdata' => $productdata,
            'averageRatings' => $averageratings,
            'selectedCategories' => $selectedCategories
        ]);
    }

    public function productDetails($id){

        if(!$this->sessioncheck){
            return redirect()->to('/login');
        }
        $productinfo = $this->productsModel->getOrderById($id);
        $feedbackinfo = $this->feedbackModel->getFeedbackByOrderId($id);
        if($productinfo){
            session()->setFlashdata('productinfo',$productinfo);
        }
        else{
            session()->setFlashdata('productinfo',[]);
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
        return view('/userpanel/productdetails');
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
        $results = $this->productsModel->searchOrdersByProductName($search );

        if ($results->getNumRows() > 0) {
            $data['productdata']=$results->getResultArray();
        } else {
            $data['productdata'] = [];
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
        $results = $this->productsModel->getOrdersByCategories($selectedCategories);

        if ($results->getNumRows() > 0) {
            $productdata = $results->getResultArray();
        } else {
            $productdata = ['no_results' => true];
            session()->setFlashdata('message', lang('messages.categories_error'));
        }
        $feedbackdata = $this->feedbackModel->getallaverageratings();
        $averageratings = [];
        foreach ($feedbackdata as $feedback) {
            $averageratings[$feedback['order_id']] = $feedback['avg_star'];
        }
        session()->set('filtered_productdata', $productdata);
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

    public function updatePassword(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }
        $userId = $this->session->get('id');
        $currentPassword = $this->request->getPost('currentPassword');
        $newPassword = $this->request->getPost('newPassword');
        $confirmPassword = $this->request->getPost('confirmPassword');
        
        $data = [
            'status' => false,
            'message' => ''
        ];

        if($currentPassword == $newPassword){
            $data = [
                'status' => false,
                'message' => 'New password cannot be same as new password'
            ];
            return $this->response->setJSON(['data' => $data]);
        }
        else{

            $checkPassword = $this->db->query("SELECT password FROM users WHERE id = '$userId'")->getRow();

            if($newPassword == $confirmPassword){
                if($checkPassword->password == $currentPassword){
                    $result = $this->userModel->updatepasswordbyUserid($userId, $newPassword);

                    if($result){
                        $data = [
                            'status' => true,
                            'message' => 'Password updated successfully'
                        ];
                    }
                    else{
                        $data = [
                            'status' => false,
                            'message' => 'Unkown error occured'
                        ];
                    }
                }
                else{
                    $data = [
                        'status' => false,
                        'message' => 'You have entered wrong password.'
                    ];
                }
                
            }
            else{
                $data = [
                    'status' => false,
                    'message' => 'Passwords do not match'
                ];
            }
        }
        return $this->response->setJSON(['data' => $data]);
    }
}