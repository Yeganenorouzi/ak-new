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
        $this->db->query("
            SELECT t.*, u1.name as created_by_name, u2.name as assigned_to_name 
            FROM tickets t 
            LEFT JOIN users u1 ON t.created_by = u1.id 
            LEFT JOIN users u2 ON t.assigned_to = u2.id 
            ORDER BY t.created_at DESC
        ");
        return $this->db->fetchAll();
    }

    // دریافت تیکت با شناسه یکتا
    public function getTicketById($id)
    {
        $this->db->query("
            SELECT t.*, u1.name as created_by_name, u2.name as assigned_to_name 
            FROM tickets t 
            LEFT JOIN users u1 ON t.created_by = u1.id 
            LEFT JOIN users u2 ON t.assigned_to = u2.id 
            WHERE t.id = :id
        ");
        $this->db->bind(":id", $id);
        return $this->db->fetch();
    }

    // دریافت پیام‌های یک تیکت
    public function getTicketMessages($ticketId)
    {
        $this->db->query("
            SELECT tm.*, u.name as sender_name 
            FROM ticket_messages tm 
            LEFT JOIN users u ON tm.sender = u.id 
            WHERE tm.ticket_id = :ticket_id 
            ORDER BY tm.created_at ASC
        ");
        $this->db->bind(":ticket_id", $ticketId);
        return $this->db->fetchAll();
    }

    // ایجاد تیکت جدید
    public function createTicket($data)
    {
        $this->db->query("
            INSERT INTO tickets (
                ticket_number, subject, description, status, priority, 
                created_by, assigned_to, created_at ,attach
            ) VALUES (
                :ticket_number, :subject, :description, :status, :priority,
                :created_by, :assigned_to, NOW(), :attach
            )
        ");

        $this->db->bind(":ticket_number", $data['ticket_number']);
        $this->db->bind(":subject", $data['subject']);
        $this->db->bind(":description", $data['description']);
        $this->db->bind(":status", $data['status']);
        $this->db->bind(":priority", $data['priority']);
        $this->db->bind(":created_by", $data['created_by']);
        $this->db->bind(":assigned_to", $data['assigned_to']);
        $this->db->bind(":attach", $data['attach'] ?? null);
        return $this->db->execute();
    }

    // ایجاد پیام جدید برای تیکت
    public function createTicketMessage($data)
    {
        $this->db->query("
            INSERT INTO ticket_messages (
                ticket_id, sender, dex, attach, created_at
            ) VALUES (
                :ticket_id, :sender, :dex, :attach, NOW()
            )
        ");

        $this->db->bind(":ticket_id", $data['ticket_id']);
        $this->db->bind(":sender", $data['sender']);
        $this->db->bind(":dex", $data['dex']);
        $this->db->bind(":attach", $data['attach']);

        return $this->db->execute();
    }

    // بروزرسانی وضعیت تیکت
    public function updateTicketStatus($ticketId, $status)
    {
        $this->db->query("
            UPDATE tickets 
            SET status = :status, updated_at = NOW() 
            WHERE id = :id
        ");
        $this->db->bind(":status", $status);
        $this->db->bind(":id", $ticketId);
        return $this->db->execute();
    }

    // بروزرسانی اولویت تیکت
    public function updateTicketPriority($ticketId, $priority)
    {
        $this->db->query("
            UPDATE tickets 
            SET priority = :priority, updated_at = NOW() 
            WHERE id = :id
        ");
        $this->db->bind(":priority", $priority);
        $this->db->bind(":id", $ticketId);
        return $this->db->execute();
    }

    // اختصاص تیکت به کاربر
    public function assignTicket($ticketId, $userId)
    {
        $this->db->query("
            UPDATE tickets 
            SET assigned_to = :assigned_to, updated_at = NOW() 
            WHERE id = :id
        ");
        $this->db->bind(":assigned_to", $userId);
        $this->db->bind(":id", $ticketId);
        return $this->db->execute();
    }

    public function getUsersByRole($role = null)
    {
        if ($role === 'admin') {
            $this->db->query("SELECT * FROM users WHERE admin = 1");
        } else if ($role === 'agent') {
            $this->db->query("SELECT * FROM users WHERE admin = 0");
        } else {
            $this->db->query("SELECT * FROM users");
        }
        return $this->db->fetchAll();
    }

    public function getTotalTickets($filters = [])
    {
        $sql = "SELECT COUNT(*) as total FROM tickets WHERE 1=1";
        $params = [];

        if (!empty($filters['ticket_number'])) {
            $sql .= " AND ticket_number LIKE :ticket_number";
            $params[':ticket_number'] = "%{$filters['ticket_number']}%";
        }

        if (!empty($filters['status'])) {
            $sql .= " AND status = :status";
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['priority'])) {
            $sql .= " AND priority = :priority";
            $params[':priority'] = $filters['priority'];
        }

        $this->db->query($sql);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        $result = $this->db->fetch();
        return $result->total;
    }

    public function getPaginatedTickets($page, $per_page, $filters = [])
    {
        $offset = ($page - 1) * $per_page;

        $sql = "SELECT t.*, u1.name as created_by_name, u2.name as assigned_to_name 
                FROM tickets t 
                LEFT JOIN users u1 ON t.created_by = u1.id 
                LEFT JOIN users u2 ON t.assigned_to = u2.id 
                WHERE 1=1";
        $params = [];

        if (!empty($filters['ticket_number'])) {
            $sql .= " AND t.ticket_number LIKE :ticket_number";
            $params[':ticket_number'] = "%{$filters['ticket_number']}%";
        }

        if (!empty($filters['status'])) {
            $sql .= " AND t.status = :status";
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['priority'])) {
            $sql .= " AND t.priority = :priority";
            $params[':priority'] = $filters['priority'];
        }

        $sql .= " ORDER BY t.created_at DESC LIMIT :limit OFFSET :offset";
        $params[':limit'] = $per_page;
        $params[':offset'] = $offset;

        $this->db->query($sql);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->fetchAll();
    }

    public function getTotalTicketsByAgent($agentId, $filters = [])
    {
        $sql = "SELECT COUNT(*) as total FROM tickets WHERE (created_by = :agent_id1 OR assigned_to = :agent_id2)";
        $params = [
            ':agent_id1' => $agentId,
            ':agent_id2' => $agentId
        ];

        if (!empty($filters['ticket_number'])) {
            $sql .= " AND ticket_number LIKE :ticket_number";
            $params[':ticket_number'] = "%{$filters['ticket_number']}%";
        }

        if (!empty($filters['status'])) {
            $sql .= " AND status = :status";
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['priority'])) {
            $sql .= " AND priority = :priority";
            $params[':priority'] = $filters['priority'];
        }

        $this->db->query($sql);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        $result = $this->db->fetch();
        return $result->total;
    }

    public function getTicketsByAgent($agentId, $filters = [], $page = 1, $per_page = 30)
    {
        $offset = ($page - 1) * $per_page;

        $sql = "SELECT t.*, u1.name as created_by_name, u2.name as assigned_to_name 
                FROM tickets t 
                LEFT JOIN users u1 ON t.created_by = u1.id 
                LEFT JOIN users u2 ON t.assigned_to = u2.id 
                WHERE (t.created_by = :agent_id1 OR t.assigned_to = :agent_id2)";
        $params = [
            ':agent_id1' => $agentId,
            ':agent_id2' => $agentId
        ];

        if (!empty($filters['ticket_number'])) {
            $sql .= " AND t.ticket_number LIKE :ticket_number";
            $params[':ticket_number'] = "%{$filters['ticket_number']}%";
        }

        if (!empty($filters['status'])) {
            $sql .= " AND t.status = :status";
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['priority'])) {
            $sql .= " AND t.priority = :priority";
            $params[':priority'] = $filters['priority'];
        }

        $sql .= " ORDER BY t.created_at DESC LIMIT :offset, :per_page";
        $params[':offset'] = $offset;
        $params[':per_page'] = $per_page;

        $this->db->query($sql);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->fetchAll();
    }
}
