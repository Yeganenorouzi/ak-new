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

  public function getRecentReceptions($limit = 5)
  {
    try {
      $query = "
            SELECT 
                receptions.id,
                receptions.created_at,
                receptions.product_status,
                customers.name AS customer_name
            FROM receptions
            INNER JOIN customers ON receptions.customer_id = customers.id
            ORDER BY receptions.id DESC
            LIMIT :limit
        ";

      $this->db->query($query);
      $this->db->bind(':limit', $limit);
      $receptions = $this->db->fetchAll();
      return $receptions;
    } catch (Exception $e) {
      echo 'خطا در دریافت آخرین پذیرش‌ها: ' . $e->getMessage();
      return [];
    }
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

  /**
   * Get paginated receptions for the current agent
   * @param int $page Current page number
   * @param int $perPage Number of items per page
   * @return array Array containing receptions and pagination info
   */
  public function getPaginatedReceptionsByAgent($page = 1, $perPage = 10)
  {
    if (!isset($_SESSION["id"])) {
      throw new Exception("User not logged in");
    }

    try {
      // Calculate offset
      $offset = ($page - 1) * $perPage;

      // Get total count for pagination
      $this->db->query("SELECT COUNT(*) as total FROM receptions WHERE user_id = :user_id");
      $this->db->bind(":user_id", $_SESSION["id"]);
      $totalResult = $this->db->fetch();
      $total = $totalResult->total;

      // Get paginated data
      $this->db->query("SELECT 
            receptions.*, serials.serial, serials.model, customers.name
            FROM receptions 
            INNER JOIN serials ON receptions.serial_id = serials.id 
            INNER JOIN customers ON receptions.customer_id = customers.id  
            WHERE receptions.user_id = :user_id
            ORDER BY receptions.id DESC
            LIMIT :limit OFFSET :offset");

      $this->db->bind(":user_id", $_SESSION["id"]);
      $this->db->bind(":limit", $perPage);
      $this->db->bind(":offset", $offset);

      $receptions = $this->db->fetchAll();

      // Calculate pagination info
      $totalPages = ceil($total / $perPage);

      return [
        'receptions' => $receptions,
        'pagination' => [
          'total' => $total,
          'per_page' => $perPage,
          'current_page' => $page,
          'total_pages' => $totalPages
        ]
      ];
    } catch (Exception $e) {
      throw new Exception("Error fetching paginated receptions: " . $e->getMessage());
    }
  }

  /**
   * Get paginated filtered receptions for the current agent
   * @param array $filters Filter parameters
   * @param int $page Current page number
   * @param int $perPage Number of items per page
   * @return array Array containing filtered receptions and pagination info
   */
  public function getPaginatedFilteredReceptionsByAgent($filters, $page = 1, $perPage = 10)
  {
    if (!isset($_SESSION["id"])) {
      throw new Exception("User not logged in");
    }

    try {
      // Calculate offset
      $offset = ($page - 1) * $perPage;

      $query = "
            SELECT 
                receptions.*, 
                serials.serial, 
                serials.model, 
                customers.name
            FROM receptions
            INNER JOIN serials ON receptions.serial_id = serials.id
            INNER JOIN customers ON receptions.customer_id = customers.id
            WHERE receptions.user_id = :user_id
        ";

      $countQuery = "
            SELECT COUNT(*) as total
            FROM receptions
            INNER JOIN serials ON receptions.serial_id = serials.id
            INNER JOIN customers ON receptions.customer_id = customers.id
            WHERE receptions.user_id = :user_id
        ";

      $params = [':user_id' => $_SESSION["id"]];

      if (!empty($filters['reception_number'])) {
        $query .= " AND receptions.id LIKE :reception_number";
        $countQuery .= " AND receptions.id LIKE :reception_number";
        $params[':reception_number'] = "%{$filters['reception_number']}%";
      }

      if (!empty($filters['serial'])) {
        $query .= " AND serials.serial LIKE :serial";
        $countQuery .= " AND serials.serial LIKE :serial";
        $params[':serial'] = "%{$filters['serial']}%";
      }

      if (!empty($filters['model'])) {
        $query .= " AND serials.model LIKE :model";
        $countQuery .= " AND serials.model LIKE :model";
        $params[':model'] = "%{$filters['model']}%";
      }

      if (!empty($filters['customer_name'])) {
        $query .= " AND customers.name LIKE :customer_name";
        $countQuery .= " AND customers.name LIKE :customer_name";
        $params[':customer_name'] = "%{$filters['customer_name']}%";
      }

      if (!empty($filters['codemelli'])) {
        $query .= " AND customers.codemelli LIKE :codemelli";
        $countQuery .= " AND customers.codemelli LIKE :codemelli";
        $params[':codemelli'] = "%{$filters['codemelli']}%";
      }

      if (!empty($filters['mobile'])) {
        $query .= " AND customers.mobile LIKE :mobile";
        $countQuery .= " AND customers.mobile LIKE :mobile";
        $params[':mobile'] = "%{$filters['mobile']}%";
      }

      if (!empty($filters['status'])) {
        $query .= " AND receptions.product_status = :status";
        $countQuery .= " AND receptions.product_status = :status";
        $params[':status'] = $filters['status'];
      }

      if (!empty($filters['date_from'])) {
        $query .= " AND DATE(receptions.created_at) >= :date_from";
        $countQuery .= " AND DATE(receptions.created_at) >= :date_from";
        $params[':date_from'] = $filters['date_from'];
      }

      if (!empty($filters['date_to'])) {
        $query .= " AND DATE(receptions.created_at) <= :date_to";
        $countQuery .= " AND DATE(receptions.created_at) <= :date_to";
        $params[':date_to'] = $filters['date_to'];
      }

      $query .= " ORDER BY receptions.id DESC";

      $this->db->query($query);
      $this->db->query($countQuery);

      // Bind all parameters
      foreach ($params as $key => $value) {
        $this->db->bind($key, $value);
      }

      $receptions = $this->db->fetchAll();
      $totalResult = $this->db->fetch();
      $total = $totalResult->total;

      // Calculate pagination info
      $totalPages = ceil($total / $perPage);

      return [
        'receptions' => $receptions,
        'pagination' => [
          'total' => $total,
          'per_page' => $perPage,
          'current_page' => $page,
          'total_pages' => $totalPages
        ]
      ];
    } catch (Exception $e) {
      echo 'خطا در دریافت اطلاعات: ' . $e->getMessage();
      return [];
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
    $result = $this->db->fetch();

    if ($result !== false) {
      return $result;
    }

    // Step 2: ایجاد سریال جدید
    $this->createSerial($data);

    // Step 3: بازیابی سریال ایجاد شده
    $this->db->query("SELECT id FROM serials WHERE serial = :serial");
    $this->db->bind(':serial', $data['serial']);
    $result = $this->db->fetch();

    if ($result === false) {
      throw new Exception("خطا در ایجاد سریال");
    }

    return $result;
  }

  private function createSerial(array $data): void
  {
    $this->db->query("INSERT INTO serials (serial, serial2, model, title, att1_code, att2_code, att3_code, att4_code, company, sh_sanad, start_guarantee, expite_guarantee, created_at) 
                      VALUES (:serial, :serial2, :model, :title, :att1_code, :att2_code, :att3_code, :att4_code, :company, :sh_sanad, :start_guarantee, :expite_guarantee, NOW())");

    $fields = [
      ':serial' => $data['serial'],
      ':serial2' => $data['serial2'] ?? null,
      ':model' => $data['model'] ?? null,
      ':title' => $data['title'] ?? null,
      ':att1_code' => $data['att1_code'] ?? null,
      ':att2_code' => $data['att2_code'] ?? null,
      ':att3_code' => $data['att3_code'] ?? null,
      ':att4_code' => $data['att4_code'] ?? null,
      ':company' => $data['company'] ?? null,
      ':sh_sanad' => $data['sh_sanad'] ?? null,
      ':start_guarantee' => $data['start_guarantee'] ?? null,
      ':expite_guarantee' => $data['expite_guarantee'] ?? null
    ];

    foreach ($fields as $key => $value) {
      $this->db->bind($key, $value);
    }

    if (!$this->db->execute()) {
      $errorInfo = $this->db->errorInfo();
      if ($errorInfo[0] !== '00000') {
        error_log("Error in createSerial: " . print_r($errorInfo, true));
        throw new Exception("خطا در ثبت اطلاعات سریال: " . $errorInfo[2]);
      }
    }
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
    $this->db->query("INSERT INTO receptions (serial, serial_id, customer_id, user_id, activation_start_date, guarantee_status, repair_status, activation_status,activation_day,
                        problem, situation, accessories, dex, estimated_time, estimated_cost, paziresh_status, product_status, file1, file2, file3, created_at) 
                        VALUES (:serial, :serial_id, :customer_id, :user_id, :activation_start_date, :guarantee_status, :repair_status, :activation_status, :activation_day,
                        :problem, :situation, :accessories, :dex, :estimated_time, :estimated_cost, :paziresh_status, :product_status, :file1, :file2, :file3, NOW())");

    $fields = [
      ':serial' => $data['serial'],
      ':serial_id' => $serial_id,
      ':customer_id' => $customer_id,
      ':user_id' => $_SESSION['id'],
      ':activation_start_date' => $data['activation_start_date'],
      ':guarantee_status' => $data['guarantee_status'],
      ':repair_status' => $data['repair_status'],
      ':activation_status' => $data['activation_status'],
      ':activation_day' => $data['activation_day'],
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
    customers.address ,customers.passport ,customers.codeposti , serials.serial , serials.serial2, serials.model , serials.title ,serials.att1_code ,serials.att2_code ,serials.att3_code ,serials.att4_code ,serials.sh_sanad ,serials.company ,serials.start_guarantee ,serials.expite_guarantee, users.name AS user_name
                      FROM receptions 
                      INNER JOIN serials ON receptions.serial_id = serials.id 
                      INNER JOIN customers ON receptions.customer_id = customers.id 
                      INNER JOIN users ON receptions.user_id = users.id
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

  public function getReceptionCountsByStatusWithDateFilter($startDate, $endDate)
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
        FROM receptions 
        WHERE DATE(created_at) >= :start_date 
        AND DATE(created_at) <= :end_date");

    $this->db->bind(":start_date", $startDate);
    $this->db->bind(":end_date", $endDate);
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
      // لاگ کردن اطلاعات ورودی برای دیباگ
      error_log("در حال بروزرسانی پذیرش با شناسه: " . $id);
      error_log("اطلاعات بروزرسانی: " . print_r($data, true));

      $sql = "UPDATE receptions SET 
            product_status = :product_status,
            kaar = :kaar,
            kaar_serial = :kaar_serial,
            kaar_at = NULLIF(:kaar_at, ''),  /* مدیریت تاریخ خالی */
            sh_baar2 = :sh_baar2,
            sh_baar = :sh_baar,
            file1 = NULLIF(:file1, ''),      /* مدیریت فایل‌های خالی */
            file2 = NULLIF(:file2, ''),
            file3 = NULLIF(:file3, ''),
            activation_status = :activation_status,
            updated_at = :updated_at
            WHERE id = :id";

      $this->db->query($sql);

      // بایند کردن پارامترها با مقادیر پیش‌فرض خالی
      $this->db->bind(':id', $id);
      $this->db->bind(':product_status', $data['product_status'] ?? '');
      $this->db->bind(':kaar', $data['kaar'] ?? '');
      $this->db->bind(':kaar_serial', $data['kaar_serial'] ?? '');
      $this->db->bind(':kaar_at', $data['kaar_at'] ?? '');
      $this->db->bind(':sh_baar2', $data['sh_baar2'] ?? '');
      $this->db->bind(':sh_baar', $data['sh_baar'] ?? '');
      $this->db->bind(':file1', $data['file1'] ?? '');
      $this->db->bind(':file2', $data['file2'] ?? '');
      $this->db->bind(':file3', $data['file3'] ?? '');
      $this->db->bind(':activation_status', $data['activation_status'] ?? '');
      $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

      $result = $this->db->execute();

      if (!$result) {
        $errorInfo = $this->db->getLastError();
        error_log("خطای بروزرسانی دیتابیس: " . print_r($errorInfo, true));
        return [
          'success' => false,
          'error' => 'خطا در بروزرسانی اطلاعات: ' . print_r($errorInfo, true)
        ];
      }

      return ['success' => true];

    } catch (Exception $e) {
      error_log("خطا در تابع updateReception: " . $e->getMessage());
      error_log("جزئیات خطا: " . $e->getTraceAsString());
      return [
        'success' => false,
        'error' => 'خطای سیستمی: ' . $e->getMessage()
      ];
    }
  }

  public function getFilteredReceptions($filters)
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
            WHERE 1=1
        ";

      $params = [];

      if (!empty($filters['reception_number'])) {
        $query .= " AND receptions.id LIKE :reception_number";
        $params[':reception_number'] = "%{$filters['reception_number']}%";
      }

      if (!empty($filters['serial'])) {
        $query .= " AND serials.serial LIKE :serial";
        $params[':serial'] = "%{$filters['serial']}%";
      }

      if (!empty($filters['model'])) {
        $query .= " AND serials.model LIKE :model";
        $params[':model'] = "%{$filters['model']}%";
      }

      if (!empty($filters['customer_name'])) {
        $query .= " AND customers.name LIKE :customer_name";
        $params[':customer_name'] = "%{$filters['customer_name']}%";
      }

      if (!empty($filters['codemelli'])) {
        $query .= " AND customers.codemelli LIKE :codemelli";
        $params[':codemelli'] = "%{$filters['codemelli']}%";
      }

      if (!empty($filters['mobile'])) {
        $query .= " AND customers.mobile LIKE :mobile";
        $params[':mobile'] = "%{$filters['mobile']}%";
      }

      if (!empty($filters['status'])) {
        $query .= " AND receptions.product_status = :status";
        $params[':status'] = $filters['status'];
      }

      if (!empty($filters['date_from'])) {
        $query .= " AND DATE(receptions.created_at) >= :date_from";
        $params[':date_from'] = $filters['date_from'];
      }

      if (!empty($filters['date_to'])) {
        $query .= " AND DATE(receptions.created_at) <= :date_to";
        $params[':date_to'] = $filters['date_to'];
      }

      $query .= " ORDER BY receptions.id DESC";

      $this->db->query($query);

      // Bind all parameters
      foreach ($params as $key => $value) {
        $this->db->bind($key, $value);
      }

      return $this->db->fetchAll();
    } catch (Exception $e) {
      echo 'خطا در دریافت اطلاعات: ' . $e->getMessage();
      return [];
    }
  }

  public function getFilteredReceptionsByAgent($filters)
  {
    if (!isset($_SESSION["id"])) {
      throw new Exception("User not logged in");
    }

    try {
      $query = "
            SELECT 
                receptions.*, 
                serials.serial, 
                serials.model, 
                customers.name
            FROM receptions
            INNER JOIN serials ON receptions.serial_id = serials.id
            INNER JOIN customers ON receptions.customer_id = customers.id
            WHERE receptions.user_id = :user_id
        ";

      $params = [':user_id' => $_SESSION["id"]];

      if (!empty($filters['reception_number'])) {
        $query .= " AND receptions.id LIKE :reception_number";
        $params[':reception_number'] = "%{$filters['reception_number']}%";
      }

      if (!empty($filters['serial'])) {
        $query .= " AND serials.serial LIKE :serial";
        $params[':serial'] = "%{$filters['serial']}%";
      }

      if (!empty($filters['model'])) {
        $query .= " AND serials.model LIKE :model";
        $params[':model'] = "%{$filters['model']}%";
      }

      if (!empty($filters['customer_name'])) {
        $query .= " AND customers.name LIKE :customer_name";
        $params[':customer_name'] = "%{$filters['customer_name']}%";
      }

      if (!empty($filters['status'])) {
        $query .= " AND receptions.product_status = :status";
        $params[':status'] = $filters['status'];
      }

      if (!empty($filters['date_from'])) {
        $query .= " AND DATE(receptions.created_at) >= :date_from";
        $params[':date_from'] = $filters['date_from'];
      }

      if (!empty($filters['date_to'])) {
        $query .= " AND DATE(receptions.created_at) <= :date_to";
        $params[':date_to'] = $filters['date_to'];
      }

      $query .= " ORDER BY receptions.id DESC";

      $this->db->query($query);

      // Bind all parameters
      foreach ($params as $key => $value) {
        $this->db->bind($key, $value);
      }

      return $this->db->fetchAll();
    } catch (Exception $e) {
      echo 'خطا در دریافت اطلاعات: ' . $e->getMessage();
      return [];
    }
  }

  public function hasNonDeliveredReception($serial)
  {
    $this->db->query("SELECT COUNT(*) as cnt
                      FROM receptions r
                      INNER JOIN serials s ON r.serial_id = s.id
                      WHERE s.serial = :serial
                      AND r.product_status != 'تحویل به مشتری'");
    $this->db->bind(':serial', $serial);
    $result = $this->db->fetch();
    return $result && $result->cnt > 0;
  }

  public function getPaginatedReceptions($page = 1, $perPage = 10)
  {
    try {
      $offset = ($page - 1) * $perPage;

      $this->db->query("SELECT COUNT(*) as total FROM receptions");
      $totalResult = $this->db->fetch();
      $total = $totalResult->total;

      $this->db->query("SELECT 
                receptions.*, 
                serials.serial, 
                serials.model, 
                customers.name AS customer_name,
                users.name AS user_name
            FROM receptions
            INNER JOIN serials ON receptions.serial_id = serials.id
            INNER JOIN customers ON receptions.customer_id = customers.id
            INNER JOIN users ON receptions.user_id = users.id
            ORDER BY receptions.id DESC
            LIMIT :limit OFFSET :offset
        ");
      $this->db->bind(":limit", (int) $perPage, PDO::PARAM_INT);
      $this->db->bind(":offset", (int) $offset, PDO::PARAM_INT);

      $receptions = $this->db->fetchAll();
      $totalPages = ceil($total / $perPage);

      return [
        'receptions' => $receptions,
        'pagination' => [
          'total' => $total,
          'per_page' => $perPage,
          'current_page' => $page,
          'total_pages' => $totalPages
        ]
      ];
    } catch (Exception $e) {
      echo 'خطا در دریافت اطلاعات: ' . $e->getMessage();
      return [];
    }
  }

  public function getPaginatedFilteredReceptions($filters, $page = 1, $perPage = 10)
  {
    try {
      $offset = ($page - 1) * $perPage;

      $query = "
            SELECT 
                receptions.*, 
                serials.serial, 
                serials.model, 
                customers.name AS customer_name,
                users.name AS user_name
            FROM receptions
            INNER JOIN serials ON receptions.serial_id = serials.id
            INNER JOIN customers ON receptions.customer_id = customers.id
            INNER JOIN users ON receptions.user_id = users.id
            WHERE 1=1
        ";

      $countQuery = "
            SELECT COUNT(*) as total
            FROM receptions
            INNER JOIN serials ON receptions.serial_id = serials.id
            INNER JOIN customers ON receptions.customer_id = customers.id
            INNER JOIN users ON receptions.user_id = users.id
            WHERE 1=1
        ";

      $params = [];

      if (!empty($filters['reception_number'])) {
        $query .= " AND receptions.id LIKE :reception_number";
        $countQuery .= " AND receptions.id LIKE :reception_number";
        $params[':reception_number'] = "%{$filters['reception_number']}%";
      }
      if (!empty($filters['serial'])) {
        $query .= " AND serials.serial LIKE :serial";
        $countQuery .= " AND serials.serial LIKE :serial";
        $params[':serial'] = "%{$filters['serial']}%";
      }
      if (!empty($filters['model'])) {
        $query .= " AND serials.model LIKE :model";
        $countQuery .= " AND serials.model LIKE :model";
        $params[':model'] = "%{$filters['model']}%";
      }
      if (!empty($filters['customer_name'])) {
        $query .= " AND customers.name LIKE :customer_name";
        $countQuery .= " AND customers.name LIKE :customer_name";
        $params[':customer_name'] = "%{$filters['customer_name']}%";
      }
      if (!empty($filters['codemelli'])) {
        $query .= " AND customers.codemelli LIKE :codemelli";
        $countQuery .= " AND customers.codemelli LIKE :codemelli";
        $params[':codemelli'] = "%{$filters['codemelli']}%";
      }
      if (!empty($filters['mobile'])) {
        $query .= " AND customers.mobile LIKE :mobile";
        $countQuery .= " AND customers.mobile LIKE :mobile";
        $params[':mobile'] = "%{$filters['mobile']}%";
      }
      if (!empty($filters['status'])) {
        $query .= " AND receptions.product_status = :status";
        $countQuery .= " AND receptions.product_status = :status";
        $params[':status'] = $filters['status'];
      }
      if (!empty($filters['date_from'])) {
        $query .= " AND DATE(receptions.created_at) >= :date_from";
        $countQuery .= " AND DATE(receptions.created_at) >= :date_from";
        $params[':date_from'] = $filters['date_from'];
      }
      if (!empty($filters['date_to'])) {
        $query .= " AND DATE(receptions.created_at) <= :date_to";
        $countQuery .= " AND DATE(receptions.created_at) <= :date_to";
        $params[':date_to'] = $filters['date_to'];
      }

      $query .= " ORDER BY receptions.id DESC LIMIT :limit OFFSET :offset";

      // اجرای کوئری شمارش
      $this->db->query($countQuery);
      foreach ($params as $key => $value) {
        $this->db->bind($key, $value);
      }
      $totalResult = $this->db->fetch();
      $total = $totalResult->total;

      // اجرای کوئری داده‌ها
      $this->db->query($query);
      foreach ($params as $key => $value) {
        $this->db->bind($key, $value);
      }
      $this->db->bind(':limit', $perPage);
      $this->db->bind(':offset', $offset);
      $receptions = $this->db->fetchAll();

      $totalPages = ceil($total / $perPage);

      return [
        'receptions' => $receptions,
        'pagination' => [
          'total' => $total,
          'per_page' => $perPage,
          'current_page' => $page,
          'total_pages' => $totalPages
        ]
      ];
    } catch (Exception $e) {
      echo 'خطا در دریافت اطلاعات: ' . $e->getMessage();
      return [];
    }
  }
}
