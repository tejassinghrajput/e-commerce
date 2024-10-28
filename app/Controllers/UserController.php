<?php

namespace App\Controllers;

class UserController extends BaseController{
    protected $sessioncheck=false;

    public function __construct(){
        $getsession=session()->get('email');
        if($getsession){
            $this->sessioncheck=true;
        }
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
        session()->destroy();
        return redirect()->to('/login');
    }
}