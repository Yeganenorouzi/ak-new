<?php

class Tickets extends Controller
{
    private $ticketModel;
    private $usersModel;
    public function __construct()
    {
        $this->ticketModel = $this->model("TicketsModel");
        $this->usersModel = $this->model("UsersModel");
    }

    public function index()
    {
        $data = [
            "tickets" => $this->ticketModel->getAllTickets()
        ];
        return $this->view("admin/tickets/list", $data);
    }

    // نمایش فرم ایجاد تیکت
    public function create()
    {
        $users = $this->usersModel->getAllUsers();

        $data = [
            
            'users' => $users,
            'data' => []
        ];

        return $this->view("admin/tickets/create", $data);
    }

    // ذخیره تیکت جدید
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            $title = $_POST['title'] ?? null;
            $message = $_POST['message'] ?? null;

            if (empty($userId) || empty($title) || empty($message)) {
                $data = [
                    'error' => 'تمامی فیلدها باید پر شوند!',
                ];
                return $this->view('admin/tickets/create', $data);
            }

            // Insert into tickets table
            $ticketData = [
                'user_id' => $userId,
                'title' => $title,
                'status' => 0,
            ];

            $ticketId = $this->ticketModel->createTicket($ticketData);

            if ($ticketId) {
                // Insert into ticket messages table
                $messageData = [
                    'ticket_id' => $ticketId,
                    'message' => $message,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $messageResult = $this->ticketModel->createTicketMessage($messageData);

                if ($messageResult) {
                    header('Location: /admin/tickets');
                    exit();
                } else {
                    $data = [
                        'error' => 'خطایی در ذخیره پیام تیکت رخ داده است.',
                    ];
                    return $this->view('admin/tickets/create', $data);
                }
            } else {
                $data = [
                    'error' => 'خطایی در ذخیره تیکت رخ داده است.',
                ];
                return $this->view('admin/tickets/create', $data);
            }
        }

        $this->create();
    }

    // نمایش ویو
    private function render($path, $data = [])
    {
        extract($data);
        include __DIR__ . "/../views/$path.php";
    }
}
