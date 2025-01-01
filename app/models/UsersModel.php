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
    $this->db->query("SELECT * FROM users WHERE admin = 1");
    return $this->db->fetchAll();
  }

  public function getAllAgents()
  {
    $this->db->query("SELECT * FROM users WHERE admin = 0");
    return $this->db->fetchAll();
  }

  public function createUser($data)
  {
    try {
      // هش کردن رمز عبور
      $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);

      // بررسی تکراری بودن ایمیل و کد ملی برای همه کاربران
      $this->db->query("SELECT email, codemelli FROM users WHERE email = :email OR codemelli = :codemelli");
      $this->db->bind(":email", $data["email"]);
      $this->db->bind(":codemelli", $data["codemelli"]);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        $existingUser = $this->db->fetch();
        if ($existingUser->email === $data["email"]) {
          throw new Exception("این ایمیل قبلاً در سیستم ثبت شده است.");
        }
        if ($existingUser->codemelli === $data["codemelli"]) {
          throw new Exception("این کد ملی قبلاً در سیستم ثبت شده است.");
        }
      }

      // بررسی تکراری بودن موبایل فقط در بین ادمین‌ها
      $this->db->query("SELECT mobile FROM users WHERE mobile = :mobile AND admin = 1");
      $this->db->bind(":mobile", $data["mobile"]);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        throw new Exception("این شماره موبایل قبلاً برای یک ادمین ثبت شده است.");
      }

      if (!$this->isValidCodemelli($data["codemelli"])) {
        throw new Exception("کد ملی معتبر نیست.");
      }

      $this->db->query(
        "INSERT INTO users (codemelli, mobile, email, password, name, avatar, admin)
         VALUES (:codemelli, :mobile, :email, :password, :name, :avatar, 1)"
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


  public function createAgent($data)
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
        "INSERT INTO users (codemelli, mobile, email, password, name, avatar, admin)
         VALUES (:codemelli, :mobile, :email, :password, :name, :avatar, 0)"
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

  public function getUserById($id)
  {
    $this->db->query("SELECT * FROM users WHERE id = :id");
    $this->db->bind(":id", $id);
    return $this->db->fetch();
  }

  public function updateUser($id, $data)
  {
    try {
      // اگر فایل جدیدی آپلود شده باشد
      if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        // حذف تصویر قدیمی
        $currentUser = $this->getUserById($id);
        if ($currentUser && $currentUser->avatar) {
          $oldAvatarPath = UploadImage . '/assets/uploads/users/' . $currentUser->avatar;
          if (file_exists($oldAvatarPath)) {
            unlink($oldAvatarPath);
          }
        }

        // آپلود تصویر جدید
        $fileName = time() . '_' . $_FILES['avatar']['name'];
        $targetPath = UploadImage . '/assets/uploads/users/' . $fileName;

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
          $data['avatar'] = $fileName;
        } else {
          throw new Exception("خطا در آپلود تصویر");
        }
      } else {
        // اگر فایل جدید آپلود نشده، از مقدار قبلی استفاده کن
        $currentUser = $this->getUserById($id);
        $data['avatar'] = $currentUser->avatar;
      }

      // بررسی تکراری نبودن موبایل در بین ادمین‌ها
      $this->db->query("SELECT id FROM users WHERE mobile = :mobile AND id != :id AND admin = 1");
      $this->db->bind(':mobile', $data['mobile']);
      $this->db->bind(':id', $id);

      if ($this->db->rowCount() > 0) {
        throw new Exception('این شماره موبایل قبلاً برای یک ادمین ثبت شده است');
      }

      $this->db->query("UPDATE users SET name = :name, email = :email, mobile = :mobile, avatar = :avatar WHERE id = :id");
      $this->db->bind(":id", $id);
      $this->db->bind(":name", $data["name"]);
      $this->db->bind(":email", $data["email"]);
      $this->db->bind(":mobile", $data["mobile"]);
      $this->db->bind(":avatar", $data["avatar"]);
      return $this->db->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function deleteUser($id)
  {
    $this->db->query("DELETE FROM users WHERE id = :id");
    $this->db->bind(":id", $id);
    return $this->db->execute();
  }

  public function getAgentById($id)
  {
    $this->db->query("SELECT * FROM users WHERE id = :id");
    $this->db->bind(":id", $id);
    return $this->db->fetch();
  }

  public function updateAgent($id, $data)
  {
    try {
      // حذف تصویر قدیمی و آپلود تصویر جدید در صورت آپلود
      if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $oldUser = $this->getAgentById($id);
        if ($oldUser && $oldUser->avatar) {
          $oldAvatarPath = UploadImage . '/assets/uploads/users/' . $oldUser->avatar;
          if (file_exists($oldAvatarPath)) {
            unlink($oldAvatarPath);
          }
        }

        // آپلود تصویر جدید
        $fileName = time() . '_' . $_FILES['avatar']['name'];
        $targetPath = UploadImage . '/assets/uploads/users/' . $fileName;

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
          $data['avatar'] = $fileName;
        } else {
          throw new Exception("خطا در آپلود تصویر");
        }
      }

      // شروع ساخت کوئری به‌روزرسانی
      $fields = [
        'name' => ':name',
        'email' => ':email',
        'mobile' => ':mobile'
      ];

      // افزودن فیلدهای اختیاری
      if (!empty($data['avatar'])) {
        $fields['avatar'] = ':avatar';
      }
      if (!empty($data['password'])) {
        $fields['password'] = ':password';
      }

      // ساخت رشته کوئری به‌صورت پویا
      $fieldUpdates = [];
      foreach ($fields as $column => $placeholder) {
        $fieldUpdates[] = "$column = $placeholder";
      }
      $query = "UPDATE users SET " . implode(', ', $fieldUpdates) . " WHERE id = :id";

      $this->db->query($query);

      // بایند کردن مقادیر ثابت
      $this->db->bind(":id", $id);
      $this->db->bind(":name", $data["name"]);
      $this->db->bind(":email", $data["email"]);
      $this->db->bind(":mobile", $data["mobile"]);

      // بایند کردن مقادیر اختیاری
      if (!empty($data['avatar'])) {
        $this->db->bind(":avatar", $data["avatar"]);
      }
      if (!empty($data['password'])) {
        $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);
        $this->db->bind(":password", $hashedPassword);
      }

      return $this->db->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function deleteAgent($id)
  {
    $this->db->query("DELETE FROM users WHERE id = :id");
    $this->db->bind(":id", $id);
    return $this->db->execute();
  }
}
