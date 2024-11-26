<?php

class ReceptionsModel
{
  private $db;
  public function __construct()
  {
    $this->db = new Database();
  }


  // public function createReception($title, $price, $discount, $quantity, $category_id, $description, $image_name, $alt, $is_amazing, $status)
  // {
  //   $this->db->query("INSERT INTO receptions (title,price,discount,quantity,category_id,description,image,alt,incredibles,publish) VALUES (:title,:price,:discount,:quantity,:category_id,:description,:image_name,:alt,:is_amazing,:status)");
  //   $this->db->bind(":title", $title);
  //   $this->db->bind(":price", $price);
  //   $this->db->bind(":discount", $discount);
  //   $this->db->bind(":quantity", $quantity);
  //   $this->db->bind(":category_id", $category_id);
  //   $this->db->bind(":description", $description);
  //   $this->db->bind(":image_name", $image_name);
  //   $this->db->bind(":alt", $alt);
  //   $this->db->bind(":is_amazing", $is_amazing);
  //   $this->db->bind(":status", $status);
  //   $this->db->execute();
  // }

  public function getAllReceptions()
  {
    $this->db->query("SELECT receptions.*, serials.* ,customers.* 
                      FROM receptions 
                      INNER JOIN serials ON receptions.serial_id = serials.id 
                      INNER JOIN customers ON receptions.customer_id = customers.id  
                      ORDER BY receptions.id DESC");
    $receptions = $this->db->fetchAll();
    return $receptions;
  }
}
