<?php

class ReceptionsModel
{
  private $db;
  public function __construct()
  {
    $this->db = new Database();
  }


  public function getAllReceptions()
  {
    $this->db->query("SELECT receptions.*, serials.* ,customers.* 
                      FROM receptions 
                      INNER JOIN serials ON receptions.serial_id = serials.id 
                      INNER JOIN customers ON receptions.customer_id = customers.id  
                      ORDER BY receptions.id DESC");
    $receptions = $this->db->fetchAll();
    return $receptions;
  }

  public function getTotalReceptions()
  {
    $this->db->query("SELECT COUNT(*) AS total FROM receptions"); // کوئری برای شمارش رکوردها
    $result = $this->db->fetch(); // گرفتن نتیجه کوئری
    return $result->total;  // دسترسی به مقدار total از شیء نتیجه
  }

  public function getTotalReceptionsByAgent()
  {
    $this->db->query("SELECT COUNT(*) AS total FROM receptions WHERE user_id = :user_id");
    $this->db->bind(":user_id", $_SESSION["user_id"]);
    $result = $this->db->fetch();
    return $result->total;
  }

  public function getAllReceptionsByAgent()
  {
    if (!isset($_SESSION["id"])) {
        throw new Exception("User not logged in");
    }

    try {
        $this->db->query("SELECT 
            receptions.id, receptions.problem, receptions.situation,
            serials.serial, serials.model,
            customers.name, customers.mobile,
            receptions.file1, receptions.file2, receptions.file3 ,
            receptions.created_at
            FROM receptions 
            INNER JOIN serials ON receptions.serial_id = serials.id 
            INNER JOIN customers ON receptions.customer_id = customers.id  
            WHERE receptions.user_id = :user_id
            ORDER BY receptions.id DESC");
            
        $this->db->bind(":user_id", $_SESSION["id"]);
        return $this->db->fetchAll();
    } catch (Exception $e) {
        // لاگ کردن خطا
        throw new Exception("Error fetching receptions: " . $e->getMessage());
    }
  }


  public function createReception($data)
  {
    // فرض می‌کنیم مقدارها از فرم دریافت شده‌اند
    $serialinput = $data['serial'];
    $codemelli = $data['codemelli'];


    // Step 1: گرفتن serials_id
    $this->db->query("SELECT id FROM serials WHERE serial = :serial");
    $this->db->bind(':serial', $serialinput);
    $serial = $this->db->fetch();

    if (!$serial) {
        throw new Exception("سریال مورد نظر یافت نشد");
    }

    // Step 2: گرفتن customers_id
    $queryCustomer = $this->db->query("SELECT id FROM customers WHERE codemelli = :codemelli");
    $this->db->bind(':codemelli', $codemelli);
    $customer = $this->db->fetch();

    // Step 4: ایجاد رکورد در reception
    $queryInsert = $this->db->query("INSERT INTO receptions (serial ,serial_id, customer_id,user_id, activation_start_date, 	guarantee_status, problem, situation ,accessories ,dex,estimated_time,estimated_cost	,paziresh_status,file1,file2,file3,created_at) 
                                 VALUES (:serial, :serials_id, :customers_id, :user_id, :activation_start_date, :guarantee_status, :problem, :situation , :accessories , :dex, :estimated_time, :estimated_cost, :paziresh_status, :file1, :file2, :file3, NOW())");
    $this->db->bind(':serial', $data['serial']);
    $this->db->bind(':serials_id', $serial->id);
    $this->db->bind(':customers_id', $customer->id);
    $this->db->bind(':user_id', $_SESSION['id']);
    $this->db->bind(':activation_start_date', $data['activation_start_date']);
    $this->db->bind(':guarantee_status', $data['guarantee_status']);
    $this->db->bind(':problem', $data['problem']);
    $this->db->bind(':situation', $data['situation']);
    $this->db->bind(':accessories', $data['accessories']);
    $this->db->bind(':dex', $data['dex']);
    $this->db->bind(':estimated_time', $data['estimated_time']);
    $this->db->bind(':estimated_cost', $data['estimated_cost']);
    $this->db->bind(':paziresh_status', $data['paziresh_status']);
    $this->db->bind(':file1', $data['file1']);
    $this->db->bind(':file2', $data['file2']);
    $this->db->bind(':file3', $data['file3']);
    $this->db->bind(':created_at', date('Y-m-d H:i:s'));
    $this->db->execute();

  }


  public function getSerialIdBySerial($serial)
  {
    $this->db->query("SELECT id FROM serials WHERE serial =:serial");
    $this->db->bind(':serial', $serial);

    $result = $this->db->fetch();
    return $result ? $result->id : false;
  }

  public function getUserIdByCodeMelli($codemelli)
  {
    $this->db->query("SELECT id FROM users WHERE codemelli =:codemelli");
    $this->db->bind(':codemelli', $codemelli);

    $result = $this->db->fetch();
    return $result ? $result->id : false;
  }
  public function getCustomerIdByCodeMelli($codemelli)
  {
    $this->db->query("SELECT id FROM customers WHERE codemelli =:codemelli");
    $this->db->bind(':codemelli', $codemelli);

    $result = $this->db->fetch();
    return $result ? $result->id : false;
  }

  public function getOrCreateCustomer($customer_data)
  {
    // بررسی وجود مشتری
    $this->db->query("SELECT * FROM customers WHERE codemelli = :codemelli");
    $this->db->bind(':codemelli', $customer_data['codemelli']);
    $customer = $this->db->fetch();

    if ($customer) {
      // اگر مشتری وجود داشت، برگرداندن آی‌دی
      return $customer->id;
    } else {
      // ایجاد مشتری جدید
      $this->db->query("INSERT INTO customers (codemelli, name, mobile, address) VALUES (:codemelli, :name, :mobile, :address)");
      $this->db->bind(':codemelli', $customer_data['codemelli']);
      $this->db->bind(':name', $customer_data['name']);
      $this->db->bind(':passport', $customer_data['passport']);
      $this->db->bind(':mobile', $customer_data['mobile']);
      $this->db->bind(':phone', $customer_data['phone']);
      $this->db->bind(':ostan', $customer_data['ostan']);
      $this->db->bind(':shahrestan', $customer_data['shahrestan']);
      $this->db->bind(':address', $customer_data['address']);
      $this->db->bind(':code_posti', $customer_data['code_posti']);
      $this->db->execute();
      return $this->db->fetch()->id;
    }
  }
}
