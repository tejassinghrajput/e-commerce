<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payment_details';
    protected $primaryKey = 'id';

    public function insertdetails($paymentID, $payment_data, $userId){
        $query = "INSERT INTO payment_details (payment_id, payment_data, user_id) VALUES ('$paymentID','$payment_data','$userId')";
        return $query = $this->db->query($query);
    }
}