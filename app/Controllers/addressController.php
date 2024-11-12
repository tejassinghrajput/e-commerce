<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AddressModel;

class addressController extends BaseController{

    protected $orderModel;
    protected $feedbackModel;
    protected $userModel;
    public function __construct(){
        parent::__construct();
        $this->userModel = new UserModel();
        $this->addressModel = new AddressModel();
    }

    public function add(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }

        $id=$this->session->get('id');
        $street=$this->request->getPost('address');
        $city=$this->request->getPost('city');
        $state=$this->request->getPost('state');
        $pincode=$this->request->getPost('pincode');
        $insert = $this->addressModel->insertAddress($id, $street, $city, $state, $pincode);
        return $this->response->setJSON(['success' => true, 'message' => 'Address added successfully.']);
    }

    public function showall(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }

        $id=$this->session->get('id');
        $result = $this->addressModel->getAddressbyId($id);
        return $this->response->setJSON(['success' => true, 'addresses' => $result]);
    }

    public function makedefault(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }

        $id=$this->session->get('id');
        $addressid=$this->request->getPost('address_id');

        if($addressid){
            $this->addressModel->unDefaultAllAddressbyId($id);
            $this->addressModel->setDefaultAddressbyIdandUserId($id, $addressid);
            return $this->response->setJSON(['success' => true, 'message' => lang('messages.default_address_change_success')]);
            }

        else{
            return $this->response->setJSON(['success' => false, 'message' => lang('messages.default_address_change_failed')]);
        }
    }

    public function edit(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }

        $id=$this->session->get('id');
        $addressid=$this->request->getPost('address_id');
        $street=$this->request->getPost('address');
        $city=$this->request->getPost('city');
        $state=$this->request->getPost('state');
        $pincode=$this->request->getPost('pincode');
        $this->addressModel->editAddressbyAddressId($id, $addressid, $street, $city, $state, $pincode);
        return $this->response->setJSON(['success' => true, 'message' => lang('messages.address_edit_successfully')]);
    }
    
    public function delete(){
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }

        $id = $this->session->get('id');
        $addressid = $this->request->getPost('address_id');
        $checkresult = $this->addressModel->checkDefaultAddressbyUserIdandAddressId($id, $addressid);
        if($checkresult->is_default){
            return $this->response->setJSON(['success' => true, 'message' => lang('messages.delete_address_fail_default')]);
        }
        $res = $this->addressModel->editDefaultAddressbyAddressIdandUserId($id, $addressid);
        if($res){
        return $this->response->setJSON(['success' => true, 'message' => lang('messages.delete_address_successfull')]);
        }
        else{
            return $this->response->setJSON(['success' => true, 'message' => lang('messages.delete_address_fail')]);
        }
    }
}