<?php

namespace App\Controllers;
use App\Models\ProductsModel;
use App\Models\FeedbackModel;
use App\Models\UserModel;

class AdminController extends BaseController{

    protected $productsModel;
    protected $feedbackModel;
    protected $userModel;
    public function __construct(){
        parent::__construct();
        $this->productsModel = new ProductsModel();
        $this->feedbackModel = new FeedbackModel();
        $this->userModel = new UserModel();
    }

    public function adminHome(){
        return view("/userpanel/adminhome");
    }
}