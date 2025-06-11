<?php

class AdminModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all pending agents (approved = 0)
    public function getPendingAgents()
    {
        $this->db->query("SELECT * FROM users WHERE agent = 'نماینده' AND approved = 0 ORDER BY created_at DESC");
        return $this->db->fetchAll();
    }

    // Get all approved agents (approved = 1)
    public function getApprovedAgents()
    {
        $this->db->query("SELECT * FROM users WHERE agent = 'نماینده' AND approved = 1 ORDER BY created_at DESC");
        return $this->db->fetchAll();
    }

    // Get all agents
    public function getAllAgents()
    {
        $this->db->query("SELECT * FROM users WHERE agent = 'نماینده' ORDER BY approved ASC, created_at DESC");
        return $this->db->fetchAll();
    }

    // Approve an agent
    public function approveAgent($agentId)
    {
        error_log("AdminModel::approveAgent - Starting approval for agent ID: " . $agentId);

        try {
            // First check if the agent exists
            $this->db->query("SELECT id, approved FROM users WHERE id = :id AND admin = 0");
            $this->db->bind(':id', $agentId);
            $agent = $this->db->fetch();

            if (!$agent) {
                error_log("Agent not found or is not an agent: " . $agentId);
                return false;
            }

            error_log("Current agent status - ID: " . $agentId . ", Approved: " . $agent->approved);

            // Update the agent's approved status
            $this->db->query("UPDATE users SET approved = 1 WHERE id = :id");
            $this->db->bind(':id', $agentId);

            $result = $this->db->execute();
            error_log("Update query executed. Result: " . ($result ? "success" : "failed"));

            if ($result) {
                error_log("Successfully approved agent ID: " . $agentId);
                return true;
            } else {
                error_log("Failed to approve agent ID: " . $agentId);
                return false;
            }
        } catch (Exception $e) {
            error_log("Exception in approveAgent: " . $e->getMessage());
            throw $e;
        }
    }

    // Reject/Disapprove an agent
    public function rejectAgent($agentId)
    {
        try {
            $this->db->query("UPDATE users SET approved = 0 WHERE id = :id AND agent = 'نماینده'");
            $this->db->bind(':id', $agentId);
            return $this->db->execute();
        } catch (Exception $e) {
            error_log("Error rejecting agent: " . $e->getMessage());
            return false;
        }
    }

    // Delete an agent
    public function deleteAgent($agentId)
    {
        try {
            $this->db->query("DELETE FROM users WHERE id = :id AND agent = 'نماینده'");
            $this->db->bind(':id', $agentId);
            return $this->db->execute();
        } catch (Exception $e) {
            error_log("Error deleting agent: " . $e->getMessage());
            return false;
        }
    }

    // Get agent by ID
    public function getAgentById($agentId)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id AND agent = 'نماینده'");
        $this->db->bind(':id', $agentId);
        return $this->db->fetch();
    }

    // Get dashboard stats
    public function getDashboardStats()
    {
        // Total agents
        $this->db->query("SELECT COUNT(*) as total FROM users WHERE agent = 'نماینده'");
        $totalAgents = $this->db->fetch()->total;

        // Pending agents
        $this->db->query("SELECT COUNT(*) as pending FROM users WHERE agent = 'نماینده' AND approved = 0");
        $pendingAgents = $this->db->fetch()->pending;

        // Approved agents
        $this->db->query("SELECT COUNT(*) as approved FROM users WHERE agent = 'نماینده' AND approved = 1");
        $approvedAgents = $this->db->fetch()->approved;

        return [
            'total' => $totalAgents,
            'pending' => $pendingAgents,
            'approved' => $approvedAgents
        ];
    }
}