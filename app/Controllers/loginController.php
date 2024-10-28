<?php

namespace App\Controllers;
use App\Models\UserModel;
class loginController extends BaseController{

    protected $userModel;

    public function __construct(){
        parent::__construct();
        $this->userModel = new UserModel(); 
    }

    public function userLogin(){
        if($this->sessioncheck){
            return redirect()->to('/dashboard');
        }
        $email=$this->request->getPost('email');
        $password=$this->request->getPost('password');
        $row = $this->userModel->getUserByEmailAndPassword($email, $password);
        if($row){
            session()->set([
                'email' => $email,
                'id'=> $row['id'],
                'name' => $row['fullname']
            ]);
            return redirect()->to('/dashboard');
        }
        else{
            $data=[
                "message"=>lang('messages.login_failed')
            ];
            return view("/userpanel/login",$data);
        }
    }
}