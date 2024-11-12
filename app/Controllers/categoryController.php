<?php
namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\FeedbackModel;
use App\Models\UserModel;

class categoryController extends BaseController {
    protected $sessioncheck = false;
    protected $productsModel;
    protected $feedbackModel;
    protected $userModel;

    public function __construct(){
        parent::__construct();
        $getsession = session()->get('email');
        if($getsession){
            $this->sessioncheck = true;
        }
        $this->productsModel = new ProductsModel();
        $this->feedbackModel = new FeedbackModel();
        $this->userModel = new UserModel();
        
    }

    public function displaysubCategory($slug, $subslug){
        $query = $this->db->query("SELECT * FROM products WHERE category_name = '$slug' AND subcategory = '$subslug'")->getResultArray();
        
        $averageRatings = [];
        $feedbackdata = $this->feedbackModel->getallaverageratings();
        $averageratings = [];
        foreach ($feedbackdata as $feedback) {
            $averageratings[$feedback['order_id']] = $feedback['avg_star'];
        }

        $breadcrumbs = [
            'Home' => base_url(),
            $slug => base_url('category/'.$slug),
            $subslug => '#'
        ];
        return view('userpanel/dashboard', [
            'productdata' => $query,
            'averageRatings' => $averageratings,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function displayCategory($slug){
        $query = $this->db->query("SELECT * FROM products WHERE category_name = '$slug'")->getResultArray();
        
        $breadcrumbs = [
            'Home' => base_url(),
            $slug => '#'
        ];

        $averageRatings = [];
        return view('userpanel/dashboard', [
            'productdata' => $query,
            'averageRatings' => $averageRatings,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}