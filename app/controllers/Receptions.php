<?php

class Receptions extends Controller
{
    private $receptionsModel;
    public function __construct()
    {
        $this->receptionsModel = $this->model("ReceptionsModel");
    }

    public function admin() {
        $data = [
            "receptions" => $this->receptionsModel->getAllReceptions()
          ];
        return $this->view("admin/receptions/read",$data);      
    }

    public function agent() {
        $data = [
            "receptions" => $this->receptionsModel->getAllReceptionsByAgent()
          ];
        return $this->view("agent/receptions/read",$data);      
    }


    public function create() {
        return $this->view("agent/receptions/create");
    }

    public function store() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = [];
            
            $serial_id = $this->receptionsModel->getSerialIdBySerial($_POST["serial"]);
            $user_id = $this->receptionsModel->getUserIdByCodeMelli($_SESSION["user_codemelli"]);
            
            // بررسی وجود مشتری و ایجاد در صورت عدم وجود
            $customer_data = [
                'codemelli' => $_POST["codemelli"],
                'name' => $_POST["name"] ?? '',        
                'passport' => $_POST["passport"] ?? '', 
                'mobile' => $_POST["mobile"] ?? '',
                'phone' => $_POST["phone"] ?? '',
                'ostan' => $_POST["ostan"] ?? '',
                'shahrestan' => $_POST["shahr"] ?? '',
                'address' => $_POST["address"] ?? '' ,
                'code_posti' => $_POST["code_posti"] ?? ''  
            ];
            $customer_id = $this->receptionsModel->getOrCreateCustomer($customer_data);
            
            if (!$serial_id) {
                $errors[] = "سریال وارد شده معتبر نمی‌باشد.";
            }
            if (!$user_id) {
                $errors[] = "کد ملی کاربر معتبر نمی‌باشد.";
            }
            
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
                "accessories" => $_POST["accessories"],
                "estimated_time" => $_POST["estimated_time"],
                "estimated_cost" => $_POST["estimated_cost"],
                "paziresh_status" => $_POST["paziresh_status"],
                "file1" => '',
                "file2" => '',
                "file3" => ''
            ];

            $fileFields = ['file1', 'file2', 'file3'];
            foreach ($fileFields as $field) {
                if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    $maxSize = 5 * 1024 * 1024;

                    if (!in_array($_FILES[$field]['type'], $allowedTypes)) {
                        $errors[] = "فقط فایل‌های JPG و PNG مجاز هستند.";
                    } elseif ($_FILES[$field]['size'] > $maxSize) {
                        $errors[] = "حجم فایل نباید بیشتر از 5 مگابایت باشد.";
                    } else {
                        $fileName = time() . '_' . $_FILES[$field]['name'];
                        $uploadPath = 'uploads/receptions/' . $fileName;

                        if (!is_dir('uploads/receptions')) {
                            mkdir('uploads/receptions', 0777, true);
                        }

                        if (move_uploaded_file($_FILES[$field]['tmp_name'], $uploadPath)) {
                            $data[$field] = $fileName;
                        } else {
                            $errors[] = "خطا در آپلود فایل.";
                        }
                    }
                }
            }

            if (empty($errors)) {
                $this->receptionsModel->createReception($data);
                header("Location: " . URLROOT . "/agent/receptions/read");
                exit();
            } else {
                $data['errors'] = $errors;
                return $this->view("agent/receptions/create", $data);
            }
        }
    }

    

    

   
}

