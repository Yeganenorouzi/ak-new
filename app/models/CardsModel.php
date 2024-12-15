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

    public function getTotalCards()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM serials");
        return $this->db->fetch()->total;
    }

    public function getCardBySerial($serial)
    {
        $this->db->query("SELECT * FROM serials WHERE serial = :serial");
        $this->db->bind(':serial', $serial);
        return $this->db->fetch();
    }

    public function createCard($data)
    {
        $this->db->query("INSERT INTO serials (serial, serial2 , model ,title, att1_code ,att2_code ,att3_code ,att4_code ,company ,sh_sanad , 	start_guarantee ,expite_guarantee) 
                          VALUES (:serial, :serial2 , :model , :title , :att1_code , :att2_code , :att3_code , :att4_code , :company , :sh_sanad , :start_guarantee , :expite_guarantee)");

        $this->db->bind(':serial', $data['serial']);
        $this->db->bind(':serial2', $data['serial2']);
        $this->db->bind(':model', $data['model']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':att1_code', $data['att1_code']);
        $this->db->bind(':att2_code', $data['att2_code']);
        $this->db->bind(':att3_code', $data['att3_code']);
        $this->db->bind(':att4_code', $data['att4_code']);
        $this->db->bind(':company', $data['company']);
        $this->db->bind(':sh_sanad', $data['sh_sanad']);
        $this->db->bind(':start_guarantee', $data['start_guarantee']);
        $this->db->bind(':expite_guarantee', $data['expite_guarantee']);

        return $this->db->execute();
    }
}
