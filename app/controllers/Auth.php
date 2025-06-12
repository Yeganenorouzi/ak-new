<?php

class Auth extends Controller
{
  private $authModel;
  private $maxLoginAttempts = 5;
  private $lockoutTime = 15; // minutes

  public function __construct()
  {
    $this->authModel = $this->model("AuthModel");

    // Start session if not started
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    // Generate CSRF token if not exists
    if (!isset($_SESSION['csrf_token'])) {
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    if (isset($_SESSION['admin'])) {
      header("location:" . URLROOT . "/dashboard/admin");
    }
  }



  public function login()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // CSRF Protection
      if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die(json_encode(['success' => false, 'message' => 'درخواست نامعتبر است']));
      }

      // Rate limiting check
      if ($this->isRateLimited()) {
        die(json_encode([
          'success' => false,
          'message' => 'تعداد تلاش‌های شما بیش از حد مجاز است. لطفاً 15 دقیقه صبر کنید'
        ]));
      }

      $_POST = array_map('htmlspecialchars', $_POST);
      $data = [
        "codemelli" => trim($_POST['codemelli']),
        "password" => trim($_POST['password']),
        "remember" => isset($_POST['remember']) ? true : false,
        "codemelli_err" => "",
        "password_err" => ""
      ];

      // Validation
      if (empty($data['codemelli'])) {
        $data["codemelli_err"] = "لطفا کد ملی را وارد کنید";
      } elseif (!$this->isValidCodemelli($data["codemelli"])) {
        $data["codemelli_err"] = "کد ملی نامعتبر است";
      }

      if (empty($data['password'])) {
        $data["password_err"] = "لطفا رمز عبور را وارد کنید";
      }

