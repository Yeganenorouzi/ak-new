<?php

class Receptions extends Controller
{
    private $receptionsModel;
    private $statusModel;

    public function __construct()
    {
        $this->receptionsModel = $this->model("ReceptionsModel");
        $this->statusModel = $this->model("ReceptionStatusModel");
    }

    /**
     * Check if the current user is an admin
     * @return bool True if the user is an admin, false otherwise
     */
    private function isAdmin()
    {
        // Check if user is logged in and has admin role
        // Adjust this based on how your application stores user roles
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            return true;
        }

        // Alternative check - if your application uses a different session variable
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            return true;
        }

        // If you're using a different approach to identify admins, add it here

        // For development/testing, you can temporarily return true
        // WARNING: Remove this in production
        return true;
    }

    public function index()
    {
        if ($this->isAdmin()) {
            $filters = [];

            // Get filter values from GET request
            if (!empty($_GET['reception_number'])) {
                $filters['reception_number'] = $_GET['reception_number'];
            }
            if (!empty($_GET['serial'])) {
                $filters['serial'] = $_GET['serial'];
            }
            if (!empty($_GET['model'])) {
                $filters['model'] = $_GET['model'];
            }
            if (!empty($_GET['customer_name'])) {
                $filters['customer_name'] = $_GET['customer_name'];
            }
            if (!empty($_GET['codemelli'])) {
                $filters['codemelli'] = $_GET['codemelli'];
            }
            if (!empty($_GET['mobile'])) {
                $filters['mobile'] = $_GET['mobile'];
            }
            if (!empty($_GET['status'])) {
                $filters['status'] = $_GET['status'];
            }
            if (!empty($_GET['date_from'])) {
                $filters['date_from'] = $_GET['date_from'];
            }
            if (!empty($_GET['date_to'])) {
                $filters['date_to'] = $_GET['date_to'];
            }

            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $perPage = 10;

            if (!empty($filters)) {
                $result = $this->receptionsModel->getPaginatedFilteredReceptions($filters, $page, $perPage);
            } else {
                $result = $this->receptionsModel->getPaginatedReceptions($page, $perPage);
            }

            $this->view('admin/receptions/list', [
                'receptions' => $result['receptions'],
                'pagination' => $result['pagination']
            ]);
        } else {
            $this->redirect('dashboard');
        }
    }

    public function admin()
    {
        $filters = [];

        // Get filter values from GET request
        if (!empty($_GET['reception_number'])) {
            $filters['reception_number'] = $_GET['reception_number'];
        }
        if (!empty($_GET['serial'])) {
            $filters['serial'] = $_GET['serial'];
        }
        if (!empty($_GET['model'])) {
            $filters['model'] = $_GET['model'];
        }
        if (!empty($_GET['customer_name'])) {
            $filters['customer_name'] = $_GET['customer_name'];
        }
        if (!empty($_GET['codemelli'])) {
            $filters['codemelli'] = $_GET['codemelli'];
        }
        if (!empty($_GET['mobile'])) {
            $filters['mobile'] = $_GET['mobile'];
        }
        if (!empty($_GET['status'])) {
            $filters['status'] = $_GET['status'];
        }
        if (!empty($_GET['date_from'])) {
            $filters['date_from'] = $_GET['date_from'];
        }
        if (!empty($_GET['date_to'])) {
            $filters['date_to'] = $_GET['date_to'];
        }

        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = 10;

        if (!empty($filters)) {
            $result = $this->receptionsModel->getPaginatedFilteredReceptions($filters, $page, $perPage);
        } else {
            $result = $this->receptionsModel->getPaginatedReceptions($page, $perPage);
        }

        $data = [
            'receptions' => $result['receptions'],
            'pagination' => $result['pagination']
        ];
        return $this->view("admin/receptions/list", $data);
    }

    public function agent()
    {
        $filters = [];

        // Get filter values from GET request
        if (!empty($_GET['reception_number'])) {
            $filters['reception_number'] = $_GET['reception_number'];
        }
        if (!empty($_GET['serial'])) {
            $filters['serial'] = $_GET['serial'];
        }
        if (!empty($_GET['model'])) {
            $filters['model'] = $_GET['model'];
        }
        if (!empty($_GET['customer_name'])) {
            $filters['customer_name'] = $_GET['customer_name'];
        }
        if (!empty($_GET['codemelli'])) {
            $filters['codemelli'] = $_GET['codemelli'];
        }
        if (!empty($_GET['mobile'])) {
            $filters['mobile'] = $_GET['mobile'];
        }
        if (!empty($_GET['status'])) {
            $filters['status'] = $_GET['status'];
        }
        if (!empty($_GET['date_from'])) {
            $filters['date_from'] = $_GET['date_from'];
        }
        if (!empty($_GET['date_to'])) {
            $filters['date_to'] = $_GET['date_to'];
        }

        // Get current page from GET parameter, default to 1
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = 10; // Number of items per page

        // If filters are provided, use the filtered method, otherwise get all receptions
        if (!empty($filters)) {
            $result = $this->receptionsModel->getPaginatedFilteredReceptionsByAgent($filters, $page, $perPage);
        } else {
            $result = $this->receptionsModel->getPaginatedReceptionsByAgent($page, $perPage);
        }

        $data = [
            "receptionsAgent" => $result['receptions'],
            "pagination" => $result['pagination']
        ];

        return $this->view("agent/receptions/list", $data);
    }


    public function create()
    {
        return $this->view("agent/receptions/create");
    }

    // تابع کمکی برای آپلود فایل
    private function uploadFile($file, $index)
    {
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $maxSize = 5 * 1024 * 1024; // 5MB

            if (!in_array($file['type'], $allowedTypes)) {
                return "فقط فایل‌های JPG و PNG مجاز هستند.";
            } elseif ($file['size'] > $maxSize) {
                return "حجم فایل نباید بیشتر از 5 مگابایت باشد.";
            } else {
                $fileName = time() . '_' . $index . '_' . $file['name'];
                $uploadPath = 'uploads/receptions/' . $fileName;

                // Log the absolute path for debugging
                error_log("Upload path: " . realpath(dirname($uploadPath)) . "/" . basename($uploadPath));
                error_log("Current directory: " . getcwd());

                if (!is_dir('uploads/receptions')) {
                    $mkdir_result = mkdir('uploads/receptions', 0777, true);
                    error_log("Creating directory result: " . ($mkdir_result ? 'Success' : 'Failed'));
                    error_log("Directory exists after creation: " . (is_dir('uploads/receptions') ? 'Yes' : 'No'));
                    error_log("Directory permissions: " . substr(sprintf('%o', fileperms('uploads/receptions')), -4));
                }

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    error_log("File successfully uploaded to: " . $uploadPath);
                    return $fileName;
                } else {
                    $error = error_get_last();
                    error_log("Error uploading file: " . ($error ? $error['message'] : 'Unknown error'));
                    error_log("Upload path writable: " . (is_writable(dirname($uploadPath)) ? 'Yes' : 'No'));
                    return "خطا در آپلود فایل.";
                }
            }
        }
        return '';
    }

    /**
     * Handle file uploads for receptions
     * @return array Array containing file information or error
     */
    private function handleFileUploads()
    {
        $result = [
            'file1' => '',
            'file2' => '',
            'file3' => ''
        ];

        // Process each file upload
        if (isset($_FILES['image1']) && $_FILES['image1']['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadResult = $this->uploadFile($_FILES['image1'], 1);
            if (is_string($uploadResult) && strpos($uploadResult, 'خطا') !== false) {
                return ['error' => $uploadResult];
            }
            $result['file1'] = $uploadResult;
        }

        if (isset($_FILES['image2']) && $_FILES['image2']['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadResult = $this->uploadFile($_FILES['image2'], 2);
            if (is_string($uploadResult) && strpos($uploadResult, 'خطا') !== false) {
                return ['error' => $uploadResult];
            }
            $result['file2'] = $uploadResult;
        }

        if (isset($_FILES['image3']) && $_FILES['image3']['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadResult = $this->uploadFile($_FILES['image3'], 3);
            if (is_string($uploadResult) && strpos($uploadResult, 'خطا') !== false) {
                return ['error' => $uploadResult];
            }
            $result['file3'] = $uploadResult;
        }

        return $result;
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = [];

            $serial_id = $this->receptionsModel->getSerialIdBySerial($_POST["serial"]);
            $user_id = $this->receptionsModel->getUserIdByCodeMelli($_SESSION["user_codemelli"]);
            $customer_id = $this->receptionsModel->getCustomerIdByCodeMelli($_POST["codemelli"]);

            // بررسی وجود پذیرش قبلی با وضعیت غیر از تحویل به مشتری
            if ($this->receptionsModel->hasNonDeliveredReception($_POST["serial"])) {
                $errors[] = "برای این سریال پذیرش قبلی با وضعیت غیر از تحویل به مشتری وجود دارد و امکان ثبت پذیرش جدید نیست.";
                $data = [
                    "errors" => $errors,
                    // سایر فیلدهای فرم برای نمایش مجدد
                    "serial" => $_POST["serial"],
                    "name" => $_POST["name"] ?? null,
                    "codemelli" => $_POST["codemelli"] ?? null,
                    "mobile" => $_POST["mobile"] ?? null,
                    "phone" => $_POST["phone"] ?? null,
                    "ostan" => $_POST["ostan"] ?? null,
                    "shahr" => $_POST["shahr"] ?? null,
                    "address" => $_POST["address"] ?? null,
                    "codeposti" => $_POST["codeposti"] ?? null,
                    "repair_status" => $_POST["repair_status"] ?? null,
                    "activation_start_date" => $_POST["activation_start_date"] ?? null,
                    "activation_end_date" => $_POST["activation_status"] ?? null,
                    "activation_day" => $_POST["activation_day"] ?? null,
                    "guarantee_status" => $_POST["guarantee_status"] ?? null,
                    "problem" => $_POST["problem"] ?? null,
                    "situation" => $_POST["situation"] ?? null,
                    "accessories" => isset($_POST['accessories']) ? $_POST['accessories'] : [],
                    "dex" => $_POST["dex"] ?? null,
                    "estimated_time" => $_POST["estimated_time"] ?? null,
                    "estimated_cost" => $_POST["estimated_cost"] ?? null,
                    "paziresh_status" => $_POST["paziresh_status"] ?? null,
                ];
                return $this->view("agent/receptions/create", $data);
            }

            $accessories = isset($_POST['accessories']) ? implode(',', $_POST['accessories']) : '';

            $activation_status = $_POST['activation_status'] ?? null;
            $activation_day = $_POST['activation_day'] ?? null;
            $data = [
                "serial" => $_POST["serial"],
                "serial_id" => $serial_id,
                "user_id" => $user_id,
                "codemelli" => $_POST["codemelli"],
                "customer_id" => $customer_id,
                "name" => $_POST["name"] ?? null,
                "passport" => $_POST["passport"] ?? null,
                "mobile" => $_POST["mobile"] ?? null,
                "phone" => $_POST["phone"] ?? null,
                "ostan" => $_POST["ostan"] ?? null,
                "shahr" => $_POST["shahr"] ?? null,
                "address" => $_POST["address"] ?? null,
                "codeposti" => $_POST["codeposti"] ?? null,
                "repair_status" => $_POST["repair_status"] ?? null,
                "activation_start_date" => $_POST["activation_start_date"] ?? null,
                "activation_end_date" => $_POST["activation_status"] ?? null,
                "activation_day" => $_POST["activation_day"] ?? null,
                "guarantee_status" => $_POST["guarantee_status"] ?? null,
                "problem" => $_POST["problem"] ?? null,
                "situation" => $_POST["situation"] ?? null,
                "accessories" => $accessories,
                "dex" => $_POST["dex"] ?? null,
                "estimated_time" => $_POST["estimated_time"] ?? null,
                "estimated_cost" => $_POST["estimated_cost"] ?? null,
                "paziresh_status" => $_POST["paziresh_status"] ?? null,
                "product_status" => "پذیرش در نمایندگی",
                "file1" => '',
                "file2" => '',
                "file3" => '',
                "activation_status" => $activation_status,
                "created_at" => date('Y-m-d H:i:s')
            ];

            // آپلود فایل‌ها - اصلاح شده
            $fileKeys = ['image1' => 'file1', 'image2' => 'file2', 'image3' => 'file3'];
            foreach ($fileKeys as $uploadKey => $dataKey) {
                if (isset($_FILES[$uploadKey])) {
                    $result = $this->uploadFile($_FILES[$uploadKey], substr($uploadKey, -1));
                    if (strlen($result) > 0 && strpos($result, '.') === false) {
                        $errors[] = $result;
                    } else {
                        $data[$dataKey] = $result;
                    }
                }
            }

            if (empty($errors)) {
                $this->receptionsModel->createReception($data);
                header("Location: " . URLROOT . "/receptions/agent");
                exit();
            } else {
                $data['errors'] = $errors;
                return $this->view("agent/receptions/create", $data);
            }
        }
    }

    public function edit($id)
    {
        $reception = $this->receptionsModel->getReceptionById($id);
        if (!$reception) {
            $_SESSION['reception_message'] = 'پذیرش مورد نظر یافت نشد';
            header("Location: " . URLROOT . "/receptions/admin");
            exit();
        }

        // دریافت وضعیت‌ها از دیتابیس
        $product_statuses = $this->statusModel->getAll();

        $data = [
            "reception" => $reception,
            "product_statuses" => $product_statuses
        ];
        return $this->view("admin/receptions/update", $data);
    }

    private function testDatabaseConnection()
    {
        try {
            $db = new Database();
            $db->query("SELECT 1");
            $db->execute();
            return [
                'success' => true,
                'message' => 'Database connection successful',
                'config' => [
                    'host' => DB__Host,
                    'database' => DB__NAME,
                    'user' => DB__USER
                ]
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Database connection failed: ' . $e->getMessage(),
                'config' => [
                    'host' => DB__Host,
                    'database' => DB__NAME,
                    'user' => DB__USER
                ]
            ];
        }
    }

    public function update()
    {
        // Start output buffering to catch any unwanted output
        ob_start();

        // Set content type to JSON to ensure proper response
        header('Content-Type: application/json');

        try {
            // Check if the request is POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Invalid request method. Only POST is allowed.");
            }

            $id = $_POST['id'] ?? null;
            if (!$id) {
                throw new Exception("شناسه پذیرش نامعتبر است");
            }

            // بررسی وجود پذیرش
            $reception = $this->receptionsModel->getReceptionById($id);
            if (!$reception) {
                throw new Exception("پذیرش مورد نظر یافت نشد");
            }

            // پردازش فایل‌ها
            $files = $this->handleFileUploads();
            if (isset($files['error'])) {
                throw new Exception($files['error']);
            }

            // آماده‌سازی داده‌ها
            $data = [
                'product_status' => $_POST['product_status'] ?? '',
                'kaar' => $_POST['kaar'] ?? '',
                'kaar_serial' => $_POST['kaar_serial'] ?? '',
                'kaar_at' => $_POST['kaar_at'] ?? '',
                'sh_baar2' => $_POST['sh_baar2'] ?? '',
                'sh_baar' => $_POST['sh_baar'] ?? '',
                'file1' => $files['file1'] ?? '',
                'file2' => $files['file2'] ?? '',
                'file3' => $files['file3'] ?? ''
            ];

            // به‌روزرسانی پذیرش
            $result = $this->receptionsModel->updateReception($id, $data);

            if (!$result['success']) {
                throw new Exception($result['error'] ?? "خطا در به‌روزرسانی پذیرش");
            }

            // Clear any output buffers
            ob_clean();

            // پاسخ موفقیت
            echo json_encode([
                'status' => 'success',
                'message' => 'اطلاعات با موفقیت به‌روزرسانی شد',
                'redirect' => URLROOT . '/receptions/show/' . $id,
                'debug' => [
                    'id' => $id,
                    'data' => $data
                ]
            ]);

        } catch (Exception $e) {
            // Clear any output buffers
            ob_clean();

            error_log("Error in Receptions::update: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());

            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
                'debug' => [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]
            ]);
        }

        // End output buffering and flush
        ob_end_flush();
    }




    public function download($filename)
    {
        // بررسی امنیتی - جلوگیری از directory traversal
        $filename = basename($filename); // فقط نام فایل را استخراج می‌کند

        // تعریف مسیرهای ممکن برای فایل
        $possiblePaths = [
            // مسیر لوکال
            dirname(dirname(dirname(__DIR__))) . '/assets/uploads/receptions/' . $filename,
            // مسیر نسبی
            'assets/uploads/receptions/' . $filename,
            // مسیر هاست
            '/home/pfsh/public_html/ak-new/assets/uploads/receptions/' . $filename,
            // مسیر هاست جایگزین
            $_SERVER['DOCUMENT_ROOT'] . '/ak-new/assets/uploads/receptions/' . $filename
        ];

        $file = null;
        foreach ($possiblePaths as $path) {
            error_log("Checking path: " . $path);
            if (file_exists($path) && is_readable($path)) {
                $file = $path;
                error_log("Found file at: " . $path);
                break;
            }
        }

        if (!$file) {
            error_log("File not found in any of the possible paths");
            die('File not found');
        }

        // تنظیم نوع محتوا بر اساس پسوند فایل
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                $content_type = 'image/jpeg';
                break;
            case 'png':
                $content_type = 'image/png';
                break;
            default:
                $content_type = 'application/octet-stream';
        }

        // ارسال هدرها
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $content_type);
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        // خواندن و ارسال فایل
        ob_clean(); // پاک کردن خروجی قبلی
        flush(); // ارسال هدرها
        readfile($file);
        exit;
    }

    public function show($id)
    {
        $data = [
            "reception" => $this->receptionsModel->getReceptionById($id)
        ];

        return $this->view("admin/receptions/read", $data);


    }

    public function print($id)
    {
        $data = [
            "reception" => $this->receptionsModel->getReceptionById($id)
        ];
        return $this->view("agent/receptions/print", $data);
    }
}
