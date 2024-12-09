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
}