<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function registerUser($fullname, $username, $email, $password)
    {
        $query = "INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)";
        $result = $this->db->query($query, [$fullname, $username, $email, $password]);
        return $result ? true : false;
    }

    public function getUserByEmailAndPassword($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        return $this->db->query($query, [$email, $password])->getRowArray();
    }
}
