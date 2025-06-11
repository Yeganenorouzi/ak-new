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
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      // CSRF Protection
      if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die(json_encode(['success' => false, 'message' => 'درخواست نامعتبر است']));
      }

      $_POST = array_map('htmlspecialchars', $_POST);
      $data = [
        "email" => trim($_POST['email'] ?? ''),
        "password" => trim($_POST["password"] ?? ''),
        "confirm_password" => trim($_POST["confirm_password"] ?? ''),
        "name" => trim($_POST["name"] ?? ''),
        "codemelli" => trim($_POST['codemelli'] ?? ''),
        "mobile" => trim($_POST['mobile'] ?? ''),
        "ostan" => trim($_POST['ostan'] ?? ''),
        "shahr" => trim($_POST['shahr'] ?? ''),
        "address" => trim($_POST['address'] ?? ''),
        "phone" => trim($_POST['phone'] ?? ''),
        "hours" => trim($_POST['hours'] ?? ''),
        "codeposti" => trim($_POST['codeposti'] ?? ''),
        "terms" => isset($_POST['terms']) ? true : false,
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
        "terms_err" => ""
      ];

      // Enhanced validation
      if (empty($data["email"])) {
        $data["email_err"] = "لطفا ایمیل را وارد کنید";
      } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $data["email_err"] = "لطفا ایمیل معتبر وارد کنید";
      } elseif ($this->authModel->findUserByEmail($data["email"])) {
        $data["email_err"] = "این ایمیل قبلاً ثبت شده است";
      }

      if (empty($data["password"])) {
        $data["password_err"] = "لطفا رمز عبور را وارد کنید";
      } elseif (strlen($data["password"]) < 8) {
        $data["password_err"] = "رمز عبور باید حداقل 8 کاراکتر باشد";
      } elseif (!preg_match('/\d/', $data["password"])) {
        $data["password_err"] = "رمز عبور باید حداقل شامل یک عدد باشد";
      }

      if (empty($data["confirm_password"])) {
        $data["confirm_password_err"] = "لطفا تکرار رمز عبور را وارد کنید";
      } elseif ($data["password"] !== $data["confirm_password"]) {
        $data["confirm_password_err"] = "رمز عبور و تکرار آن مطابقت ندارند";
      }

      if (empty($data["name"])) {
        $data["name_err"] = "لطفا نام را وارد کنید";
      } elseif (strlen($data["name"]) < 3) {
        $data["name_err"] = "نام باید حداقل 3 کاراکتر باشد";
      } elseif (!preg_match('/^[\x{0600}-\x{06FF}\s]+$/u', $data["name"])) {
        $data["name_err"] = "لطفا نام را به فارسی وارد کنید";
      }

      if (empty($data["codemelli"])) {
        $data["codemelli_err"] = "لطفا کد ملی را وارد کنید";
      } elseif ($this->authModel->findUserBycodemelli($data["codemelli"])) {
        $data["codemelli_err"] = "این کد ملی قبلاً ثبت شده است";
      } elseif (!$this->isValidCodemelli($data["codemelli"])) {
        $data["codemelli_err"] = "کد ملی نامعتبر است";
      }

      if (empty($data["mobile"])) {
        $data["mobile_err"] = "لطفا شماره موبایل را وارد کنید";
      } elseif (!preg_match('/^09[0-9]{9}$/', $data["mobile"])) {
        $data["mobile_err"] = "شماره موبایل نامعتبر است";
      } elseif ($this->authModel->findUserByMobile($data["mobile"])) {
        $data["mobile_err"] = "این شماره موبایل قبلاً ثبت شده است";
      }

      // Other validations remain the same...
      if (empty($data["ostan"])) {
        $data["ostan_err"] = "لطفا استان را انتخاب کنید";
      }
      if (empty($data["shahr"])) {
        $data["shahr_err"] = "لطفا شهر را انتخاب کنید";
      }
      if (empty($data["address"])) {
        $data["address_err"] = "لطفا آدرس را وارد کنید";
      }
      // Phone is completely optional - no validation needed
      if (!empty($data["hours"]) && strlen($data["hours"]) < 3) {
        $data["hours_err"] = "ساعت کاری نامعتبر است";
      }
      if (!empty($data["codeposti"]) && !$this->isValidCodeposti($data["codeposti"])) {
        $data["codeposti_err"] = "کد پستی نامعتبر است";
      }

      if (!isset($_POST['terms'])) {
        $data["terms_err"] = "لطفا قوانین و مقررات را بپذیرید";
      }

      // Check if all validations passed
      $errors = array_filter($data, function ($key) use ($data) {
        return strpos($key, '_err') !== false && !empty($data[$key]);
      }, ARRAY_FILTER_USE_KEY);

      if (empty($errors)) {
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

        try {
          if ($this->authModel->register($data)) {
            // Send welcome email (optional)
            // $this->sendWelcomeEmail($data["email"], $data["name"]);

            echo json_encode([
              'success' => true,
              'message' => 'ثبت نام شما با موفقیت انجام شد. حساب شما پس از تایید ادمین فعال خواهد شد.'
            ]);
            exit();
          } else {
            echo json_encode([
              'success' => false,
              'message' => 'خطا در ذخیره اطلاعات. لطفاً مجدداً تلاش کنید.'
            ]);
            exit();
          }
        } catch (Exception $e) {
          error_log('Register Exception: ' . $e->getMessage());
          echo json_encode([
            'success' => false,
            'message' => 'خطای سیستمی رخ داده است. لطفاً با پشتیبانی تماس بگیرید.'
          ]);
          exit();
        }
      } else {
        echo json_encode([
          'success' => false,
          'message' => 'لطفاً خطاهای زیر را برطرف کنید',
          'errors' => array_filter($data, function ($key) use ($data) {
            return strpos($key, '_err') !== false;
          }, ARRAY_FILTER_USE_KEY)
        ]);
        exit();
      }
    } else {
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