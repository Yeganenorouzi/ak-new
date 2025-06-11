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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agent_id'])) {
            $agentId = (int) $_POST['agent_id'];

            if ($this->adminModel->approveAgent($agentId)) {
                echo json_encode(['success' => true, 'message' => 'نماینده با موفقیت تایید شد']);
            } else {
                echo json_encode(['success' => false, 'message' => 'خطا در تایید نماینده']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'درخواست نامعتبر']);
        }
        exit();
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