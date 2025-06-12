<?php

use Shuchkin\SimpleXLSX;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Cards extends Controller
{
    private $cardModel;

    public function __construct()
    {
        $this->cardModel = $this->model("CardsModel");
    }

    public function index($page = 1)
    {
        $page = (int) $page;

        $cardsPerPage = 50;

        // بررسی وجود فیلترها در درخواست
        $filters = [];

        // فیلترهای متنی
        if (isset($_GET['serial']) && !empty($_GET['serial'])) {
            $filters['serial'] = $_GET['serial'];
        }

        if (isset($_GET['serial2']) && !empty($_GET['serial2'])) {
            $filters['serial2'] = $_GET['serial2'];
        }

        if (isset($_GET['model']) && !empty($_GET['model'])) {
            $filters['model'] = $_GET['model'];
        }

        if (isset($_GET['company']) && !empty($_GET['company'])) {
            $filters['company'] = $_GET['company'];
        }

        if (isset($_GET['sh_sanad']) && !empty($_GET['sh_sanad'])) {
            $filters['sh_sanad'] = $_GET['sh_sanad'];
        }



        // اگر فیلتری وجود دارد، از متد فیلتر شده استفاده کن
        if (!empty($filters)) {
            $totalCards = $this->cardModel->getTotalFilteredCards($filters);
            $offset = ($page - 1) * $cardsPerPage;
            $cards = $this->cardModel->getFilteredCards($filters, $cardsPerPage, $offset);
        } else {
            // در غیر این صورت از متد معمولی استفاده کن
            $totalCards = $this->cardModel->getTotalCards();
            $offset = ($page - 1) * $cardsPerPage;
            $cards = $this->cardModel->getPaginatedCards($cardsPerPage, $offset);
        }

        $totalPages = ceil($totalCards / $cardsPerPage);

        // اطمینان از اینکه شماره صفحه معتبر است
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages && $totalPages > 0) {
            $page = $totalPages;
        }

        $data = [
            "cards" => $cards,
            "currentPage" => $page,
            "totalPages" => $totalPages,
            "filters" => $filters // ارسال فیلترها به ویو
        ];

        return $this->view("admin/cards/list", $data);
    }

    // متد جدید برای اعمال فیلترها
    public function applyFilters()
    {
        // این متد برای درخواست‌های AJAX استفاده می‌شود
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filters = [];

            // فیلترهای متنی
            if (isset($_POST['serial']) && !empty($_POST['serial'])) {
                $filters['serial'] = $_POST['serial'];
            }

            if (isset($_POST['serial2']) && !empty($_POST['serial2'])) {
                $filters['serial2'] = $_POST['serial2'];
            }

            if (isset($_POST['model']) && !empty($_POST['model'])) {
                $filters['model'] = $_POST['model'];
            }

            if (isset($_POST['company']) && !empty($_POST['company'])) {
                $filters['company'] = $_POST['company'];
            }

            if (isset($_POST['sh_sanad']) && !empty($_POST['sh_sanad'])) {
                $filters['sh_sanad'] = $_POST['sh_sanad'];
            }

            // فیلترهای تاریخ
            if (isset($_POST['start_guarantee_from']) && !empty($_POST['start_guarantee_from'])) {
                $filters['start_guarantee_from'] = $_POST['start_guarantee_from'];
            }

            if (isset($_POST['start_guarantee_to']) && !empty($_POST['start_guarantee_to'])) {
                $filters['start_guarantee_to'] = $_POST['start_guarantee_to'];
            }

            if (isset($_POST['expite_guarantee_from']) && !empty($_POST['expite_guarantee_from'])) {
                $filters['expite_guarantee_from'] = $_POST['expite_guarantee_from'];
            }

            if (isset($_POST['expite_guarantee_to']) && !empty($_POST['expite_guarantee_to'])) {
                $filters['expite_guarantee_to'] = $_POST['expite_guarantee_to'];
            }

            // فیلتر وضعیت گارانتی
            if (isset($_POST['guarantee_status']) && !empty($_POST['guarantee_status'])) {
                $filters['guarantee_status'] = $_POST['guarantee_status'];
            }

            // ساخت URL با پارامترهای فیلتر
            $url = URLROOT . '/cards/index/1?';
            $params = [];

            foreach ($filters as $key => $value) {
                $params[] = $key . '=' . urlencode($value);
            }

            $url .= implode('&', $params);

            // بازگشت به صفحه لیست با فیلترهای اعمال شده
            header("Location: " . $url);
            exit();
        }

        // اگر درخواست POST نباشد، به صفحه اصلی هدایت کن
        header("Location: " . URLROOT . "/cards/index");
        exit();
    }

    public function searchOrCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $serial = $_POST['serial'];

            $card = $this->cardModel->getCardBySerial($serial);

            if ($card) {
                echo json_encode([
                    'status' => 'found',
                    'data' => $card
                ]);
            } else {
                // If card not found, create a new one with pending approval
                $cardData = [
                    'serial' => $serial,
                    'model' => $_POST['model'] ?? '',
                    'title' => $_POST['title'] ?? '',
                    'serial2' => $_POST['serial2'] ?? '',
                    'company' => $_POST['company'] ?? '',
                    'sh_sanad' => $_POST['sh_sanad'] ?? '',
                    'start_guarantee' => $_POST['start_guarantee'] ?? '',
                    'expite_guarantee' => $_POST['expite_guarantee'] ?? '',
                    'att1_code' => $_POST['att1_code'] ?? '',
                    'att2_code' => $_POST['att2_code'] ?? '',
                    'att3_code' => $_POST['att3_code'] ?? '',
                    'att4_code' => $_POST['att4_code'] ?? '',
                    'approved' => 0, // Set as pending approval
                    'is_import' => 0,
                    'added_by_user' => $_SESSION['user_id'] ?? 0,
                    'did' => 0
                ];

                try {
                    if ($this->cardModel->createCard($cardData)) {
                        echo json_encode([
                            'status' => 'created',
                            'message' => 'کارت گارانتی با موفقیت ایجاد شد و در انتظار تایید است',
                            'data' => $cardData
                        ]);
                    } else {
                        throw new Exception('خطا در ایجاد کارت گارانتی');
                    }
                } catch (Exception $e) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]);
                }
            }
        }
    }

    public function create()
    {
        $data = [
            'data' => [],
            'errors' => [],
            'success' => false,
            'message' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cardData = [
                'code_dastgah' => trim($_POST['code_dastgah'] ?? ''),
                'title' => trim($_POST['title'] ?? ''),
                'coding_derakhtvare' => trim($_POST['coding_derakhtvare'] ?? ''),
                'model' => trim($_POST['model'] ?? ''),
                'att1_code' => trim($_POST['att1_code'] ?? ''),
                'att1_val' => trim($_POST['att1_val'] ?? ''),
                'att2_code' => trim($_POST['att2_code'] ?? ''),
                'att2_val' => trim($_POST['att2_val'] ?? ''),
                'att3_code' => trim($_POST['att3_code'] ?? ''),
                'att3_val' => trim($_POST['att3_val'] ?? ''),
                'att4_code' => trim($_POST['att4_code'] ?? ''),
                'att4_val' => trim($_POST['att4_val'] ?? ''),
                'serial' => trim($_POST['serial'] ?? ''),
                'serial2' => trim($_POST['serial2'] ?? ''),
                'company' => trim($_POST['company'] ?? ''),
                'sh_sanad' => trim($_POST['sh_sanad'] ?? ''),
                'code_guarantee' => trim($_POST['code_guarantee'] ?? ''),
                'sharh_guarantee' => trim($_POST['sharh_guarantee'] ?? ''),
                'code_agent_service' => trim($_POST['code_agent_service'] ?? ''),
                'agent_service' => trim($_POST['agent_service'] ?? ''),
                'start_guarantee' => trim($_POST['start_guarantee'] ?? ''),
                'expite_guarantee' => trim($_POST['expite_guarantee'] ?? ''),
                'is_import' => 0,
                'added_by_user' => 0,
                'approved' => 1,
                'did' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (empty($cardData['serial'])) {
                $data['errors'][] = 'سریال نمی‌تواند خالی باشد';
            }

            if (empty($data['errors'])) {
                try {
                    if ($this->cardModel->createCard($cardData)) {
                        $data['success'] = true;
                        $data['message'] = 'کارت گارانتی با موفقیت افزوده شد';
                        $data['data'] = []; // Clear form data after successful submission
                    } else {
                        throw new Exception('خطا در ثبت کارت');
                    }
                } catch (Exception $e) {
                    $data['errors'][] = $e->getMessage();
                    $data['data'] = $cardData;
                }
            } else {
                $data['data'] = $cardData;
            }
        }

        $this->view('admin/cards/create', $data);
    }

    public function import()
    {
        $data = [
            'success' => false,
            'message' => '',
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
                $data['errors'][] = 'لطفاً یک فایل اکسل انتخاب کنید.';
                $this->view('admin/cards/import', $data);
                return;
            }

            $file = $_FILES['excel_file'];
            $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

            if (!in_array($file['type'], $allowedTypes)) {
                $data['errors'][] = 'لطفاً یک فایل اکسل معتبر انتخاب کنید.';
                $this->view('admin/cards/import', $data);
                return;
            }

            // تغییر مسیر اتولود
            // require_once APPROOT . '/vendor/autoload.php';

            try {
                $spreadsheet = IOFactory::load($file['tmp_name']);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                array_shift($rows); // Remove header row

                $successCount = 0;
                $errorCount = 0;

                foreach ($rows as $row) {
                    if (empty($row[0]))
                        continue; // Skip empty rows

                    // تبدیل تاریخ‌ها به فرمت مناسب
                    $start_guarantee = '';
                    $expite_guarantee = '';

                    // تبدیل تاریخ شروع
                    if (!empty($row[20])) {
                        try {
                            // اگر تاریخ در اکسل به فرمت میلادی باشد
                            if (strpos($row[20], '/') !== false) {
                                // تبدیل تاریخ شمسی به میلادی
                                $date_parts = explode('/', $row[20]);
                                if (count($date_parts) == 3) {
                                    $start_guarantee = $date_parts[0] . '/' .
                                        str_pad($date_parts[1], 2, '0', STR_PAD_LEFT) . '/' .
                                        str_pad($date_parts[2], 2, '0', STR_PAD_LEFT);
                                }
                            } else {
                                // اگر تاریخ به فرمت اکسل باشد
                                $UNIX_DATE = ($row[20] - 25569) * 86400;
                                $start_guarantee = date('Y/m/d', $UNIX_DATE);
                            }
                        } catch (Exception $e) {
                            $start_guarantee = '';
                        }
                    }

                    // تبدیل تاریخ پایان
                    if (!empty($row[21])) {
                        try {
                            if (strpos($row[21], '/') !== false) {
                                $date_parts = explode('/', $row[21]);
                                if (count($date_parts) == 3) {
                                    $expite_guarantee = $date_parts[0] . '/' .
                                        str_pad($date_parts[1], 2, '0', STR_PAD_LEFT) . '/' .
                                        str_pad($date_parts[2], 2, '0', STR_PAD_LEFT);
                                }
                            } else {
                                $UNIX_DATE = ($row[21] - 25569) * 86400;
                                $expite_guarantee = date('Y/m/d', $UNIX_DATE);
                            }
                        } catch (Exception $e) {
                            $expite_guarantee = '';
                        }
                    }

                    $cardData = [
                        'serial' => trim($row[0] ?? ''),
                        'serial2' => trim($row[1] ?? ''),
                        'company' => trim($row[2] ?? ''),
                        'sh_sanad' => trim($row[3] ?? ''),
                        'code_dastgah' => trim($row[4] ?? ''),
                        'title' => trim($row[5] ?? ''),
                        'coding_derakhtvare' => trim($row[6] ?? ''),
                        'model' => trim($row[7] ?? ''),
                        'att1_code' => trim($row[8] ?? ''),
                        'att1_val' => trim($row[9] ?? ''),
                        'att2_code' => trim($row[10] ?? ''),
                        'att2_val' => trim($row[11] ?? ''),
                        'att3_code' => trim($row[12] ?? ''),
                        'att3_val' => trim($row[13] ?? ''),
                        'att4_code' => trim($row[14] ?? ''),
                        'att4_val' => trim($row[15] ?? ''),
                        'code_guarantee' => trim($row[16] ?? ''),
                        'sharh_guarantee' => trim($row[17] ?? ''),
                        'code_agent_service' => trim($row[18] ?? ''),
                        'agent_service' => trim($row[19] ?? ''),
                        'start_guarantee' => $start_guarantee,
                        'expite_guarantee' => $expite_guarantee
                    ];

                    try {
                        if ($this->cardModel->createCard($cardData)) {
                            $successCount++;
                        }
                    } catch (Exception $e) {
                        $errorCount++;
                        $data['errors'][] = "خطا در ردیف {$row[0]}: " . $e->getMessage();
                    }
                }

                $data['success'] = true;
                $data['message'] = "وارد کردن با موفقیت انجام شد. {$successCount} کارت اضافه شد.";
                if ($errorCount > 0) {
                    $data['message'] .= " {$errorCount} کارت با خطا مواجه شد.";
                }

            } catch (Exception $e) {
                $data['errors'][] = 'خطا در پردازش فایل اکسل: ' . $e->getMessage();
            }
        }

        $this->view('admin/cards/import', $data);
    }

    public function update($id = null)
    {
        if ($id === null) {
            header("Location: " . URLROOT . "/cards/index");
            exit();
        }

        $card = $this->cardModel->getCardById($id);

        if (!$card) {
            header("Location: " . URLROOT . "/cards/index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cardData = [
                'code_dastgah' => trim($_POST['code_dastgah'] ?? ''),
                'title' => trim($_POST['title'] ?? ''),
                'coding_derakhtvare' => trim($_POST['coding_derakhtvare'] ?? ''),
                'model' => trim($_POST['model'] ?? ''),
                'att1_code' => trim($_POST['att1_code'] ?? ''),
                'att1_val' => trim($_POST['att1_val'] ?? ''),
                'att2_code' => trim($_POST['att2_code'] ?? ''),
                'att2_val' => trim($_POST['att2_val'] ?? ''),
                'att3_code' => trim($_POST['att3_code'] ?? ''),
                'att3_val' => trim($_POST['att3_val'] ?? ''),
                'att4_code' => trim($_POST['att4_code'] ?? ''),
                'att4_val' => trim($_POST['att4_val'] ?? ''),
                'serial' => trim($_POST['serial'] ?? ''),
                'serial2' => trim($_POST['serial2'] ?? ''),
                'company' => trim($_POST['company'] ?? ''),
                'sh_sanad' => trim($_POST['sh_sanad'] ?? ''),
                'code_guarantee' => trim($_POST['code_guarantee'] ?? ''),
                'sharh_guarantee' => trim($_POST['sharh_guarantee'] ?? ''),
                'code_agent_service' => trim($_POST['code_agent_service'] ?? ''),
                'agent_service' => trim($_POST['agent_service'] ?? ''),
                'start_guarantee' => trim($_POST['start_guarantee'] ?? ''),
                'expite_guarantee' => trim($_POST['expite_guarantee'] ?? '')
            ];

            try {
                $this->cardModel->updateCard($id, $cardData);
                header("Location: " . URLROOT . "/cards/index");
                exit();
            } catch (Exception $e) {
                $data = [
                    'card' => $cardData,
                    'errors' => [$e->getMessage()]
                ];
                $this->view('admin/cards/update', $data);
            }
        } else {
            $data = [
                'card' => $card,
                'errors' => []
            ];
            $this->view('admin/cards/update', $data);
        }
    }

    public function delete($id = null)
    {
        if ($id === null) {
            header("Location: " . URLROOT . "/cards/index");
            exit();
        }

        $this->cardModel->deleteCard($id);
        header("Location: " . URLROOT . "/cards/index");
        exit();
    }

    public function approve()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cardId = $_POST['card_id'] ?? null;

            if (!$cardId) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'شناسه کارت گارانتی نامعتبر است'
                ]);
                return;
            }

            try {
                $this->cardModel->approveCard($cardId);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'کارت گارانتی با موفقیت تایید شد'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'درخواست نامعتبر'
            ]);
        }
    }

    public function reject()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cardId = $_POST['card_id'] ?? null;

            if (!$cardId) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'شناسه کارت گارانتی نامعتبر است'
                ]);
                return;
            }

            try {
                $this->cardModel->rejectCard($cardId);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'تایید کارت گارانتی با موفقیت لغو شد'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'درخواست نامعتبر'
            ]);
        }
    }
}
