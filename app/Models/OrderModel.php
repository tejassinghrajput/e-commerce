<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    public function saveOrder($userId, $address_id, $total_amount, $info, $paymentID){

        $query = "INSERT INTO orders (user_id, address_id, total_amount, `status`, payment_id) VALUES ('$userId','$address_id','$total_amount','$info', '$paymentID')";
        $run_query = $this->db->query($query);
    }

    public function getorderIdTotalamtandstatusbyUserId($userId){
        $query = "SELECT order_id, status, total_amount FROM orders where user_id ='$userId' ";
        return $query = $this->db->query($query)->getResultArray();;
    }

}