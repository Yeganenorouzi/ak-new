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
    $this->db->query("SELECT receptions.*, serials.serial ,serials.model ,customers.name
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

    // Step 2: گرفتن یا ایجاد customers_id
    $customer_data = [
      'codemelli' => $data['codemelli'],
      'name' => $data['name'] ?? null,
      'passport' => $data['passport'] ?? null,
      'mobile' => $data['mobile'] ?? null,
      'phone' => $data['phone'] ?? null,
      'ostan' => $data['ostan'] ?? null,
      'shahr' => $data['shahr'] ?? null,
      'address' => $data['address'] ?? null,
      'codeposti' => $data['codeposti'] ?? null
    ];

    $customer_id = $this->getOrCreateCustomer($customer_data);

    // Step 4: ایجاد رکورد در reception
    $queryInsert = $this->db->query("INSERT INTO receptions (serial ,serial_id, customer_id,user_id, activation_start_date, 	guarantee_status, problem, situation ,accessories ,dex,estimated_time,estimated_cost	,paziresh_status,file1,file2,file3,created_at) 
                                 VALUES (:serial, :serials_id, :customers_id, :user_id, :activation_start_date, :guarantee_status, :problem, :situation , :accessories , :dex, :estimated_time, :estimated_cost, :paziresh_status, :file1, :file2, :file3, NOW())");
    $this->db->bind(':serial', $data['serial']);
    $this->db->bind(':serials_id', $serial->id);
    $this->db->bind(':customers_id', $customer_id);
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
      $this->db->query("INSERT INTO customers (codemelli, name, passport, mobile, phone, ostan, shahr, address, codeposti) 
                        VALUES (:codemelli, :name, :passport, :mobile, :phone, :ostan, :shahr, :address, :codeposti)");
      $this->db->bind(':codemelli', $customer_data['codemelli']);
      $this->db->bind(':name', $customer_data['name']);
      $this->db->bind(':passport', $customer_data['passport']);
      $this->db->bind(':mobile', $customer_data['mobile']);
      $this->db->bind(':phone', $customer_data['phone']);
      $this->db->bind(':ostan', $customer_data['ostan']);
      $this->db->bind(':shahr', $customer_data['shahr']);
      $this->db->bind(':address', $customer_data['address']);
      $this->db->bind(':codeposti', $customer_data['codeposti']);
      $this->db->execute();
      return $this->db->fetch()->id;
    }
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



  public function getReceptionById($id)
  {
    $this->db->query("SELECT receptions.* , customers.name , customers.codemelli ,customers.phone ,customers.mobile ,customers.ostan , customers.shahr ,
    customers.address ,customers.passport ,customers.codeposti , serials.serial , serials.serial2, serials.model , serials.title ,serials.att1_code ,serials.att2_code ,serials.att3_code ,serials.att4_code ,serials.sh_sanad ,serials.company ,serials.start_guarantee ,serials.expite_guarantee 
                      FROM receptions 
                      INNER JOIN serials ON receptions.serial_id = serials.id 
                      INNER JOIN customers ON receptions.customer_id = customers.id 
                      WHERE receptions.id = :id");
    $this->db->bind(':id', $id);
    return $this->db->fetch();
  }

  public function updateReception($id, $data)
  {
    $this->db->query("UPDATE receptions SET   product_status = :product_status , kaar = :kaar , kaar_serial = :kaar_serial , kaar_at = :kaar_at ,  sh_baar2 = :sh_baar2 , sh_baar = :sh_baar WHERE id = :id");
    $this->db->bind(':id', $id);
    $this->db->bind(':product_status', $data['product_status']);
    $this->db->bind(':kaar', $data['kaar']);
    $this->db->bind(':kaar_serial', $data['kaar_serial']);
    $this->db->bind(':kaar_at', $data['kaar_at']);
    $this->db->bind(':sh_baar2', $data['sh_baar2']);
    $this->db->bind(':sh_baar', $data['sh_baar']);
    $this->db->execute();
  }
}
