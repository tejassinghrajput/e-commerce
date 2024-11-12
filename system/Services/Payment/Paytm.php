<?php
namespace System\Services\Payment;

class Paytm{

    public function processPayment($amount,$status){
        if($status == "pending"){
            return "pending";
        }
        else if($status == "completed"){
            return "completed";
        }
        else if($status == "failed"){
            return "failed";
        }
        else{
            return "unknown error";
        }
    }
}