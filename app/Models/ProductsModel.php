<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'products_id';

    public function getAllOrders(){
        $query = "SELECT * FROM products";
        return $this->db->query($query)->getResultArray();
    }

    public function getOrderById($id){
        $query = "SELECT * FROM products WHERE product_id = ?";
        return $this->db->query($query, [$id])->getRowArray();
    }

    public function getOrdersByCategories(array $categories){
        $query = "SELECT * FROM products WHERE 1=1";
        $params = [];

        if (!empty($categories)) {
            $placeholders = implode(',', array_fill(0, count($categories), '?'));
            $query .= " AND category_name IN ($placeholders)";
            $params = $categories;
        }

        return $this->db->query($query, $params);
    }
    
    public function searchOrdersByProductName($name){
        $query = "SELECT * FROM products WHERE product_name LIKE ?";
        $searchtext = '%' . $name . '%';

        return $this->db->query($query, [$searchtext]);
    }

    public function getProductsByCategoryId($categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }

    public function getProductsBySubcategoryId($subcategoryId)
    {
        return $this->where('subcategory_id', $subcategoryId)->findAll();
    }
}
