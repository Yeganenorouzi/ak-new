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
                serial, serial_id, user_id, customer_id, activation_start_date, guarantee_status, 
                problem, situation, accessories, dex, estimated_time, estimated_cost, 
                product_status, paziresh_status, file1, file2, file3, file4, file5, file6,
                created_at
            ) VALUES (
                :serial, :serial_id, :user_id, :customer_id, :activation_start_date, :guarantee_status, 
                :problem, :situation, :accessories, :dex, :estimated_time, :estimated_cost, 
                :product_status, :paziresh_status, :file1, :file2, :file3, :file4, :file5, :file6, 
                :kaar, :kaar_serial, :kaar_at, :sh_baar, :sh_baar2, 
                :ersal_agent_b_daftar_at, :driaft_daftar_az_agent_at, 
                :ersal_daftar_b_agent_at, :driaft_agent_az_daftar_at, :driaf_moshtari_at, 
                :created_at, :updated_at
            )"
        );

        // مقداردهی مقادیر برای بایند کردن
        $this->db->bind(":serial", trim($data["serial"]));
        $this->db->bind(":serial_id", $data["serial_id"] ?? null);
        $this->db->bind(":user_id", $data["user_id"]);
        $this->db->bind(":customer_id", $data["customer_id"]);
        $this->db->bind(":activation_start_date", $data["activation_start_date"] ?? null);
        $this->db->bind(":guarantee_status", $data["guarantee_status"] ?? null);
        $this->db->bind(":problem", $data["problem"] ?? null);
        $this->db->bind(":situation", $data["situation"] ?? null);
        $this->db->bind(":accessories", $data["accessories"] ?? null);
        $this->db->bind(":dex", $data["dex"] ?? null);
        $this->db->bind(":estimated_time", $data["estimated_time"] ?? null);
        $this->db->bind(":estimated_cost", $data["estimated_cost"] ?? null);
        $this->db->bind(":product_status", $data["product_status"] ?? null);
        $this->db->bind(":paziresh_status", isset($data["paziresh_status"]) ? (bool)$data["paziresh_status"] : false);
        $this->db->bind(":file1", $data["file1"] ?? null);
        $this->db->bind(":file2", $data["file2"] ?? null);
        $this->db->bind(":file3", $data["file3"] ?? null);
        $this->db->bind(":file4", $data["file4"] ?? null);
        $this->db->bind(":file5", $data["file5"] ?? null);
        $this->db->bind(":file6", $data["file6"] ?? null);
        $this->db->bind(":kaar", $data["kaar"] ?? null);
        $this->db->bind(":kaar_serial", $data["kaar_serial"] ?? null);
        $this->db->bind(":kaar_at", $data["kaar_at"] ?? null);
        $this->db->bind(":sh_baar", $data["sh_baar"] ?? null);
        $this->db->bind(":sh_baar2", $data["sh_baar2"] ?? null);
        $this->db->bind(":ersal_agent_b_daftar_at", $data["ersal_agent_b_daftar_at"] ?? null);
        $this->db->bind(":driaft_daftar_az_agent_at", $data["driaft_daftar_az_agent_at"] ?? null);
        $this->db->bind(":ersal_daftar_b_agent_at", $data["ersal_daftar_b_agent_at"] ?? null);
        $this->db->bind(":driaft_agent_az_daftar_at", $data["driaft_agent_az_daftar_at"] ?? null);
        $this->db->bind(":driaf_moshtari_at", $data["driaf_moshtari_at"] ?? null);
        $this->db->bind(":created_at", date('Y-m-d H:i:s'));
        $this->db->bind(":updated_at", date('Y-m-d H:i:s'));

        // اجرای کوئری
        return $this->db->execute();
    } catch (Exception $e) {
        throw $e;
    }
}


  
}
