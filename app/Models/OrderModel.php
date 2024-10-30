<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    public function getAllOrders(){
        $query = "SELECT * FROM orders";
        return $this->db->query($query)->getResultArray();
    }

    public function getOrderById($id){
        $query = "SELECT * FROM orders WHERE order_id = ?";
        return $this->db->query($query, [$id])->getRowArray();
    }

    public function getOrdersByCategories(array $categories){
        $query = "SELECT * FROM orders WHERE 1=1";
        $params = [];

        if (!empty($categories)) {
            $placeholders = implode(',', array_fill(0, count($categories), '?'));
            $query .= " AND category IN ($placeholders)";
            $params = $categories;
        }

        return $this->db->query($query, $params);
    }
    
    public function searchOrdersByProductName($name){
        $query = "SELECT * FROM orders WHERE product_name LIKE ?";
        $searchtext = '%' . $name . '%';

        return $this->db->query($query, [$searchtext]);
    }
}
