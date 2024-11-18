<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\MongoModel;

class loginController extends BaseController{

    protected $userModel;
    protected $mongoModel;

    public function __construct(){
        parent::__construct();
        $this->userModel = new UserModel();
        $this->mongoModel = new MongoModel(); 
    }

    public function userLogin(){
        if($this->sessioncheck){
            return redirect()->to('/dashboard');
        }
        $email=$this->request->getPost('email');
        $password=$this->request->getPost('password');

        $userExists = $this->userModel->getUserbyEmail($email);

        if($userExists){
            $row = $this->userModel->getUserByEmailAndPassword($email, $password);
            if($row){
                $loginSession = $row['fullname']."-".uniqid();
                session()->set([
                    'email' => $email,
                    'id'=> $row['id'],
                    'name' => $row['fullname'],
                    'login_session_id' => $loginSession
                ]);
                $this->mongoModel->insertLoginLogbyuserId($row['id'], $loginSession);
                return redirect()->to('/dashboard');
            }
            else{
                session()->setFlashdata('message', lang('messages.login_failed'));
                return redirect()->to('/login');
            }
        }
        else{
            session()->setFlashdata('message', lang('messages.user_not_found'));
            return redirect()->to('/login');
        }
    }
}