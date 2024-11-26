<?php

class Users extends Controller
{
    private $usersModel;
    public function __construct()
    {
        $this->usersModel = $this->model("UsersModel");
    }

    public function index()
    {
        $data = [
            "users" => $this->usersModel->getAllUsers()
        ];
        return $this->view("admin/users/read", $data);
    }

    public function create()
    {
        $errors = [];
        $data = [
            "codemelli" => '',
            "mobile" => '',
            "email" => '',
            "name" => '',
            "avatar" => ''
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                "codemelli" => $_POST["codemelli"],
                "mobile" => $_POST["mobile"],
                "email" => $_POST["email"],
                "password" => $_POST["password"],
                "name" => $_POST["name"],
                "avatar" => ''
            ];

            // بررسی و آپلود تصویر
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxSize = 5 * 1024 * 1024; // 5MB

                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $errors[] = "فقط فایل‌های JPG و PNG مجاز هستند.";
                } elseif ($_FILES['image']['size'] > $maxSize) {
                    $errors[] = "حجم فایل نباید بیشتر از 5 مگابایت باشد.";
                } else {
                    $fileName = time() . '_' . $_FILES['image']['name'];
                    $uploadPath = 'uploads/users/' . $fileName;
                    
                    if (!is_dir('uploads/users')) {
                        mkdir('uploads/users', 0777, true);
                    }

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                        $data['avatar'] = $fileName;
                    } else {
                        $errors[] = "خطا در آپلود فایل.";
                    }
                }
            }

            $errors = $this->validateUserData($data);

            if (empty($errors)) {
                try {
                    if ($this->usersModel->createUser($data)) {
                        header("location:" . URLROOT . "/users/index");
                        exit();
                    }
                } catch (Exception $e) {
                    $errors[] = $e->getMessage();
                }
            }
        }

        // ارسال هم خطاها و هم داده‌های فرم به view
        $this->view("admin/users/create", [
            "errors" => $errors,
            "data" => $data
        ]);
    }

    private function validateUserData($data)
    {
        $errors = [];
        
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "ایمیل معتبر نیست.";
        }
        if (!preg_match("/^\d{11}$/", $data["mobile"])) {
            $errors[] = "شماره موبایل باید 11 رقم باشد.";
        }

        return $errors;
    }
}
