<?php
class ReceptionStatusModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM product_statuses ORDER BY id ASC");
        return $this->db->fetchAll();
    }

    public function get($id)
    {
        $this->db->query("SELECT * FROM product_statuses WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->fetch();
    }

    public function add($data)
    {
        try {
            error_log("Adding new status with data: " . print_r($data, true));
            $this->db->query("INSERT INTO product_statuses (status) VALUES (:status)");
            $this->db->bind(':status', $data['status']);
            $result = $this->db->execute();
            error_log("Add operation result: " . ($result ? "success" : "failed"));
            return $result;
        } catch (Exception $e) {
            error_log("Error in add method: " . $e->getMessage());
            throw $e;
        }
    }

    public function update($data)
    {
        $this->db->query("UPDATE product_statuses SET status = :status WHERE id = :id");
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM product_statuses WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

}
