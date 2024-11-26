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

      if ($this->isDuplicateUser($data["email"], $data["mobile"], $data["codemelli"])) {
        throw new Exception("ایمیل یا شماره موبایل یا کد ملی قبلاً ثبت شده است.");
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

  private function isDuplicateUser($email, $mobile, $codemelli)
  {
    $this->db->query("SELECT email, mobile, codemelli FROM users WHERE email = :email OR mobile = :mobile OR codemelli = :codemelli");
    $this->db->bind(":email", $email);
    $this->db->bind(":mobile", $mobile);
    $this->db->bind(":codemelli", $codemelli);
    $this->db->execute();
    
    if ($this->db->rowCount() > 0) {
        $existingUser = $this->db->fetch();
        if ($existingUser->email === $email) {
            throw new Exception("این ایمیل قبلاً در سیستم ثبت شده است.");
        }
        if ($existingUser->mobile === $mobile) {
            throw new Exception("این شماره موبایل قبلاً در سیستم ثبت شده است.");
        }
        if ($existingUser->codemelli === $codemelli) {
            throw new Exception("این کد ملی قبلاً در سیستم ثبت شده است.");
        }
        return true;
    }
    return false;
  }

  private function isValidCodemelli($codemelli)
  {
    return preg_match("/^\d{10}$/", $codemelli);
  }
}
