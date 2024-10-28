<?php

namespace App\Controllers;
use App\Models\FeedbackModel;

class feedbackController extends BaseController{

    protected $feedbackModel;
    public function __construct(){
        parent::__construct();
        $this->feedbackModel = new FeedbackModel();
    }
    public function submitfeedback($id){
        if(!$this->sessioncheck){
            return redirect()->to('/login');
        }
        $userid = session()->get('id');
        $username = session()->get('name');
        $res = $this->feedbackModel->getFeedbackByOrderIdAndUserId($id, $userid);
        if ($res) {
            session()->setFlashdata('info', 'Feedback already exists');
            return redirect()->to("/vieworderdetail/$id");
        }
        $feedbackdata=$this->request->getPost('text');
        $feedbackstar=$this->request->getPost('rating');
        if($feedbackstar==null){
            session()->setFlashdata('info',lang('messages.feedbackstar_not_validated'));
        }
        else if($feedbackdata==null){
            session()->setFlashdata('info',lang('messages.feedbacktext_not_validated'));
        }
        else{
            $userid = session()->get('id');
            $insert = $this->feedbackModel->insertFeedback($userid, $feedbackdata, $feedbackstar, $id, $username);
            if($insert){
                session()->setFlashdata('info',lang('messages.feedback_added'));
            }
            else{
                session()->setFlashdata('info',lang('messages.feedback_fail'));
            }
        }
        return redirect()->to("/vieworderdetail/$id");
    }

    public function editFeedback($feedbackid){
        if(!$this->sessioncheck){
            return redirect()->to('/login');
        }
        $feedbackdata = $this->feedbackModel->getFeedbackById($feedbackid);
        return view('/userpanel/editfeedback', ['feedbackdata'=>$feedbackdata]);
    }

    public function submitedit($feedbackid) {
        if (!$this->sessioncheck) {
            return redirect()->to('/login');
        }
        $feedbacktext = $this->request->getPost('text');
        $feedbackstar = $this->request->getPost('rating');
        $update = $this->feedbackModel->updateFeedback($feedbackid, $feedbacktext, $feedbackstar); // Use model method

        if ($update) {
            session()->setFlashdata('info1', lang('messages.feedback_update_success'));
        } else {
            session()->setFlashdata('info1', lang('messages.feedback_update_failed'));
        }
        return redirect()->to("/editfeedback/$feedbackid");
    }

    public function deleteFeedback($feedbackid,$id){
        if(!$this->sessioncheck){
            return redirect()->to('/login');
        }
        $delete = $this->feedbackModel->deleteFeedback($feedbackid);
        if ($delete) {
            session()->setFlashdata('info', lang('messages.feedback_delete_success'));
        } else {
            session()->setFlashdata('info', lang('messages.feedback_delete_failed'));
        }
        return redirect()->to("/vieworderdetail/$id");
    }
}