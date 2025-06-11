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
        $filters = [];

        // دریافت فیلترها از درخواست
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (!empty($_GET['name'])) {
                $filters['name'] = $_GET['name'];
            }
            if (!empty($_GET['codemelli'])) {
                $filters['codemelli'] = $_GET['codemelli'];
            }
            if (!empty($_GET['mobile'])) {
                $filters['mobile'] = $_GET['mobile'];
            }
            if (!empty($_GET['email'])) {
                $filters['email'] = $_GET['email'];
            }
        }

        $data = [
            "users" => $this->usersModel->getFilteredUsers($filters),
            "filters" => $filters
        ];
        return $this->view("admin/users/list", $data);
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

    public function indexAgents()
    {
        $filters = [];

        // دریافت فیلترها از درخواست
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (!empty($_GET['name'])) {
                $filters['name'] = $_GET['name'];
            }
            if (!empty($_GET['codemelli'])) {
                $filters['codemelli'] = $_GET['codemelli'];
            }
            if (!empty($_GET['mobile'])) {
                $filters['mobile'] = $_GET['mobile'];
            }
            if (!empty($_GET['email'])) {
                $filters['email'] = $_GET['email'];
            }
        }

        $data = [
            "agents" => $this->usersModel->getFilteredAgents($filters),
            "filters" => $filters
        ];
        return $this->view("admin/agents/list", $data);
    }

    public function createAgent()
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
                    if ($this->usersModel->createAgent($data)) {
                        header("location:" . URLROOT . "/users/indexAgents");

                        exit();
                    }
                } catch (Exception $e) {
                    $errors[] = $e->getMessage();
                }
            }
        }

        // ارسال هم خطاها و هم داده‌های فرم به view
        $this->view("admin/agents/create", [
            "errors" => $errors,
            "data" => $data
        ]);
    }

    public function edit($id)
    {
        $data = [
            "user" => $this->usersModel->getUserById($id)
        ];
        return $this->view("admin/users/update", $data);
    }


    public function update($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->usersModel->updateUser($id, $_POST);
                header("Location: " . URLROOT . "/users/index");
                exit();
            }
            // اگر متد POST نبود، به صفحه قبل برگردد
            header("Location: " . URLROOT . "/users/edit/" . $id);
            exit();
        } catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            $this->view('admin/users/update', $data);
        }
    }

    public function delete($id)
    {
        $this->usersModel->deleteUser($id);
        header("Location: " . URLROOT . "/users/index");
        exit();
    }

    public function editAgent($id)
    {
        $data = [
            "agent" => $this->usersModel->getAgentById($id)
        ];
        return $this->view("admin/agents/update", $data);
    }


    public function updateAgent($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->usersModel->updateAgent($id, $_POST);
            header("Location: " . URLROOT . "/users/indexAgents");
            exit();
        }
        // اگر متد POST نبود، به صفحه قبل برگردد
        header("Location: " . URLROOT . "/users/editAgent/" . $id);
        exit();
    }

    public function deleteAgent($id)
    {
        $this->usersModel->deleteAgent($id);
        header("Location: " . URLROOT . "/users/indexAgents");
        exit();
    }

    public function profile()
    {
        // بررسی ورود کاربر
        if (!isset($_SESSION['admin']) || !isset($_SESSION['id'])) {
            $_SESSION['error_message'] = 'لطفاً ابتدا وارد شوید.';
            header("Location: " . URLROOT . "/auth/login");
            exit();
        }

        $userId = $_SESSION['id'];

        try {
            $user = $this->usersModel->getUserById($userId);

            // بررسی وجود کاربر
            if (!$user) {
                $_SESSION['error_message'] = 'کاربر پیدا نشد. لطفاً دوباره وارد شوید.';
                header("Location: " . URLROOT . "/auth/logout");
                exit();
            }

            $data = [
                "user" => $user,
                "success" => isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '',
                "errors" => isset($_SESSION['error_message']) ? $_SESSION['error_message'] : ''
            ];

            // پاک کردن پیام‌ها بعد از نمایش
            unset($_SESSION['success_message']);
            unset($_SESSION['error_message']);

            $this->view("public/userProfile", $data);

        } catch (Exception $e) {
            $_SESSION['error_message'] = 'خطا در بارگذاری اطلاعات کاربر: ' . $e->getMessage();
            header("Location: " . URLROOT . "/dashboard");
            exit();
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // بررسی وجود session
            if (!isset($_SESSION['id'])) {
                header("Location: " . URLROOT . "/auth/login");
                exit();
            }

            $userId = $_SESSION['id'];
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // بررسی اینکه آیا فیلدها پر شده‌اند
            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $_SESSION['error_message'] = 'لطفاً همه فیلدها را پر کنید.';
                header("Location: " . URLROOT . "/users/profile");
                exit();
            }

            // بررسی اینکه رمز جدید و تکرار آن یکسان باشند
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error_message'] = 'رمز عبور جدید و تکرار آن باید یکسان باشند.';
                header("Location: " . URLROOT . "/users/profile");
                exit();
            }

            // بررسی طول رمز عبور
            if (strlen($newPassword) < 6) {
                $_SESSION['error_message'] = 'رمز عبور جدید باید حداقل 6 کاراکتر باشد.';
                header("Location: " . URLROOT . "/users/profile");
                exit();
            }

            // دریافت اطلاعات کاربر فعلی
            $user = $this->usersModel->getUserById($userId);

            // بررسی صحت رمز عبور فعلی
            if (!password_verify($currentPassword, $user->password)) {
                $_SESSION['error_message'] = 'رمز عبور فعلی اشتباه است.';
                header("Location: " . URLROOT . "/users/profile");
                exit();
            }

            // هش کردن رمز عبور جدید
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // به‌روزرسانی رمز عبور
            if ($this->usersModel->updatePassword($userId, $hashedPassword)) {
                $_SESSION['success_message'] = 'رمز عبور با موفقیت تغییر یافت.';
            } else {
                $_SESSION['error_message'] = 'خطا در تغییر رمز عبور. لطفاً دوباره تلاش کنید.';
            }

            header("Location: " . URLROOT . "/users/profile");
            exit();
        }

        // اگر متد POST نبود، به صفحه پروفایل برگردد
        header("Location: " . URLROOT . "/users/profile");
        exit();
    }
}
