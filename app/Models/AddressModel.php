<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'address_id';

    public function insertAddress($id, $street, $city, $state, $pincode){
        $query="INSERT INTO address (user_id,street,city,state,pincode,is_default) VALUES('$id', '$street', '$city', '$state', '$pincode','null')";
        return $this->db->query($query);
    }

    public function getAddressbyId($id){
        $query="SELECT * FROM address where user_id = '$id'";
        return $this->db->query($query)->getResultArray();
    }

    public function unDefaultAllAddressbyId($id){
        $query="UPDATE address SET is_default = NULL WHERE user_id = '$id'";
        return $this->db->query($query);
    }

    public function setDefaultAddressbyIdandUserId($id, $addressid){
        $query="UPDATE address SET is_default = 1 WHERE address_id = '$addressid' AND user_id = '$id'";
        return $this->db->query($query);
    }

    public function editAddressbyAddressId($id, $addressid, $street, $city, $state, $pincode){
        $query = "UPDATE address SET user_id = '$id', street = '$street', city = '$city', state = '$state', pincode = '$pincode' WHERE address_id = '$addressid'";
        return $this->db->query($query);
    }

    public function checkDefaultAddressbyUserIdandAddressId($id, $addressid){
        $checkquery = "SELECT is_default FROM address WHERE address_id = '$addressid' AND user_id = '$id'";
        $checkresult = $this->db->query($checkquery)->getRow();
        return $checkresult;
    }

    public function editDefaultAddressbyAddressIdandUserId($id, $addressid){
        $query = "DELETE FROM address WHERE address_id = '$addressid' AND user_id = '$id'";
        $res=$this->db->query($query);
        return $res;
    }
}