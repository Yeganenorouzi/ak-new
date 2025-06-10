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

    // نمایش لیست تیکت‌ها برای ادمین
    public function admin()
    {
        $ticketsModel = $this->model('TicketsModel');

        // تنظیمات پیجینیشن
        $per_page = 10;
        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        // فیلترها
        $filters = [
            'ticket_number' => $_GET['ticket_number'] ?? '',
            'status' => $_GET['status'] ?? '',
            'priority' => $_GET['priority'] ?? ''
        ];

        // دریافت تعداد کل تیکت‌ها با فیلتر
        $total_tickets = $ticketsModel->getTotalTickets($filters);
        $total_pages = ceil($total_tickets / $per_page);

        // دریافت تیکت‌های صفحه جاری
        $tickets = $ticketsModel->getPaginatedTickets($current_page, $per_page, $filters);

        $data = [
            'tickets' => $tickets,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'filters' => $filters
        ];

        $this->view('admin/tickets/list', $data);
    }

    // نمایش لیست تیکت‌ها برای کارشناس
    public function agent()
    {
        $ticketsModel = $this->model('TicketsModel');

        // تنظیمات پیجینیشن
        $per_page = 10;
        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        // فیلترها
        $filters = [
            'ticket_number' => $_GET['ticket_number'] ?? '',
            'status' => $_GET['status'] ?? '',
            'priority' => $_GET['priority'] ?? ''
        ];

        // دریافت تعداد کل تیکت‌های نماینده
        $total_tickets = $this->ticketModel->getTotalTicketsByAgent($_SESSION['id'], $filters);
        $total_pages = ceil($total_tickets / $per_page);

        // دریافت تیکت‌های صفحه جاری
        $tickets = $this->ticketModel->getTicketsByAgent($_SESSION['id'], $filters, $current_page, $per_page);

        $data = [
            "tickets" => $tickets,
            "current_page" => $current_page,
            "total_pages" => $total_pages,
            "filters" => $filters
        ];

        return $this->view("agent/tickets/list", $data);
    }

    // نمایش فرم ایجاد تیکت
    public function create()
    {
        if ($_SESSION['is_admin'] == 1) {
            // برای ادمین‌ها همه کاربران نمایش داده می‌شود
            $allUsers = $this->usersModel->getUsers();
            // فیلتر کردن کاربر لاگین شده از لیست
            $users = array_filter($allUsers, function ($user) {
                return $user->id != $_SESSION['id'];
            });
        } else {
            // برای نمایندگان فقط ادمین‌ها نمایش داده می‌شود
            $users = $this->usersModel->getAllUsers();
        }

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
            try {
                // تولید شماره تیکت
                $ticketNumber = 'TKT-' . rand(1000, 9999);

                $ticketData = [
                    'ticket_number' => $ticketNumber,
                    'subject' => $_POST['subject'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'status' => 'open',
                    'priority' => $_POST['priority'] ?? 'medium',
                    'created_by' => $_SESSION['id'],
                    'assigned_to' => $_POST['assigned_to'] ?? null,
                    'department' => $_POST['department'] ?? null,
                    'attach' => null
                ];

                // اعتبارسنجی داده‌ها
                if (empty($ticketData['subject']) || empty($ticketData['description'])) {
                    $data = [
                        'error' => 'موضوع و توضیحات تیکت الزامی است!',
                        'data' => $ticketData,
                        'users' => $this->usersModel->getAllUsers()
                    ];
                    return $this->view('admin/tickets/create', $data);
                }

                // آپلود فایل پیوست برای تیکت
                if (isset($_FILES['attach']) && $_FILES['attach']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = 'uploads/tickets/';

                    // ایجاد دایرکتوری با دسترسی مناسب
                    if (!file_exists($uploadDir)) {
                        if (!mkdir($uploadDir, 0755, true)) {
                            throw new Exception('خطا در ایجاد دایرکتوری آپلود');
                        }
                    }

                    // بررسی دسترسی نوشتن در دایرکتوری
                    if (!is_writable($uploadDir)) {
                        throw new Exception('دایرکتوری آپلود قابل نوشتن نیست');
                    }

                    $fileName = time() . '_' . basename($_FILES['attach']['name']);
                    $uploadFile = $uploadDir . $fileName;

                    if (!move_uploaded_file($_FILES['attach']['tmp_name'], $uploadFile)) {
                        throw new Exception('خطا در آپلود فایل');
                    }

                    $ticketData['attach'] = $uploadFile;
                }

                // ذخیره تیکت
                $ticketId = $this->ticketModel->createTicket($ticketData);

                if (!$ticketId) {
                    throw new Exception('خطا در ذخیره تیکت');
                }

                // ذخیره پیام اول تیکت
                $messageData = [
                    'ticket_id' => $ticketId,
                    'sender' => $_SESSION['id'],
                    'dex' => $ticketData['description'],
                    'attach' => $ticketData['attach']
                ];

                if (!$this->ticketModel->createTicketMessage($messageData)) {
                    throw new Exception('خطا در ذخیره پیام تیکت');
                }

                // Redirect based on user role
                if ($_SESSION['is_admin'] == 1) {
                    header('Location: ' . URLROOT . '/tickets/admin');
                } else {
                    header('Location: ' . URLROOT . '/tickets/agent');
                }
                exit();

            } catch (Exception $e) {
                // لاگ کردن خطا
                error_log('Ticket creation error: ' . $e->getMessage());

                $data = [
                    'error' => 'خطایی در ایجاد تیکت رخ داده است: ' . $e->getMessage(),
                    'data' => $ticketData ?? [],
                    'users' => $this->usersModel->getAllUsers()
                ];
                return $this->view('admin/tickets/create', $data);
            }
        }

        $this->create();
    }

    // نمایش جزئیات تیکت
    public function show($id)
    {
        $ticket = $this->ticketModel->getTicketById($id);
        $messages = $this->ticketModel->getTicketMessages($id);

        $data = [
            'ticket' => $ticket,
            'messages' => $messages
        ];

        return $this->view("admin/tickets/show", $data);
    }

    // پاسخ به تیکت
    public function reply($id)
    {
        $ticket = $this->ticketModel->getTicketById($id);

        // بررسی مجوز پاسخ دادن
        if ($_SESSION['id'] != $ticket->created_by && $_SESSION['id'] != $ticket->assigned_to) {
            $data = [
                'error' => 'شما مجاز به پاسخ دادن به این تیکت نیستید.',
                'ticket' => $ticket,
                'messages' => $this->ticketModel->getTicketMessages($id)
            ];
            return $this->view("admin/tickets/show", $data);
        }

        // بررسی وضعیت تیکت
        if ($ticket->status === 'closed') {
            $data = [
                'error' => 'این تیکت بسته شده است و امکان پاسخ دادن وجود ندارد.',
                'ticket' => $ticket,
                'messages' => $this->ticketModel->getTicketMessages($id)
            ];
            return $this->view("admin/tickets/show", $data);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $messageData = [
                'ticket_id' => $id,
                'sender' => $_SESSION['id'],
                'dex' => $_POST['message'] ?? null,
                'attach' => null
            ];

            // آپلود فایل پیوست
            if (isset($_FILES['attach']) && $_FILES['attach']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/tickets/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . $_FILES['attach']['name'];
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['attach']['tmp_name'], $uploadFile)) {
                    $messageData['attach'] = $uploadFile;
                }
            }

            if ($this->ticketModel->createTicketMessage($messageData)) {
                header("Location: " . URLROOT . "/tickets/show/$id");
                exit();
            }
        }

        $this->show($id);
    }

    // بروزرسانی وضعیت تیکت
    public function updateStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? null;

            if ($this->ticketModel->updateTicketStatus($id, $status)) {
                header("Location: " . URLROOT . "/tickets/show/$id");
                exit();
            }
        }

        $this->show($id);
    }

    // بروزرسانی اولویت تیکت
    public function updatePriority($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $priority = $_POST['priority'] ?? null;

            if ($this->ticketModel->updateTicketPriority($id, $priority)) {
                header("Location: " . URLROOT . "/tickets/show/$id");
                exit();
            }
        }

        $this->show($id);
    }

    // اختصاص تیکت به کاربر
    public function assign($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;

            if ($this->ticketModel->assignTicket($id, $userId)) {
                header("Location: " . URLROOT . "/tickets/show/$id");
                exit();
            }
        }

        $this->show($id);
    }
}
