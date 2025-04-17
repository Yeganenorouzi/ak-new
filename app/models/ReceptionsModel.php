<?php

class Receptionsmodel
{
  private $db;
  public function __construct()
  {
    $this->db = new Database();
  }


  public function getAllReceptions()
  {
    try {
      $query = "
            SELECT 
                receptions.*, 
                serials.serial, 
                serials.model, 
                customers.name AS customer_name,
                customers.codemelli,
                customers.mobile,
                customers.address,
                users.name AS user_name
            FROM receptions
            INNER JOIN serials ON receptions.serial_id = serials.id
            INNER JOIN customers ON receptions.customer_id = customers.id
            INNER JOIN users ON receptions.user_id = users.id
            ORDER BY receptions.id DESC
        ";

      $this->db->query($query);
      $receptions = $this->db->fetchAll();
      return $receptions;
    } catch (Exception $e) {
      // در صورت بروز خطا، پیام خطا را می‌گیرد
      echo 'خطا در دریافت اطلاعات: ' . $e->getMessage();
    }
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
    $this->db->bind(":user_id", $_SESSION["id"]);
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
            receptions.*, serials.serial ,serials.model ,customers.name
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




  public function createReception(array $data): bool
  {
    try {
      // Step 1: یافتن سریال
      $serial = $this->findSerialById($data['serial']);
      if (!$serial) {
        throw new Exception("سریال مورد نظر یافت نشد");
      }

      // Step 2: گرفتن یا ایجاد مشتری
      $customer_data = $this->extractCustomerData($data);
      $customer_id = $this->getOrCreateCustomer($customer_data);

      if (!$customer_id) {
        throw new Exception("خطا در ایجاد یا دریافت اطلاعات مشتری");
      }

      // Step 3: درج اطلاعات پذیرش
      $this->insertReception($data, $serial->id, $customer_id);

      return true;
    } catch (Exception $e) {
      error_log("Error in createReception: " . $e->getMessage());
      throw new Exception("خطا در پردازش پذیرش: " . $e->getMessage());
    }
  }

  private function findSerialById(string $serial): ?object
  {
    $this->db->query("SELECT id FROM serials WHERE serial = :serial");
    $this->db->bind(':serial', $serial);
    return $this->db->fetch();
  }

  private function extractCustomerData(array $data): array
  {
    return [
      'codemelli' => $data['codemelli'],
      'name' => $data['name'] ?? null,
      'passport' => $data['passport'] ?? null,
      'mobile' => $data['mobile'] ?? null,
      'phone' => $data['phone'] ?? null,
      'ostan' => $data['ostan'] ?? null,
      'shahr' => $data['shahr'] ?? null,
      'address' => $data['address'] ?? null,
      'codeposti' => $data['codeposti'] ?? null,
    ];
  }

  private function getOrCreateCustomer(array $customer_data): int
  {
    $customer_id = $this->getCustomerIdByCodeMelli($customer_data['codemelli']);
    if (!$customer_id) {
      $this->createCustomer($customer_data);
      $customer_id = $this->getCustomerIdByCodeMelli($customer_data['codemelli']);
    }
    return $customer_id;
  }

  private function createCustomer(array $customer_data): void
  {
    $this->db->query("INSERT INTO customers (codemelli, name, passport, mobile, phone, ostan, shahr, address, codeposti ,created_at) VALUES (:codemelli, :name, :passport, :mobile, :phone, :ostan, :shahr, :address, :codeposti ,NOW())");
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
  }

  private function insertReception(array $data, int $serial_id, int $customer_id): void
  {
    $this->db->query("INSERT INTO receptions (serial, serial_id, customer_id, user_id, activation_start_date, guarantee_status, 
                        problem, situation, accessories, dex, estimated_time, estimated_cost, paziresh_status, product_status, file1, file2, file3, created_at) 
                        VALUES (:serial, :serials_id, :customers_id, :user_id, :activation_start_date, :guarantee_status, 
                        :problem, :situation, :accessories, :dex, :estimated_time, :estimated_cost, :paziresh_status, :product_status, :file1, :file2, :file3, NOW())");

    $fields = [
      ':serial' => $data['serial'],
      ':serials_id' => $serial_id,
      ':customers_id' => $customer_id,
      ':user_id' => $_SESSION['id'],
      ':activation_start_date' => $data['activation_start_date'],
      ':guarantee_status' => $data['guarantee_status'],
      ':problem' => $data['problem'],
      ':situation' => $data['situation'],
      ':accessories' => $data['accessories'],
      ':dex' => $data['dex'],
      ':estimated_time' => $data['estimated_time'],
      ':estimated_cost' => $data['estimated_cost'],
      ':paziresh_status' => $data['paziresh_status'],
      ':product_status' => 'پذیرش در نمایندگی',
      ':file1' => $data['file1'],
      ':file2' => $data['file2'],
      ':file3' => $data['file3']
    ];

    foreach ($fields as $key => $value) {
      $this->db->bind($key, $value);
    }

    if (!$this->db->execute()) {
      $errorInfo = $this->db->errorInfo(); // Use standard PDO errorInfo() method
      if ($errorInfo[0] !== '00000') { // Only throw if there's actually an error
        error_log("Error in insertReception: " . print_r($errorInfo, true));
        throw new Exception("خطا در ثبت اطلاعات پذیرش: " . $errorInfo[2]); // Use the error message
      }
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


  public function getReceptionsByCustomerId($customerId)
  {
    $this->db->query("SELECT receptions.*, serials.model, serials.serial
                      FROM receptions 
                      INNER JOIN serials ON receptions.serial_id = serials.id 
                      WHERE receptions.customer_id = :customer_id
                      ORDER BY receptions.created_at DESC");
    $this->db->bind(':customer_id', $customerId);
    return $this->db->fetchAll();
  }

  public function getReceptionCountsByStatus()
  {
    $this->db->query("SELECT 
        SUM(CASE WHEN product_status = 'دریافت از دفتر مرکزی' THEN 1 ELSE 0 END) as status1,
        SUM(CASE WHEN product_status = 'پذیرش در نمایندگی' THEN 1 ELSE 0 END) as status2,
        SUM(CASE WHEN product_status = 'ارسال از نمایندگی به دفتر مرکزی' THEN 1 ELSE 0 END) as status3,
        SUM(CASE WHEN product_status = 'در انتظار تکمیل مدارک' THEN 1 ELSE 0 END) as status4,
        SUM(CASE WHEN product_status = 'ارسال از دفتر مرکزی به نمایندگی' THEN 1 ELSE 0 END) as status5,
        SUM(CASE WHEN product_status = 'تحویل به مشتری' THEN 1 ELSE 0 END) as status6,
        SUM(CASE WHEN product_status = 'دریافت از نمایندگی' THEN 1 ELSE 0 END) as status7,
        SUM(CASE WHEN product_status = 'در انتظار کارشناسی' THEN 1 ELSE 0 END) as status8,
        SUM(CASE WHEN product_status = 'در انتظار قطعه' THEN 1 ELSE 0 END) as status9,
        SUM(CASE WHEN product_status = 'در حال تعویض' THEN 1 ELSE 0 END) as status10,
        SUM(CASE WHEN product_status = 'در حال انجام کار در دفتر مرکزی' THEN 1 ELSE 0 END) as status11,
        SUM(CASE WHEN product_status = 'اتمام تعمیر' THEN 1 ELSE 0 END) as status12,
        SUM(CASE WHEN product_status = 'در انتظار تایید هزینه' THEN 1 ELSE 0 END) as status13,
        SUM(CASE WHEN product_status = 'عدم موافقت با هزینه - مرجوع' THEN 1 ELSE 0 END) as status14
        FROM receptions");

    $result = $this->db->fetch();

    return [
      $result->status1 ?? 0,
      $result->status2 ?? 0,
      $result->status3 ?? 0,
      $result->status4 ?? 0,
      $result->status5 ?? 0,
      $result->status6 ?? 0,
      $result->status7 ?? 0,
      $result->status8 ?? 0,
      $result->status9 ?? 0,
      $result->status10 ?? 0,
      $result->status11 ?? 0,
      $result->status12 ?? 0,
      $result->status13 ?? 0,
      $result->status14 ?? 0
    ];
  }

  public function getReceptionCountsByStatusForAgent()
  {
    $this->db->query("SELECT 
        SUM(CASE WHEN product_status = 'دریافت از دفتر مرکزی' THEN 1 ELSE 0 END) as status1,
        SUM(CASE WHEN product_status = 'پذیرش در نمایندگی' THEN 1 ELSE 0 END) as status2,
        SUM(CASE WHEN product_status = 'ارسال از نمایندگی به دفتر مرکزی' THEN 1 ELSE 0 END) as status3,
        SUM(CASE WHEN product_status = 'در انتظار تکمیل مدارک' THEN 1 ELSE 0 END) as status4,
        SUM(CASE WHEN product_status = 'ارسال از دفتر مرکزی به نمایندگی' THEN 1 ELSE 0 END) as status5,
        SUM(CASE WHEN product_status = 'تحویل به مشتری' THEN 1 ELSE 0 END) as status6,
        SUM(CASE WHEN product_status = 'دریافت از نمایندگی' THEN 1 ELSE 0 END) as status7,
        SUM(CASE WHEN product_status = 'در انتظار کارشناسی' THEN 1 ELSE 0 END) as status8,
        SUM(CASE WHEN product_status = 'در انتظار قطعه' THEN 1 ELSE 0 END) as status9,
        SUM(CASE WHEN product_status = 'در حال تعویض' THEN 1 ELSE 0 END) as status10,
        SUM(CASE WHEN product_status = 'در حال انجام کار در دفتر مرکزی' THEN 1 ELSE 0 END) as status11,
        SUM(CASE WHEN product_status = 'اتمام تعمیر' THEN 1 ELSE 0 END) as status12,
        SUM(CASE WHEN product_status = 'در انتظار تایید هزینه' THEN 1 ELSE 0 END) as status13,
        SUM(CASE WHEN product_status = 'عدم موافقت با هزینه - مرجوع' THEN 1 ELSE 0 END) as status14
        FROM receptions WHERE user_id = :user_id");

    $this->db->bind(":user_id", $_SESSION["id"]);
    $result = $this->db->fetch();

    return [
      $result->status1 ?? 0,
      $result->status2 ?? 0,
      $result->status3 ?? 0,
      $result->status4 ?? 0,
      $result->status5 ?? 0,
      $result->status6 ?? 0,
      $result->status7 ?? 0,
      $result->status8 ?? 0,
      $result->status9 ?? 0,
      $result->status10 ?? 0,
      $result->status11 ?? 0,
      $result->status12 ?? 0,
      $result->status13 ?? 0,
      $result->status14 ?? 0
    ];
  }

  public function updateReception($id, $data)
  {
    try {
      $this->db->query("UPDATE receptions SET  
          product_status = :product_status, 
          kaar = :kaar, 
          kaar_serial = :kaar_serial, 
          kaar_at = :kaar_at,  
          sh_baar2 = :sh_baar2, 
          sh_baar = :sh_baar,
          file1 = :file1,
          file2 = :file2,
          file3 = :file3,
          updated_at = :updated_at 
          WHERE id = :id");

      $this->db->bind(':id', $id);
      $this->db->bind(':product_status', $data['product_status']);
      $this->db->bind(':kaar', $data['kaar']);
      $this->db->bind(':kaar_serial', $data['kaar_serial']);
      $this->db->bind(':kaar_at', $data['kaar_at']);
      $this->db->bind(':sh_baar2', $data['sh_baar2']);
      $this->db->bind(':sh_baar', $data['sh_baar']);
      $this->db->bind(':file1', $data['file1'] ?? '');
      $this->db->bind(':file2', $data['file2'] ?? '');
      $this->db->bind(':file3', $data['file3'] ?? '');
      $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

      $result = $this->db->execute();
      if (!$result) {
        $errorInfo = $this->db->errorInfo(); // دریافت اطلاعات خطا
        error_log("خطا در به‌روزرسانی دیتابیس: " . print_r($errorInfo, true));
        error_log("SQL Query: UPDATE receptions SET product_status = '{$data['product_status']}', kaar = '{$data['kaar']}', kaar_serial = '{$data['kaar_serial']}', kaar_at = '{$data['kaar_at']}', sh_baar2 = '{$data['sh_baar2']}', sh_baar = '{$data['sh_baar']}', file1 = '{$data['file1']}', file2 = '{$data['file2']}', file3 = '{$data['file3']}', updated_at = '" . date('Y-m-d H:i:s') . "' WHERE id = $id");
        return $errorInfo; // برگرداندن خطا برای کنترلر
      }
      return $result; // true در صورت موفقیت
    } catch (Exception $e) {
      error_log("Exception in updateReception: " . $e->getMessage());
      error_log("Stack trace: " . $e->getTraceAsString());
      return [0, 0, $e->getMessage()];
    }
  }
}
