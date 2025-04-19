<?php

class CustomersModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCustomers(){
        $this->db->query("SELECT * FROM customers");
        return $this->db->fetchAll();
    }

    public function getCustomerBycodemelli($codemelli) {
        $this->db->query("SELECT * FROM customers WHERE codemelli = :codemelli");
        $this->db->bind(':codemelli', $codemelli);
        return $this->db->fetch();
    }

    public function createCustomer($data) {
        $this->db->query("INSERT INTO customers (name, codemelli, phone, address, mobile, passport, ostan, shahr, address, codeposti) 
                          VALUES (:name, :codemelli, :phone, :address, :mobile, :passport, :ostan, :shahr, :address, :codeposti)");
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':codemelli', $data['codemelli']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':passport', $data['passport']);
        $this->db->bind(':ostan', $data['ostan']);
        $this->db->bind(':shahr', $data['shahr']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':codeposti', $data['codeposti']);
    

        return $this->db->execute();
    }

    public function getAllCustomersByAgent(){
        $this->db->query("SELECT DISTINCT customers .* 
                          FROM customers 
                          INNER JOIN receptions ON receptions.customer_id = customers.id 
                          WHERE receptions.user_id = :user_id");
        $this->db->bind(':user_id', $_SESSION['id']);
        return $this->db->fetchAll();
    }

    public function getCustomerById($id){
        $this->db->query("SELECT * FROM customers WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->fetch();
    }

    public function updateCustomer($id, $data){
        $this->db->query("UPDATE customers SET name = :name, codemelli = :codemelli, phone = :phone, mobile = :mobile, passport = :passport, ostan = :ostan, shahr = :shahr, address = :address, codeposti = :codeposti WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':codemelli', $data['codemelli']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':passport', $data['passport']);
        $this->db->bind(':ostan', $data['ostan']);
        $this->db->bind(':shahr', $data['shahr']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':codeposti', $data['codeposti']);
        return $this->db->execute();
    }

    public function getCustomerByPassport($passport)
    {
        $this->db->query("SELECT * FROM customers WHERE passport = :passport");
        $this->db->bind(':passport', $passport);
        return $this->db->fetch();
    }
}