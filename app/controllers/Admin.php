<?php

class Admin extends Controller
{
    private $adminModel;

    public function __construct()
    {
        // Check if user is admin
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header('Location: ' . URLROOT . '/auth/login');
            exit();
        }
        $this->adminModel = $this->model('AdminModel');
    }

    // Admin dashboard
    public function index()
    {
        $stats = $this->adminModel->getDashboardStats();
        $pendingAgents = $this->adminModel->getPendingAgents();

        $data = [
            'stats' => $stats,
            'pendingAgents' => $pendingAgents,
            'title' => 'داشبورد ادمین'
        ];

        $this->view('admin/dashboard', $data);
    }

    // Agents management page
    public function agents()
    {
        $agents = $this->adminModel->getAllAgents();

        $data = [
            'agents' => $agents,
            'title' => 'مدیریت نمایندگان'
        ];

        $this->view('admin/agents', $data);
    }

    // Approve agent
    public function approveAgent()
    {
        error_log("Admin::approveAgent - Request received");
        error_log("POST data: " . print_r($_POST, true));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $agentId = $_POST['agent_id'];
            error_log("Attempting to approve agent ID: " . $agentId);

            try {
                if ($this->adminModel->approveAgent($agentId)) {
                    error_log("Agent approval successful for ID: " . $agentId);
                    echo json_encode(['success' => true, 'message' => 'نماینده با موفقیت تایید شد']);
                } else {
                    error_log("Agent approval failed for ID: " . $agentId);
                    echo json_encode(['success' => false, 'message' => 'خطا در تایید نماینده']);
                }
            } catch (Exception $e) {
                error_log("Exception in approveAgent: " . $e->getMessage());
                echo json_encode(['success' => false, 'message' => 'خطا در تایید نماینده: ' . $e->getMessage()]);
            }
        } else {
            error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
            echo json_encode(['success' => false, 'message' => 'درخواست نامعتبر']);
        }
    }

    // Reject agent
    public function rejectAgent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agent_id'])) {
            $agentId = (int) $_POST['agent_id'];

            if ($this->adminModel->rejectAgent($agentId)) {
                echo json_encode(['success' => true, 'message' => 'تایید نماینده لغو شد']);
            } else {
                echo json_encode(['success' => false, 'message' => 'خطا در لغو تایید نماینده']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'درخواست نامعتبر']);
        }
        exit();
    }

    // Delete agent
    public function deleteAgent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agent_id'])) {
            $agentId = (int) $_POST['agent_id'];

            if ($this->adminModel->deleteAgent($agentId)) {
                echo json_encode(['success' => true, 'message' => 'نماینده با موفقیت حذف شد']);
            } else {
                echo json_encode(['success' => false, 'message' => 'خطا در حذف نماینده']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'درخواست نامعتبر']);
        }
        exit();
    }

    // View agent details
    public function viewAgent($agentId = null)
    {
        if (!$agentId) {
            header('Location: ' . URLROOT . '/admin/agents');
            exit();
        }

        $agent = $this->adminModel->getAgentById($agentId);

        if (!$agent) {
            header('Location: ' . URLROOT . '/admin/agents');
            exit();
        }

        $data = [
            'agent' => $agent,
            'title' => 'جزئیات نماینده - ' . $agent->name
        ];

        $this->view('admin/agent-details', $data);
    }
}