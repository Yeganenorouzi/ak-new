<?php

class TicketsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // دریافت همه تیکت‌ها
    public function getAllTickets()
    {
        $this->db->query("SELECT * FROM tickets ORDER BY created_at DESC");
        return $this->db->fetchAll();
    }

    // دریافت تیکت با شناسه یکتا
    public function getTicketById($id)
    {
        $this->db->query("SELECT * FROM tickets WHERE id = :id");
        $this->db->bind(":id", $id);
        return $this->db->fetch();
    }

    // ایجاد تیکت جدید
    public function createTicket(array $data)
    {
        $this->db->query("
            INSERT INTO tickets (user_id, title, status, created_at) 
            VALUES (:user_id, :title, :status, NOW())
        ");
        $this->db->bind(":user_id", $data['user_id']);
        $this->db->bind(":title", $data['title']);
        $this->db->bind(":status", $data['status']);
        return $this->db->execute();
    }
}
