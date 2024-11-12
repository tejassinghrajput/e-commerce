<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';

    public function deletefromCartbyuserId($userId){
        $query = $this->db->query("DELETE FROM cart WHERE user_id = '$userId'");
    }

    public function getAllcartfromuserId($userId){
        $query = "SELECT * FROM cart WHERE user_id = '$userId'";
        $query = $this->db->query($query)->getResultArray();
        return $query;
    }

    public function updateCartbyproductidanduserId($productId, $userId){
        $query = "UPDATE cart SET quantity = IFNULL(quantity, 0) + 1  WHERE product_id = '$productId' AND user_id = '$userId'";
        return $query = $this->db->query($query);
    }

    public function insertintocartbyproductidanduserId($productId, $userId){
        $query = "INSERT INTO cart (product_id, user_id, quantity) VALUES ('$productId', '$userId', 1)";
        return $query = $this->db->query($query);
    }

    public function getproductnameimageandpricebyproductid($product_id){
        $query = "SELECT product_name, price, image FROM products WHERE product_id = '$product_id'";
        return $query = $this->db->query($query)->getRow();
    }

    public function removeItembycartId($cartId){
        $query = "DELETE FROM cart WHERE cart_id = '$cartId'";
        return $query = $this->db->query($query);
    }

    public function deletitembyuserId($userId){
        $query = "DELETE FROM cart WHERE user_id = '$userId'";
        return $query = $this->db->query($query);
    }
}