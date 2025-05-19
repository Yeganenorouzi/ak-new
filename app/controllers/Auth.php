<?php

class Auth extends Controller
{
  private $authModel;
  public function __construct()
  {
    $this->authModel = $this->model("AuthModel");
    if (isset($_SESSION['admin'])) {
      header("location:" . URLROOT . "/dashboard/admin");
    }
  }

  public function login()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $_POST = array_map('htmlspecialchars', $_POST);
      $data = [
        "codemelli" => trim($_POST['codemelli']),
        "password" => trim($_POST['password']),
        "codemelli_err" => "",
        "password_err" => ""
      ];
      if (empty($data['codemelli'])) {
        $data["codemelli_err"] = "لطفا کد ملی را وارد کنید";
      } elseif (strlen($data["codemelli"]) < 10) {
        $data["codemelli_err"] = "کد ملی باید ۱۰ رقم باشد";
      }
      if (empty($data['password'])) {
        $data["password_err"] = "مقدار دهی کن";
      }
      if (empty($data["codemelli_err"]) && empty($data["password_err"])) {
        $user = $this->authModel->login($data);
        if ($user) {
          $_SESSION['admin'] = $data["codemelli"];
          $_SESSION['user_codemelli'] = $data["codemelli"];
          $_SESSION['is_admin'] = $user->admin;
          $_SESSION['name'] = $user->name;
          $_SESSION['id'] = $user->id;
          if ($user->admin == 1) {
            header("location:" . URLROOT . "/dashboard/admin");
          } else {
            header("location:" . URLROOT . "/dashboard/agent");
          }
        } else {
          $_SESSION["login_err"] = "نام کاربری و یا کلمه عبور اشتباه می باشد";
          header("location:" . URLROOT . "/auth/login");
        }
      } else {
        return $this->view('auth/login', $data);
      }
    } else {
      $data = [
        "codemelli" => "",
        "password" => "",
        "codemelli_err" => "",
        "password_err" => ""
      ];
      return $this->view('auth/login', $data);
    }
  }

  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $_POST = array_map('htmlspecialchars', $_POST);
      $data = [
        "email" => trim($_POST['email'] ?? ''),
        "password" => trim($_POST["password"] ?? ''),
        "name" => trim($_POST["name"] ?? ''),
        "codemelli" => trim($_POST['codemelli'] ?? ''),
        "mobile" => trim($_POST['mobile'] ?? ''),
        "ostan" => trim($_POST['ostan'] ?? ''),
        "shahr" => trim($_POST['shahr'] ?? ''),
        "address" => trim($_POST['address'] ?? ''),
        "phone" => trim($_POST['phone'] ?? ''),
        "hours" => trim($_POST['hours'] ?? ''),
        "codeposti" => trim($_POST['codeposti'] ?? ''),
        "email_err" => "",
        "password_err" => "",
        "name_err" => "",
        "codemelli_err" => "",
        "mobile_err" => "",
        "ostan_err" => "",
        "shahr_err" => "",
        "address_err" => "",
        "phone_err" => "",
        "hours_err" => "",
        "codeposti_err" => "",
      ];

      // اضافه کردن لاگ برای بررسی داده‌های ورودی
      error_log('Register Data: ' . print_r($data, true));

      if (empty($data["email"])) {
        $data["email_err"] = "لطفا ایمیل را وارد کنید....!";
      } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $data["email_err"] = "لطفا ایمیل معتبر وارد کنید";
      }
      if (empty($data["password"])) {
        $data["password_err"] = "لطفا کلمه عبور را وارد کنید....!";
      } elseif (strlen($data["password"]) < 4) {
        $data["password_err"] = "کلمه عبور باید بیشتر از 4 کاراکتر باشد";
      }

      if (empty($data["name"])) {
        $data["name_err"] = "لطفا نام را وارد کنید....!";
      } elseif (!preg_match('/^[\x{0600}-\x{06FF}\s]+$/u', $data["name"])) {
        $data["name_err"] = "لطفا نام را به فارسی وارد کنید";
      }
      if (empty($data["codemelli"])) {
        $data["codemelli_err"] = "لطفا کد ملی را وارد کنید....!";
      } elseif ($this->authModel->findUserBycodemelli($data["codemelli"])) {
        $data["codemelli_err"] = "این کد ملی قبلاً ثبت شده است";
      } elseif (!$this->isValidCodemelli($data["codemelli"])) {
        $data["codemelli_err"] = "کد ملی نامعتبر است";
      }
      if (empty($data["mobile"])) {
        $data["mobile_err"] = "لطفا موبایل را وارد کنید....!";
      } elseif (!preg_match('/^09[0-9]{9}$/', $data["mobile"])) {
        $data["mobile_err"] = "شماره موبایل نامعتبر است";
      }
      if (empty($data["ostan"])) {
        $data["ostan_err"] = "لطفا استان را وارد کنید....!";
      }
      if (empty($data["shahr"])) {
        $data["shahr_err"] = "لطفا شهر را وارد کنید....!";
      }
      if (empty($data["address"])) {
        $data["address_err"] = "لطفا آدرس را وارد کنید....!";
      }
      if (empty($data["phone"])) {
        $data["phone_err"] = "لطفا شماره تلفن را وارد کنید....!";
      }

      if (empty($data["hours"])) {
        $data["hours_err"] = "لطفا ساعت کاری را وارد کنید....!";
      }
      if (empty($data["codeposti"])) {
        $data["codeposti_err"] = "لطفا کد پستی را وارد کنید....!";
      } elseif (!$this->isValidCodeposti($data["codeposti"])) {
        $data["codeposti_err"] = "کد پستی نامعتبر است";
      }

      if (empty($data["email_err"]) && empty($data["password_err"]) && empty($data["codemelli_err"]) && empty($data["name_err"]) && empty($data["mobile_err"]) && empty($data["ostan_err"]) && empty($data["shahr_err"]) && empty($data["address_err"]) && empty($data["phone_err"]) && empty($data["hours_err"]) && empty($data["codeposti_err"])) {
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        
        try {
          if ($this->authModel->register($data)) {
            echo json_encode([
              'success' => true,
              'message' => 'ثبت نام با موفقیت انجام شد'
            ]);
            exit();
          } else {
            error_log('Register Error: Failed to save user');
            echo json_encode([
              'success' => false,
              'message' => 'خطا در ذخیره اطلاعات. لطفاً با پشتیبانی تماس بگیرید.',
              'debug' => 'Check server logs for more details'
            ]);
            exit();
          }
        } catch (Exception $e) {
          error_log('Register Exception: ' . $e->getMessage());
          echo json_encode([
            'success' => false,
            'message' => $e->getMessage(),
            'debug' => 'Server error logged'
          ]);
          exit();
        }
      } else {
        // اضافه کردن لاگ برای خطاهای اعتبارسنجی
        error_log('Validation Errors: ' . print_r(array_filter($data, function($key) {
          return strpos($key, '_err') !== false && !empty($data[$key]);
        }, ARRAY_FILTER_USE_KEY), true));

        echo json_encode([
          'success' => false,
          'message' => 'لطفاً خطاهای زیر را برطرف کنید',
          'errors' => [
            'email' => $data["email_err"],
            'password' => $data["password_err"],
            'name' => $data["name_err"],
            'codemelli' => $data["codemelli_err"],
            'mobile' => $data["mobile_err"],
            'ostan' => $data["ostan_err"],
            'shahr' => $data["shahr_err"],
            'address' => $data["address_err"],
            'phone' => $data["phone_err"],
            'hours' => $data["hours_err"],
            'codeposti' => $data["codeposti_err"]
          ]
        ]);
        exit();
      }
    } else {
      $data = [
        "email" => "",
        "password" => "",
        "name" => "",
        "codemelli" => "",
        "mobile" => "",
        "ostan" => "",
        "shahr" => "",
        "address" => "",
        "phone" => "",
        "hours" => "",
        "codeposti" => "",
        "email_err" => "",
        "password_err" => "",
        "name_err" => "",
        "codemelli_err" => "",
        "mobile_err" => "",
        "ostan_err" => "",
        "shahr_err" => "",
        "address_err" => "",
        "phone_err" => "",
        "hours_err" => "",
        "codeposti_err" => ""
      ];
      return $this->view('auth/register', $data);
    }
  }
  public function logout()
  {
    session_destroy();
    header("location:" . URLROOT . "/auth/login");
    exit();
  }

  private function isValidCodemelli($codemelli)
  {
    // Example validation logic: check if it's a numeric string of a specific length
    return is_numeric($codemelli) && strlen($codemelli) === 10;
  }

  private function isValidCodeposti($codeposti)
  {
    return preg_match('/^[1-9][0-9]{9}$/', $codeposti);
  }
}