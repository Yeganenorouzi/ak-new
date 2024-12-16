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
        return $this->view("admin/receptions/read", $data);
    }

    public function agent()
    {
        $data = [
            "receptionsAgent" => $this->receptionsModel->getAllReceptionsByAgent()
        ];
        return $this->view("agent/receptions/read", $data);
    }


    public function create()
    {
        return $this->view("agent/receptions/create");
    }

    // تابع کمکی برای آپلود فایل
    private function uploadFile($file, $index) {
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

                if (!is_dir('uploads/receptions')) {
                    mkdir('uploads/receptions', 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    return $fileName;
                } else {
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
                "activation_start_date" => $_POST["activation_start_date"],
                "guarantee_status" => $_POST["guarantee_status"],
                "problem" => $_POST["problem"],
                "situation" => $_POST["situation"],
                "accessories" => $accessories,
                "dex" => $_POST["dex"],
                "estimated_time" => $_POST["estimated_time"],
                "estimated_cost" => $_POST["estimated_cost"],
                "paziresh_status" => $_POST["paziresh_status"],
                "file1" => '',
                "file2" => '',
                "file3" => '',
                "created_at" => date('Y-m-d H:i:s')
            ];

            // آپلود فایل‌ها
            for ($i = 1; $i <= 3; $i++) {
                $fileKey = 'file' . $i;
                if (isset($_FILES[$fileKey])) {
                    $result = $this->uploadFile($_FILES[$fileKey], $i);
                    if (strlen($result) > 0 && !str_contains($result, '.')) {
                        $errors[] = $result;
                    } else {
                        $data[$fileKey] = $result;
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
}
