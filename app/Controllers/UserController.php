<?php

namespace App\Controllers;

use App\Models\MongoModel;

class UserController extends BaseController{

    protected $mongoModel;
    protected $sessioncheck=false;

    public function __construct(){
        $getsession=session()->get('email');
        if($getsession){
            $this->sessioncheck=true;
        }
        $this->mongoModel=new MongoModel();
    }
    
    public function login(){
        if($this->sessioncheck){
            return redirect()->to('/dashboard');
        }
        return view('/userpanel/login.php');
    }

    public function register(){
        if($this->sessioncheck){
            return redirect()->to('/dashboard');
        }
        return view('/userpanel/register.php');
    }

    public function logout(){

        $login_session_id = session()->get('login_session_id');

        $this->mongoModel->updatelogbyLogidforLogout($login_session_id);

        session()->destroy();
        return redirect()->to('/login');
    }

    public function changepassword(){
        return view("/userpanel/changepassword");
    }
}