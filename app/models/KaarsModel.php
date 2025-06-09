<?php
class KaarsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM kaars ORDER BY id ASC");
        return $this->db->fetchAll();
    }

    public function get($id)
    {
        $this->db->query("SELECT * FROM kaars WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->fetch();
    }

    public function add($data)
    {
        try {
            $this->db->query("INSERT INTO kaars (kaar, created_at, updated_at) VALUES (:kaar, NOW(), NOW())");
            $this->db->bind(':kaar', $data['kaar']);
            $result = $this->db->execute();
            return $result;
        } catch (Exception $e) {
            error_log("Error in add method: " . $e->getMessage());
            throw $e;
        }
    }

    public function update($data)
    {
        $this->db->query("UPDATE kaars SET kaar = :kaar, updated_at = NOW() WHERE id = :id");
        $this->db->bind(':kaar', $data['kaar']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM kaars WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

}
