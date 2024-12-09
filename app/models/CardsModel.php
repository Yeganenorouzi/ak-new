<?php

class CardsModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function getAllCards()
    {
        $this->db->query("SELECT * FROM serials LIMIT 50 OFFSET 0");
        return $this->db->fetchAll();
    }

    public function getTotalCards(){
        $this->db->query("SELECT COUNT(*) AS total FROM serials");
        return $this->db->fetch()->total;
    }
}




