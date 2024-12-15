<?php

class CustomersModel{
    private $db;
    public function __construct()
    {
        $this->db = new DataBase;
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
}