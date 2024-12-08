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

  public function getAllReceptionsByAgent()
  {
    $this->db->query("SELECT receptions.*, serials.* ,customers.* 
                      FROM receptions 
                      INNER JOIN serials ON receptions.serial_id = serials.id 
                      INNER JOIN customers ON receptions.customer_id = customers.id  
                      WHERE receptions.user_id = :user_id
                      ORDER BY receptions.id DESC");
    $this->db->bind(":user_id", $_SESSION["user_id"]);
    return $this->db->fetchAll();
  }


  public function createReception($data)
{
    try {
       

        // آماده‌سازی کوئری SQL
        $this->db->query(
            "INSERT INTO receptions (
                serial,activation_start_date, guarantee_status, 
                problem, situation, accessories, estimated_time, estimated_cost, 
                paziresh_status, file1, file2, file3
               
            ) VALUES (
                :serial, :activation_start_date, :guarantee_status, 
                :problem, :situation, :accessories, :estimated_time, :estimated_cost, 
                :paziresh_status, :file1, :file2, :file3
            )"
        );  

        // مقداردهی مقادیر برای بایند کردن
        $this->db->bind(":serial", trim($data["serial"]));
        $this->db->bind(":activation_start_date", $data["activation_start_date"] ?? null);
        $this->db->bind(":guarantee_status", $data["guarantee_status"] ?? null);
        $this->db->bind(":problem", $data["problem"] ?? null);
        $this->db->bind(":situation", $data["situation"] ?? null);
        $this->db->bind(":accessories", $data["accessories"] ?? null);
        $this->db->bind(":estimated_time", $data["estimated_time"] ?? null);
        $this->db->bind(":estimated_cost", $data["estimated_cost"] ?? null);
        $this->db->bind(":paziresh_status", isset($data["paziresh_status"]) ? (bool)$data["paziresh_status"] : false);
        $this->db->bind(":file1", $data["file1"] ?? null);
        $this->db->bind(":file2", $data["file2"] ?? null);
        $this->db->bind(":file3", $data["file3"] ?? null);
        $this->db->bind(":created_at", date('Y-m-d H:i:s'));
        $this->db->bind(":updated_at", date('Y-m-d H:i:s'));

        // اجرای کوئری
        return $this->db->execute();
    } catch (Exception $e) {
        throw $e;
    }
    
}

  public function getSerialIdBySerial($serial) {
    $this->db->query("SELECT id FROM serials WHERE serial =:serial");
    $this->db->bind(':serial', $serial);
    
    $result = $this->db->fetch();
    return $result ? $result->id : false;
  }

  public function getUserIdByCodeMelli($codemelli) {
    $this->db->query("SELECT id FROM users WHERE codemelli =:codemelli");
    $this->db->bind(':codemelli', $codemelli);
    
    $result = $this->db->fetch();
    return $result ? $result->id : false;
  }
  public function getCustomerIdByCodeMelli($codemelli) {
    $this->db->query("SELECT id FROM customers WHERE codemelli =:codemelli");
    $this->db->bind(':codemelli', $codemelli);
    
    $result = $this->db->fetch();
    return $result ? $result->id : false;
  }

  public function getOrCreateCustomer($customer_data) {
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