      if (empty($data["codemelli_err"]) && empty($data["password_err"])) {
        $user = $this->authModel->login($data);
        if ($user && $user !== 'not_approved') {
          // Clear login attempts
          $this->clearLoginAttempts();

          // Set session
          $_SESSION['admin'] = $data["codemelli"];
          $_SESSION['user_codemelli'] = $data["codemelli"];
          $_SESSION['is_admin'] = $user->admin;
          $_SESSION['name'] = $user->name;
          $_SESSION['id'] = $user->id;
          $_SESSION['avatar'] = $user->avatar;

          // Remember me functionality
          if ($data['remember']) {
            $token = bin2hex(random_bytes(32));
            // Save token to database
            $this->authModel->saveRememberToken($user->id, $token);
            setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', false, true);
          }

          echo json_encode([
            'success' => true,
            'message' => 'ورود موفقیت‌آمیز',
            'redirect' => $user->admin == 1 ? URLROOT . "/dashboard/admin" : URLROOT . "/dashboard/agent"
          ]);
          exit();
        } elseif ($user === 'not_approved') {
          // Record failed attempt
          $this->recordLoginAttempt();

          echo json_encode([
            'success' => false,
            'message' => 'حساب کاربری شما هنوز توسط ادمین تایید نشده است. لطفاً صبر کنید.'
          ]);
          exit();
        } else {
          // Record failed attempt
          $this->recordLoginAttempt();

          echo json_encode([
            'success' => false,
            'message' => 'کد ملی یا رمز عبور اشتباه است'
          ]);
          exit();
        }
      } else {
        echo json_encode([
          'success' => false,
          'message' => 'لطفاً خطاهای زیر را برطرف کنید',
          'errors' => [
            'codemelli' => $data["codemelli_err"],
            'password' => $data["password_err"]
          ]
        ]);
        exit();
      }
    } else {
      $data = [
        "codemelli" => "",
        "password" => "",
        "codemelli_err" => "",
        "password_err" => "",
        "csrf_token" => $_SESSION['csrf_token']
      ];
      return $this->view('auth/login', $data);
    }
  }

  public function register()
  {
    try {
      // Check if it's a POST request
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process form
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'codemelli' => trim($_POST['codemelli']),
          'mobile' => trim($_POST['mobile']),
          'phone' => trim($_POST['phone']),
          'ostan' => trim($_POST['ostan']),
          'shahr' => trim($_POST['shahr']),
          'address' => trim($_POST['address']),
          'codeposti' => trim($_POST['codeposti']),
          'hours' => trim($_POST['hours']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          'codemelli_err' => '',
          'mobile_err' => '',
          'phone_err' => '',
          'ostan_err' => '',
          'shahr_err' => '',
          'address_err' => '',
          'codeposti_err' => '',
          'hours_err' => ''
        ];

        // Validate Email
        if (empty($data['email'])) {
          $data['email_err'] = 'لطفا ایمیل را وارد کنید';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $data['email_err'] = 'ایمیل نامعتبر است';
        } elseif ($this->authModel->findUserByEmail($data['email'])) {
          $data['email_err'] = 'این ایمیل قبلا ثبت شده است';
        }

        // Validate Name
        if (empty($data['name'])) {
          $data['name_err'] = 'لطفا نام را وارد کنید';
        }

        // Validate Password
        if (empty($data['password'])) {
          $data['password_err'] = 'لطفا رمز عبور را وارد کنید';
        } elseif (strlen($data['password']) < 8) {
          $data['password_err'] = 'رمز عبور باید حداقل 8 کاراکتر باشد';
        }

        // Validate Confirm Password
        if (empty($data['confirm_password'])) {
          $data['confirm_password_err'] = 'لطفا تکرار رمز عبور را وارد کنید';
        } else {
          if ($data['password'] != $data['confirm_password']) {
            $data['confirm_password_err'] = 'رمز عبور و تکرار آن مطابقت ندارند';
          }
        }

        // Validate National Code
        if (empty($data['codemelli'])) {
          $data['codemelli_err'] = 'لطفا کد ملی را وارد کنید';
        } elseif (!preg_match('/^\d{10}$/', $data['codemelli'])) {
          $data['codemelli_err'] = 'کد ملی باید 10 رقم باشد';
        }

        // Validate Mobile
        if (empty($data['mobile'])) {
          $data['mobile_err'] = 'لطفا شماره موبایل را وارد کنید';
        } elseif (!preg_match('/^09\d{9}$/', $data['mobile'])) {
          $data['mobile_err'] = 'شماره موبایل نامعتبر است';
        }

        // Validate Province and City
        if (empty($data['ostan'])) {
          $data['ostan_err'] = 'لطفا استان را انتخاب کنید';
        }
        if (empty($data['shahr'])) {
          $data['shahr_err'] = 'لطفا شهر را انتخاب کنید';
        }

        // Validate Address
        if (empty($data['address'])) {
          $data['address_err'] = 'لطفا آدرس را وارد کنید';
        }

        // Validate Postal Code
        if (empty($data['codeposti'])) {
          $data['codeposti_err'] = 'لطفا کد پستی را وارد کنید';
        } elseif (!preg_match('/^\d{10}$/', $data['codeposti'])) {
          $data['codeposti_err'] = 'کد پستی باید 10 رقم باشد';
        }

        // Make sure errors are empty
        if (
          empty($data['email_err']) && empty($data['name_err']) &&
          empty($data['password_err']) && empty($data['confirm_password_err']) &&
          empty($data['codemelli_err']) && empty($data['mobile_err']) &&
          empty($data['ostan_err']) && empty($data['shahr_err']) &&
          empty($data['address_err']) && empty($data['codeposti_err'])
        ) {

          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if ($this->authModel->register($data)) {
            echo json_encode([
              'success' => true,
              'message' => 'ثبت نام با موفقیت انجام شد'
            ]);
          } else {
            throw new Exception('خطا در ثبت نام کاربر');
          }
        } else {
          echo json_encode([
            'success' => false,
            'errors' => $data
          ]);
        }
      } else {
        // Load view
        $data = [
          "email" => "",
          "password" => "",
          "confirm_password" => "",
          "name" => "",
          "codemelli" => "",
          "mobile" => "",
          "ostan" => "",
          "shahr" => "",
          "address" => "",
          "phone" => "",
          "hours" => "",
          "codeposti" => "",
          "terms" => false,
          // Error fields
          "email_err" => "",
          "password_err" => "",
          "confirm_password_err" => "",
          "name_err" => "",
          "codemelli_err" => "",
          "mobile_err" => "",
          "ostan_err" => "",
          "shahr_err" => "",
          "address_err" => "",
          "phone_err" => "",
          "hours_err" => "",
          "codeposti_err" => "",
          "terms_err" => "",
          "csrf_token" => $_SESSION['csrf_token']
        ];
        return $this->view('auth/register', $data);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      echo json_encode([
        'success' => false,
        'message' => 'خطا در ثبت نام: ' . $e->getMessage()
      ]);
    }
  }

  public function logout()
  {
    // Clear remember token
    if (isset($_COOKIE['remember_token'])) {
      $this->authModel->clearRememberToken($_COOKIE['remember_token']);
      setcookie('remember_token', '', time() - 3600, '/', '', false, true);
    }

    session_destroy();
    header("location:" . URLROOT . "/auth/login");
    exit();
  }

  // Enhanced validation methods
  private function isValidCodemelli($codemelli)
  {
    if (!is_numeric($codemelli) || strlen($codemelli) !== 10) {
      return false;
    }

    // Check for repeated digits
    if (preg_match('/^(\d)\1{9}$/', $codemelli)) {
      return false;
    }

    // Calculate checksum
    $sum = 0;
    for ($i = 0; $i < 9; $i++) {
      $sum += intval($codemelli[$i]) * (10 - $i);
    }

    $remainder = $sum % 11;
    $checkDigit = intval($codemelli[9]);

    return ($remainder < 2 && $checkDigit == $remainder) ||
      ($remainder >= 2 && $checkDigit == 11 - $remainder);
  }

  private function isValidCodeposti($codeposti)
  {
    return preg_match('/^[1-9][0-9]{9}$/', $codeposti);
  }

  private function isStrongPassword($password)
  {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/', $password);
  }

  // Rate limiting methods
  private function isRateLimited()
  {
    $ip = $_SERVER['REMOTE_ADDR'];
    $attempts = $_SESSION['login_attempts'][$ip] ?? [];
    $attempts = array_filter($attempts, function ($time) {
      return $time > (time() - ($this->lockoutTime * 60));
    });

    return count($attempts) >= $this->maxLoginAttempts;
  }

  private function recordLoginAttempt()
  {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!isset($_SESSION['login_attempts'][$ip])) {
      $_SESSION['login_attempts'][$ip] = [];
    }
    $_SESSION['login_attempts'][$ip][] = time();
  }

  private function clearLoginAttempts()
  {
    $ip = $_SERVER['REMOTE_ADDR'];
    unset($_SESSION['login_attempts'][$ip]);
  }
}