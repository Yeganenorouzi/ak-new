<?php

class UsersModel
{

  private $db;
  public function __construct()
  {
    $this->db = new DataBase;
  }


  public function getAllUsers()
  {
    $this->db->query("SELECT * FROM users");
    return $this->db->fetchAll();
  }

  public function createUser($data)
  {
    try {
      // هش کردن رمز عبور
      $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);

      if ($this->isDuplicateUser($data["email"], $data["mobile"])) {
        throw new Exception("ایمیل یا شماره موبایل قبلاً ثبت شده است.");
      }
      if (!$this->isValidCodemelli($data["codemelli"])) {
        throw new Exception("کد ملی معتبر نیست.");
      }

      $this->db->query(
        "INSERT INTO users (codemelli, mobile, email, password, name, avatar)
         VALUES (:codemelli, :mobile, :email, :password, :name, :avatar)"
      );

      $this->db->bind(":codemelli", trim($data["codemelli"]));
      $this->db->bind(":mobile", trim($data["mobile"]));
      $this->db->bind(":email", filter_var($data["email"], FILTER_VALIDATE_EMAIL));
      $this->db->bind(":password", $hashedPassword);
      $this->db->bind(":name", trim($data["name"]));
      $this->db->bind(":avatar", $data["avatar"]);

      return $this->db->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  private function isDuplicateUser($email, $mobile)
  {
    $this->db->query("SELECT * FROM `users` WHERE `email` = :email OR `mobile` = :mobile");
    $this->db->bind(":email", $email);
    $this->db->bind(":mobile", $mobile);
    $this->db->execute();
    return $this->db->rowCount() > 0;
  }

  private function isValidCodemelli($codemelli)
  {
    return preg_match("/^\d{10}$/", $codemelli);
  }
}
