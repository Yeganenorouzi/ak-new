<?php
class AuthModel
{
  private $db;
  public function __construct()
  {
    $this->db = new Database;
  }



  public function findAdmin($codemelli)
  {
    try {
      $this->db->query("SELECT * FROM users WHERE codemelli = :codemelli AND admin = :admin");
      $this->db->bind(":codemelli", $codemelli);
      $this->db->bind(":admin", 1);
      $this->db->fetch();
      return $this->db->rowCount() > 0;
    } catch (Exception $e) {
      error_log("Error in findAdmin: " . $e->getMessage());
      return false;
    }
  }



  public function register($data)
  {
    try {
      error_log("Starting registration process...");
      
      // بررسی اتصال به دیتابیس
      $this->db->query("SELECT 1");
      $this->db->execute();
      error_log("Database connection test successful");

      // لاگ کردن داده‌های ورودی
      error_log("Input data for registration: " . print_r($data, true));

      // ساخت کوئری با مقادیر تست شده
      $sql = "INSERT INTO `users` (
        `email`, 
        `password`, 
        `name`, 
        `codemelli`, 
        `mobile`, 
        `ostan`, 
        `shahr`, 
        `address`, 
        `phone`, 
        `hours`, 
        `codeposti`
      ) VALUES (
        :email,
        :password,
        :name,
        :codemelli,
        :mobile,
        :ostan,
        :shahr,
        :address,
        :phone,
        :hours,
        :codeposti
      )";

      error_log("Preparing SQL query: " . $sql);
      
      // آماده‌سازی کوئری
      $this->db->query($sql);

      // تنظیم پارامترها با بررسی طول و اعتبارسنجی
      $params = [
        ":email" => substr($data["email"], 0, 255),
        ":password" => $data["password"],
        ":name" => mb_substr($data["name"], 0, 255, 'UTF-8'),
        ":codemelli" => substr($data["codemelli"], 0, 10),
        ":mobile" => substr($data["mobile"], 0, 11),
        ":ostan" => mb_substr($data["ostan"], 0, 100, 'UTF-8'),
        ":shahr" => mb_substr($data["shahr"], 0, 100, 'UTF-8'),
        ":address" => $data["address"],
        ":phone" => substr($data["phone"], 0, 20),
        ":hours" => substr($data["hours"], 0, 50),
        ":codeposti" => substr($data["codeposti"], 0, 10)
      ];

      // لاگ کردن پارامترها
      error_log("Parameters to bind: " . print_r($params, true));

      // بایند کردن پارامترها با خطایابی جداگانه
      foreach ($params as $key => $value) {
        try {
          $this->db->bind($key, $value);
          error_log("Successfully bound parameter {$key} with value: " . $value);
        } catch (Exception $e) {
          error_log("Error binding parameter {$key}: " . $e->getMessage());
          throw new Exception("خطا در تنظیم پارامتر {$key}");
        }
      }

      // اجرای کوئری با خطایابی دقیق
      try {
        $result = $this->db->execute();
        if ($result) {
          error_log("Query executed successfully!");
          return true;
        } else {
          error_log("Query execution failed without throwing exception");
          throw new Exception("خطا در اجرای کوئری - بدون پیام خطای مشخص");
        }
      } catch (PDOException $e) {
        error_log("PDO Error during execution: " . $e->getMessage());
        error_log("PDO Error Code: " . $e->getCode());
        if ($e->getCode() == 23000) {
          // خطای unique constraint
          if (strpos($e->getMessage(), 'codemelli') !== false) {
            throw new Exception("کد ملی وارد شده تکراری است");
          } elseif (strpos($e->getMessage(), 'email') !== false) {
            throw new Exception("ایمیل وارد شده تکراری است");
          }
        }
        throw new Exception("خطا در ذخیره اطلاعات در پایگاه داده");
      }

    } catch (Exception $e) {
      error_log("Final error in registration: " . $e->getMessage());
      throw $e;
    }
  }



  public function login($data)
  {
    try {
      $this->db->query("SELECT * FROM users WHERE codemelli = :codemelli");
      $this->db->bind(":codemelli", $data["codemelli"]);
      $user = $this->db->fetch();

      if ($user && password_verify($data["password"], $user->password)) {

        return $user;
      }
      return false;
    } catch (Exception $e) {
      return false;
    }
  }



  public function findUserBycodemelli($codemelli)
  {
    $this->db->query("SELECT * FROM users WHERE codemelli = :codemelli");
    $this->db->bind(":codemelli", $codemelli);
    $this->db->fetch();
    return $this->db->rowCount() > 0;
  }
}