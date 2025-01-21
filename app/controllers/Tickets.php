<?php 

class Tickets extends Controller
{
    private $ticketModel;
    public function __construct()
    {
        $this->ticketModel = $this->model("TicketsModel");
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
         $data = [
             "tickets" => $this->ticketModel->getAllTickets() // دریافت لیست تیکت‌ها (اختیاری)
         ];
         return $this->view("admin/tickets/create", $data);
     }
 
     // ذخیره تیکت جدید
     public function store()
     {
         // بررسی اینکه درخواست POST است
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // گرفتن داده‌های ورودی
             $userId = $_POST['user_id'] ?? null;
             $title = $_POST['title'] ?? null;
 
             // اعتبارسنجی داده‌ها
             if (empty($userId) || empty($title)) {
                 $data = [
                     'error' => 'تمامی فیلدها باید پر شوند!',
                 ];
                 return $this->view('admin/tickets/create', $data);
             }
 
             // ذخیره تیکت در پایگاه داده
             $ticketData = [
                 'user_id' => intval($userId),
                 'title' => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
                 'status' => 0, // مقدار پیش‌فرض: باز
             ];
 
             $result = $this->ticketModel->createTicket($ticketData);
 
             if ($result) {
                 header('Location: /admin/tickets'); // هدایت به لیست تیکت‌ها
                 exit();
             } else {
                 $data = [
                     'error' => 'خطایی در ذخیره تیکت رخ داده است.',
                 ];
                 return $this->view('admin/tickets/create', $data);
             }
         }
 
         // در صورت عدم استفاده از POST، بازگشت به فرم ایجاد
         $this->create();
     }
 
     // نمایش ویو
     private function render($path, $data = [])
     {
         extract($data);
         include __DIR__ . "/../views/$path.php";
     }  
}

