<?php
namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\FeedbackModel;
use App\Models\UserModel;
use App\Models\MongoModel;

class categoryController extends BaseController {
    protected $sessioncheck = false;
    protected $productsModel;
    protected $feedbackModel;
    protected $userModel;
    protected $mongoModel;

    public function __construct(){
        parent::__construct();
        $getsession = session()->get('email');
        if($getsession){
            $this->sessioncheck = true;
        }
        $this->productsModel = new ProductsModel();
        $this->feedbackModel = new FeedbackModel();
        $this->userModel = new UserModel();
        $this->mongoModel = new MongoModel();
    }

    public function displaysubCategory($slug, $subslug){
        $query = $this->db->query("SELECT * FROM products WHERE category_name = '$slug' AND sub_category = '$subslug'")->getResultArray();

        $metadata['product_name'] ="";
        $metadata['product_id'] ="";
        foreach($query as $product){
            $metadata['product_name'] = $metadata['product_name']. "{".$product['product_name']."},";
            $metadata['product_id'] = $metadata['product_id']. "{".$product['product_id']."},";
        };
        $this->mongoModel->addAction("/category".$slug.$subslug,$metadata);
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
        $metadata['product_name'] ="";
        $metadata['product_id'] ="";
        foreach($query as $product){
            $metadata['product_name'] = $metadata['product_name']. "{".$product['product_name']."},";
            $metadata['product_id'] = $metadata['product_id']. "{".$product['product_id']."},";
        };
        
        $this->mongoModel->addAction("/category".$slug,$metadata);
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