<?php

class Auth extends Controller
{
  private $authModel;
  public function __construct()
  {
    $this->authModel = $this->model("authmodel");
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
          $_SESSION['name'] = $user->name;
          
          header("location:" . URLROOT . "/dashboard/admin");
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
        if ($this->authModel->register($data)) {
          header("location:" . URLROOT . "/auth/login");
          exit();
        } else {
          die("خطا در ثبت نام کاربر");
        }
      } else {
        return $this->view('auth/register', $data);
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
