<?php

class Receptions extends Controller
{
    private $receptionsModel;
    public function __construct()
    {
        $this->receptionsModel = $this->model("ReceptionsModel");
    }

    public function admin()
    {
        $data = [
            "receptions" => $this->receptionsModel->getAllReceptions()
        ];
        return $this->view("admin/receptions/list", $data);
    }

    public function agent()
    {
        $data = [
            "receptionsAgent" => $this->receptionsModel->getAllReceptionsByAgent()
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

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = [];

            $serial_id = $this->receptionsModel->getSerialIdBySerial($_POST["serial"]);
            $user_id = $this->receptionsModel->getUserIdByCodeMelli($_SESSION["user_codemelli"]);
            $customer_id = $this->receptionsModel->getCustomerIdByCodeMelli($_POST["codemelli"]);

            $accessories = isset($_POST['accessories']) ? implode(',', $_POST['accessories']) : '';


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
                "activation_start_date" => $_POST["activation_start_date"],
                "guarantee_status" => $_POST["guarantee_status"],
                "problem" => $_POST["problem"],
                "situation" => $_POST["situation"],
                "accessories" => $accessories,
                "dex" => $_POST["dex"],
                "estimated_time" => $_POST["estimated_time"],
                "estimated_cost" => $_POST["estimated_cost"],
                "paziresh_status" => $_POST["paziresh_status"],
                "product_status" => "پذیرش در نمایندگی",
                "file1" => '',
                "file2" => '',
                "file3" => '',
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

        $data = [
            "reception" => $reception
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

    public function update($id)
    {
        // Test database connection first
        $dbTest = $this->testDatabaseConnection();
        if (!$dbTest['success']) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Database connection failed',
                'debug_info' => $dbTest
            ]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $currentReception = $this->receptionsModel->getReceptionById($id);
                if (!$currentReception) {
                    throw new Exception('Reception not found');
                }

                $data = [
                    'id' => $id,
                    'product_status' => trim($_POST['product_status'] ?? ''),
                    'sh_baar' => trim($_POST['sh_baar'] ?? ''),
                    'sh_baar2' => trim($_POST['sh_baar2'] ?? ''),
                    'kaar' => trim($_POST['kaar'] ?? ''),
                    'kaar_serial' => trim($_POST['kaar_serial'] ?? ''),
                    'kaar_at' => trim($_POST['kaar_at'] ?? ''),
                    'file1' => $currentReception->file1,
                    'file2' => $currentReception->file2,
                    'file3' => $currentReception->file3,
                ];

                $errors = [];
                $debug_info = []; // Add debug information array

                $fileKeys = ['image1' => 'file1', 'image2' => 'file2', 'image3' => 'file3'];
                foreach ($fileKeys as $uploadKey => $dataKey) {
                    if (isset($_FILES[$uploadKey]) && $_FILES[$uploadKey]['error'] === UPLOAD_ERR_OK) {
                        $debug_info[] = "Processing file: " . $uploadKey;
                        
                        if (!empty($currentReception->$dataKey)) {
                            $oldFilePath = 'uploads/receptions/' . $currentReception->$dataKey;
                            $debug_info[] = "Old file path: " . $oldFilePath;
                            $debug_info[] = "File exists: " . (file_exists($oldFilePath) ? 'Yes' : 'No');
                            
                            if (file_exists($oldFilePath)) {
                                $unlink_result = unlink($oldFilePath);
                                $debug_info[] = "Unlink result: " . ($unlink_result ? 'Success' : 'Failed');
                            }
                        }
                        
                        $result = $this->uploadFile($_FILES[$uploadKey], substr($uploadKey, -1));
                        $debug_info[] = "Upload result for " . $uploadKey . ": " . $result;
                        
                        if (strlen($result) > 0 && strpos($result, '.') === false) {
                            $errors[] = $result;
                        } else {
                            $data[$dataKey] = $result;
                        }
                    } else if (isset($_FILES[$uploadKey])) {
                        $debug_info[] = "File upload error for " . $uploadKey . ": " . $_FILES[$uploadKey]['error'];
                    }
                }

                header('Content-Type: application/json');

                if (empty($errors)) {
                    $debug_info[] = "Attempting to update reception with ID: " . $id;
                    $result = $this->receptionsModel->updateReception($id, $data);
                    $debug_info[] = "Update result: " . (is_bool($result) ? ($result ? 'true' : 'false') : 'array');

                    if ($result === true) {
                        $redirectUrl = $_SESSION['is_admin'] === 1
                            ? URLROOT . "/receptions/admin"
                            : URLROOT . "/receptions/agent";

                        echo json_encode([
                            'success' => true,
                            'message' => 'اطلاعات با موفقیت به روز شد',
                            'redirect' => $redirectUrl,
                            'debug' => $debug_info
                        ]);
                    } else {
                        $errorMessage = is_array($result) ? $result[2] : 'مشکل ناشناخته در دیتابیس';
                        echo json_encode([
                            'success' => false,
                            'message' => $errorMessage,
                            'debug' => $debug_info
                        ]);
                    }
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => implode('<br>', $errors),
                        'debug' => $debug_info
                    ]);
                }
            } catch (Exception $e) {
                error_log('Error updating reception: ' . $e->getMessage());
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'debug_info' => [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]
                ]);
            }
            return;
        }
    }




    public function download($filename)
    {
        // استفاده از DIRECTORY_SEPARATOR برای سازگاری با ویندوز
        $file = dirname(APPROOT) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'receptions' . DIRECTORY_SEPARATOR . $filename;

        // بررسی امنیتی - جلوگیری از directory traversal
        $filename = basename($filename); // فقط نام فایل را استخراج می‌کند

        if (!file_exists($file)) {
            die('File not found at: ' . $file);
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
