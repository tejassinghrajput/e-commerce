<?php

namespace App\Controllers\vendorController;
use App\Models\ProductsModel;
use App\Models\FeedbackModel;
use App\Models\UserModel;

use App\Controllers\BaseController;

class vendorHome extends BaseController{

    protected $productsModel;
    protected $feedbackModel;
    protected $userModel;
    public function __construct(){
        parent::__construct();
        $this->productsModel = new ProductsModel();
        $this->feedbackModel = new FeedbackModel();
        $this->userModel = new UserModel();
    }

    public function vendorHome(){
        return view("/vendorpanel/vendorhome");
    }

    public function products(){
        return view("/vendorpanel/products");
    }

    public function orders(){
        return view("/vendorpanel/orders");
    }

}