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
    public function createTicket($data)
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

    public function createTicketMessage($data)
    {
        // Retrieve the ticket_id from the tickets table
        $this->db->query("SELECT id FROM tickets WHERE user_id = :user_id AND title = :title");
        $this->db->bind(":user_id", $data['user_id']);
        $this->db->bind(":title", $data['title']);
        $ticket = $this->db->fetch();

        if ($ticket) {
            $this->db->query("
                INSERT INTO ticket_messages (ticket_id, sender, dex, attach, created_at) 
                VALUES (:ticket_id, :sender, :dex, :attach, NOW())
            ");
            $this->db->bind(":ticket_id", $ticket['id']);
            $this->db->bind(":sender", $data['sender']);
            $this->db->bind(":dex", $data['dex']);
            $this->db->bind(":attach", $data['attach']);// Attachments are stored in a separate table
            return $this->db->execute();
        }

        return false; // Return false if no ticket is found
    }
}
