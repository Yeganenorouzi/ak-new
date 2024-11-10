<?php

class UserModel {
    
    private $db;
    public function __construct()
    {
      $this->db = new DataBase;
    }
    public function getUser($codemelli)
 {
  $this->db->query("SELECT * FROM users WHERE codemelli = :codemelli");
  $this->db->bind(":codemelli", $codemelli);
  return $this->db->fetch();

}


public function updateUser($data){
    $this->db->query("UPDATE users SET name = :name, email = :email, phone = :phone, address = :address WHERE codemelli = :codemelli");
    $this->db->bind(":name", $data["name"]);
    $this->db->bind(":email", $data["email"]);
    $this->db->bind(":phone", $data["phone"]);
    $this->db->bind(":address", $data["address"]);
    $this->db->bind(":codemelli", $data["codemelli"]);
}
}


