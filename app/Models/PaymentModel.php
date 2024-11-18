<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payment_details';
    protected $primaryKey = 'id';

    public function insertdetails($paymentID, $userId){
        $query = "INSERT INTO payment_details (payment_id, user_id) VALUES ('$paymentID','$userId')";
        return $query = $this->db->query($query);
    }
}