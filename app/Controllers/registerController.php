<?php

namespace App\Controllers;
use App\Models\UserModel;

class registerController extends BaseController{

    protected $userModel;

    public function __construct(){
        parent::__construct(); 
        $this->userModel = new UserModel();
    }

    public function registerUser(){

        if($this->sessioncheck){
            return redirect()->to('/dashboard');
        }
        //Selecting user's Data
        $email=$this->request->getPost('email');
        $password=$this->request->getPost('password');
        $username=$this->request->getPost('username');
        $fullname=$this->request->getPost('fullname');

        if($this->userModel->registerUser($fullname, $username, $email, $password)){
            $data=[
                'message'=> lang('messages.registration_success')
            ];
            return view("/userpanel/register",$data);
        }
        else{
            $data=[
                'message'=> lang('messages.registration_failed')
            ];
            return view("/userpanel/register",$data);
        }
    }
}