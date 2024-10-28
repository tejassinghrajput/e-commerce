<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    public function getAllOrders()
    {
        $query = "SELECT * FROM orders";
        return $this->db->query($query)->getResultArray();
    }

    public function getOrderById($id)
    {
        $query = "SELECT * FROM orders WHERE order_id = ?";
        return $this->db->query($query, [$id])->getRowArray();
    }
}
