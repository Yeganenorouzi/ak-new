<?php

class ReceptionsModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }


    public function createReception($title,$price,$discount,$quantity,$category_id,$description,$image_name,$alt,$is_amazing,$status)
    {
        $this->db->query("INSERT INTO receptions (title,price,discount,quantity,category_id,description,image,alt,incredibles,publish) VALUES (:title,:price,:discount,:quantity,:category_id,:description,:image_name,:alt,:is_amazing,:status)");
        $this->db->bind(":title",$title);
        $this->db->bind(":price",$price);
        $this->db->bind(":discount",$discount);
        $this->db->bind(":quantity",$quantity);
        $this->db->bind(":category_id",$category_id);
        $this->db->bind(":description",$description);
        $this->db->bind(":image_name",$image_name);
        $this->db->bind(":alt",$alt);
        $this->db->bind(":is_amazing",$is_amazing);
        $this->db->bind(":status",$status);
        $this->db->execute(); 
      } 


      public function getProducts(){
        $this->db->query("SELECT category.title as category_title , products.* FROM products inner join category on products.category_id=category.id");
        return $this->db->fetchAll();
      } 
      public function selectId($id){
        $this->db->query("SELECT * FROM products WHERE id=:id");
        $this->db->bind(":id",$id);
        return $this->db->fetch();
      }
      public function incredibleProduct($id) {
        $incredible = $this->selectId($id);
        $newValue = ($incredible->incredibles == "on") ? "off" : "on";
        $this->db->query("UPDATE products SET incredibles = ? WHERE id = ?");
        $this->db->bind(1, $newValue);
        $this->db->bind(2, $id);
        $this->db->execute();
      }
      public function publishProduct($id){
        $publish=$this->selectId($id);
        if($publish->publish==1){
          $this->db->query("UPDATE products SET publish=? WHERE id=?");
          $this->db->bind(1,0);
          $this->db->bind(2,$id);
          $this->db->execute();
        }else{
          $this->db->query("UPDATE products SET publish=? WHERE id=?");
          $this->db->bind(1,1);
          $this->db->bind(2,$id);
          $this->db->execute();
        }
      } 
      public function deleteProduct($id){
        $this->db->query("DELETE FROM products WHERE id=:id");
        $this->db->bind(":id",$id);
        $this->db->execute();
      }
      public function updateProduct($id,$title,$price,$discount,$quantity,$category_id,$is_amazing,$status,$image_name,$description,$alt){
        $this->db->query("UPDATE products SET title=?,price=?,discount=?,quantity=?,category_id=?,incredibles=?,publish=?,image=?,description=?,alt=? WHERE id=?");
        $this->db->bind(1,$title);
        $this->db->bind(2,$price);
        $this->db->bind(3,$discount);
        $this->db->bind(4,$quantity);
        $this->db->bind(5,$category_id);
        $this->db->bind(6,$is_amazing);
        $this->db->bind(7,$status);
        $this->db->bind(8,$image_name);
        $this->db->bind(9,$description);
        $this->db->bind(10,$alt);
        $this->db->bind(11,$id);
        $this->db->execute();
      } 
}
   








    
   
  