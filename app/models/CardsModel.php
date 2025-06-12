<?php

class CardsModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCards()
    {
        $this->db->query("SELECT * FROM serials ORDER BY id DESC LIMIT 50 OFFSET 0");
        return $this->db->fetchAll();
    }

    public function getPaginatedCards($limit, $offset)
    {
        // تبدیل پارامترها به عدد صحیح برای اطمینان
        $limit = (int) $limit;
        $offset = (int) $offset;

        // استفاده از مقادیر مستقیم در کوئری به جای placeholder
        $this->db->query("SELECT * FROM serials ORDER BY id DESC LIMIT $limit OFFSET $offset");
        return $this->db->fetchAll();
    }


    public function getTotalCards()
    {
        $this->db->query("SELECT COUNT(*) as total FROM serials");
        $result = $this->db->fetch();
        return $result->total;
    }

    public function getFilteredCards($filters, $limit, $offset)
    {
        // تبدیل پارامترها به عدد صحیح برای اطمینان
        $limit = (int) $limit;
        $offset = (int) $offset;

        $sql = "SELECT * FROM serials WHERE 1=1";
        $params = [];

        // فیلتر بر اساس سریال اول
        if (!empty($filters['serial'])) {
            $sql .= " AND serial LIKE :serial";
            $params[':serial'] = '%' . $filters['serial'] . '%';
        }

        // فیلتر بر اساس سریال دوم
        if (!empty($filters['serial2'])) {
            $sql .= " AND serial2 LIKE :serial2";
            $params[':serial2'] = '%' . $filters['serial2'] . '%';
        }

        // فیلتر بر اساس مدل دستگاه
        if (!empty($filters['model'])) {
            $sql .= " AND model LIKE :model";
            $params[':model'] = '%' . $filters['model'] . '%';
        }

        // فیلتر بر اساس شرکت وارد کننده
        if (!empty($filters['company'])) {
            $sql .= " AND company LIKE :company";
            $params[':company'] = '%' . $filters['company'] . '%';
        }

        // فیلتر بر اساس شماره سند
        if (!empty($filters['sh_sanad'])) {
            $sql .= " AND sh_sanad LIKE :sh_sanad";
            $params[':sh_sanad'] = '%' . $filters['sh_sanad'] . '%';
        }

        // فیلتر بر اساس تاریخ صدور کارت گارانتی (از تاریخ)
        if (!empty($filters['start_guarantee_from'])) {
            $sql .= " AND start_guarantee >= :start_guarantee_from";
            $params[':start_guarantee_from'] = $filters['start_guarantee_from'];
        }

        // فیلتر بر اساس تاریخ صدور کارت گارانتی (تا تاریخ)
        if (!empty($filters['start_guarantee_to'])) {
            $sql .= " AND start_guarantee <= :start_guarantee_to";
            $params[':start_guarantee_to'] = $filters['start_guarantee_to'];
        }

        // فیلتر بر اساس تاریخ انقضا کارت گارانتی (از تاریخ)
        if (!empty($filters['expite_guarantee_from'])) {
            $sql .= " AND expite_guarantee >= :expite_guarantee_from";
            $params[':expite_guarantee_from'] = $filters['expite_guarantee_from'];
        }

        // فیلتر بر اساس تاریخ انقضا کارت گارانتی (تا تاریخ)
        if (!empty($filters['expite_guarantee_to'])) {
            $sql .= " AND expite_guarantee <= :expite_guarantee_to";
            $params[':expite_guarantee_to'] = $filters['expite_guarantee_to'];
        }

        // فیلتر بر اساس وضعیت گارانتی (منقضی شده، فعال، نزدیک به انقضا)
        if (!empty($filters['guarantee_status'])) {
            $today = date('Y-m-d');

            if ($filters['guarantee_status'] == 'expired') {
                $sql .= " AND expite_guarantee < :today";
                $params[':today'] = $today;
            } elseif ($filters['guarantee_status'] == 'active') {
                $sql .= " AND expite_guarantee >= :today";
                $params[':today'] = $today;
            } elseif ($filters['guarantee_status'] == 'expiring_soon') {
                $thirtyDaysLater = date('Y-m-d', strtotime('+30 days'));
                $sql .= " AND expite_guarantee >= :today AND expite_guarantee <= :thirtyDaysLater";
                $params[':today'] = $today;
                $params[':thirtyDaysLater'] = $thirtyDaysLater;
            }
        }

        // اضافه کردن مرتب‌سازی و محدودیت
        $sql .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";

        // اجرای کوئری با پارامترها
        $this->db->query($sql);

        // بایند کردن پارامترها
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->fetchAll();
    }

    public function getTotalFilteredCards($filters)
    {
        $sql = "SELECT COUNT(*) as total FROM serials WHERE 1=1";
        $params = [];

        // فیلتر بر اساس سریال اول
        if (!empty($filters['serial'])) {
            $sql .= " AND serial LIKE :serial";
            $params[':serial'] = '%' . $filters['serial'] . '%';
        }

        // فیلتر بر اساس سریال دوم
        if (!empty($filters['serial2'])) {
            $sql .= " AND serial2 LIKE :serial2";
            $params[':serial2'] = '%' . $filters['serial2'] . '%';
        }

        // فیلتر بر اساس مدل دستگاه
        if (!empty($filters['model'])) {
            $sql .= " AND model LIKE :model";
            $params[':model'] = '%' . $filters['model'] . '%';
        }

        // فیلتر بر اساس شرکت وارد کننده
        if (!empty($filters['company'])) {
            $sql .= " AND company LIKE :company";
            $params[':company'] = '%' . $filters['company'] . '%';
        }

        // فیلتر بر اساس شماره سند
        if (!empty($filters['sh_sanad'])) {
            $sql .= " AND sh_sanad LIKE :sh_sanad";
            $params[':sh_sanad'] = '%' . $filters['sh_sanad'] . '%';
        }

        // فیلتر بر اساس تاریخ صدور کارت گارانتی (از تاریخ)
        if (!empty($filters['start_guarantee_from'])) {
            $sql .= " AND start_guarantee >= :start_guarantee_from";
            $params[':start_guarantee_from'] = $filters['start_guarantee_from'];
        }

        // فیلتر بر اساس تاریخ صدور کارت گارانتی (تا تاریخ)
        if (!empty($filters['start_guarantee_to'])) {
            $sql .= " AND start_guarantee <= :start_guarantee_to";
            $params[':start_guarantee_to'] = $filters['start_guarantee_to'];
        }

        // فیلتر بر اساس تاریخ انقضا کارت گارانتی (از تاریخ)
        if (!empty($filters['expite_guarantee_from'])) {
            $sql .= " AND expite_guarantee >= :expite_guarantee_from";
            $params[':expite_guarantee_from'] = $filters['expite_guarantee_from'];
        }

        // فیلتر بر اساس تاریخ انقضا کارت گارانتی (تا تاریخ)
        if (!empty($filters['expite_guarantee_to'])) {
            $sql .= " AND expite_guarantee <= :expite_guarantee_to";
            $params[':expite_guarantee_to'] = $filters['expite_guarantee_to'];
        }

        // فیلتر بر اساس وضعیت گارانتی (منقضی شده، فعال، نزدیک به انقضا)
        if (!empty($filters['guarantee_status'])) {
            $today = date('Y-m-d');

            if ($filters['guarantee_status'] == 'expired') {
                $sql .= " AND expite_guarantee < :today";
                $params[':today'] = $today;
            } elseif ($filters['guarantee_status'] == 'active') {
                $sql .= " AND expite_guarantee >= :today";
                $params[':today'] = $today;
            } elseif ($filters['guarantee_status'] == 'expiring_soon') {
                $thirtyDaysLater = date('Y-m-d', strtotime('+30 days'));
                $sql .= " AND expite_guarantee >= :today AND expite_guarantee <= :thirtyDaysLater";
                $params[':today'] = $today;
                $params[':thirtyDaysLater'] = $thirtyDaysLater;
            }
        }

        // اجرای کوئری با پارامترها
        $this->db->query($sql);

        // بایند کردن پارامترها
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        $result = $this->db->fetch();
        return $result->total;
    }

    public function getCardBySerial($serial)
    {
        $this->db->query("SELECT * FROM serials WHERE serial = :serial");
        $this->db->bind(':serial', $serial);
        return $this->db->fetch();
    }

    public function createCard($data)
    {
        try {
            // Check if serial already exists
            $existingCard = $this->getCardBySerial($data['serial']);
            if ($existingCard) {
                throw new Exception("این سریال قبلاً در سیستم ثبت شده است");
            }

            // Validate required fields
            if (empty($data['serial'])) {
                throw new Exception("سریال نمی‌تواند خالی باشد");
            }

            if (empty($data['model'])) {
                throw new Exception("مدل دستگاه نمی‌تواند خالی باشد");
            }

            // تنظیم مقادیر پیش‌فرض برای فیلدهای سیستمی
            $data['is_import'] = $data['is_import'] ?? 0;
            $data['added_by_user'] = $data['added_by_user'] ?? 0;
            $data['approved'] = $data['approved'] ?? 0; // Default to pending approval
            $data['did'] = $data['did'] ?? 0;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $this->db->query("INSERT INTO serials
            (code_dastgah, title, coding_derakhtvare, model, att1_code, att1_val, att2_code, att2_val, 
            att3_code, att3_val, att4_code, att4_val, serial, serial2, company, sh_sanad, 
            start_guarantee, expite_guarantee, is_import, added_by_user, approved, did, created_at, updated_at)
            VALUES 
            (:code_dastgah, :title, :coding_derakhtvare, :model, :att1_code, :att1_val, :att2_code, :att2_val,
            :att3_code, :att3_val, :att4_code, :att4_val, :serial, :serial2, :company, :sh_sanad,
            :start_guarantee, :expite_guarantee, :is_import, :added_by_user, :approved, :did, :created_at, :updated_at)");

            // Bind parameters
            $this->db->bind(':code_dastgah', $data['code_dastgah'] ?? null);
            $this->db->bind(':title', $data['title'] ?? null);
            $this->db->bind(':coding_derakhtvare', $data['coding_derakhtvare'] ?? null);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':att1_code', $data['att1_code'] ?? null);
            $this->db->bind(':att1_val', $data['att1_val'] ?? null);
            $this->db->bind(':att2_code', $data['att2_code'] ?? null);
            $this->db->bind(':att2_val', $data['att2_val'] ?? null);
            $this->db->bind(':att3_code', $data['att3_code'] ?? null);
            $this->db->bind(':att3_val', $data['att3_val'] ?? null);
            $this->db->bind(':att4_code', $data['att4_code'] ?? null);
            $this->db->bind(':att4_val', $data['att4_val'] ?? null);
            $this->db->bind(':serial', $data['serial']);
            $this->db->bind(':serial2', $data['serial2'] ?? null);
            $this->db->bind(':company', $data['company'] ?? null);
            $this->db->bind(':sh_sanad', $data['sh_sanad'] ?? null);
            $this->db->bind(':start_guarantee', $data['start_guarantee'] ?? null);
            $this->db->bind(':expite_guarantee', $data['expite_guarantee'] ?? null);
            $this->db->bind(':is_import', $data['is_import']);
            $this->db->bind(':added_by_user', $data['added_by_user']);
            $this->db->bind(':approved', $data['approved']);
            $this->db->bind(':did', $data['did']);
            $this->db->bind(':created_at', $data['created_at']);
            $this->db->bind(':updated_at', $data['updated_at']);

            // Execute the query
            if ($this->db->execute()) {
                return $this->db->lastInsertId();
            } else {
                throw new Exception("خطا در ثبت اطلاعات کارت");
            }

        } catch (PDOException $e) {
            // Handle database-specific errors
            if ($e->getCode() == 23000) { // Duplicate entry error
                throw new Exception("این سریال قبلاً در سیستم ثبت شده است");
            }
            throw new Exception("خطا در ارتباط با پایگاه داده: " . $e->getMessage());
        } catch (Exception $e) {
            throw $e;
        }
    }

    // public function insertSerial($data)
    // {
    //     $this->db->query('INSERT INTO serials (serial, serial2, company, sh_sanad, code_dastgah, title, coding_derakhtvare, model, start_guarantee, expite_guarantee, code_agent_service, att1_code, att1_val, att2_code, att2_val, att3_code, att3_val, att4_code, att4_val, code_guarantee, sharh_guarantee, agent_service) VALUES (:serial, :serial2, :company, :sh_sanad, :code_dastgah, :title, :coding_derakhtvare, :model, :start_guarantee, :expite_guarantee, :code_agent_service, :att1_code, :att1_val, :att2_code, :att2_val, :att3_code, :att3_val, :att4_code, :att4_val, :code_guarantee, :sharh_guarantee, :agent_service)');

    //     // Bind values
    //     $this->db->bind(':serial', $data['serial']);
    //     $this->db->bind(':serial2', $data['serial2']);
    //     $this->db->bind(':company', $data['company']);
    //     $this->db->bind(':sh_sanad', $data['sh_sanad']);
    //     $this->db->bind(':code_dastgah', $data['code_dastgah']);
    //     $this->db->bind(':title', $data['title']);
    //     $this->db->bind(':coding_derakhtvare', $data['coding_derakhtvare']);
    //     $this->db->bind(':model', $data['model']);
    //     $this->db->bind(':start_guarantee', $data['start_guarantee']);
    //     $this->db->bind(':expite_guarantee', $data['expite_guarantee']);
    //     $this->db->bind(':code_agent_service', $data['code_agent_service']);
    //     $this->db->bind(':att1_code', $data['att1_code']);
    //     $this->db->bind(':att1_val', $data['att1_val']);
    //     $this->db->bind(':att2_code', $data['att2_code']);
    //     $this->db->bind(':att2_val', $data['att2_val']);
    //     $this->db->bind(':att3_code', $data['att3_code']);
    //     $this->db->bind(':att3_val', $data['att3_val']);
    //     $this->db->bind(':att4_code', $data['att4_code']);
    //     $this->db->bind(':att4_val', $data['att4_val']);
    //     $this->db->bind(':code_guarantee', $data['code_guarantee']);
    //     $this->db->bind(':sharh_guarantee', $data['sharh_guarantee']);
    //     $this->db->bind(':agent_service', $data['agent_service']);

    //     // Execute
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function getCardById($id)
    {
        $this->db->query("SELECT * FROM serials WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->fetch();
    }

    public function updateCard($id, $data)
    {
        $this->db->query("UPDATE serials SET 
        code_dastgah = :code_dastgah,
        title = :title,
        coding_derakhtvare = :coding_derakhtvare,
        model = :model,
        att1_code = :att1_code,
        att1_val = :att1_val,
        att2_code = :att2_code,
        att2_val = :att2_val,
        att3_code = :att3_code,
        att3_val = :att3_val,
        att4_code = :att4_code,
        att4_val = :att4_val,
        serial = :serial,
        serial2 = :serial2,
        company = :company,
        sh_sanad = :sh_sanad,
        code_guarantee = :code_guarantee,
        sharh_guarantee = :sharh_guarantee,
        code_agent_service = :code_agent_service,
        agent_service = :agent_service,
        start_guarantee = :start_guarantee,
        expite_guarantee = :expite_guarantee,
        updated_at = NOW()
        WHERE id = :id");

        // Bind all parameters
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function deleteCard($id)
    {
        $this->db->query("DELETE FROM serials WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function approveCard($id)
    {
        try {
            // First check if the card exists
            $this->db->query("SELECT id, approved FROM serials WHERE id = :id");
            $this->db->bind(':id', $id);
            $card = $this->db->fetch();

            if (!$card) {
                throw new Exception("کارت گارانتی مورد نظر یافت نشد");
            }

            // Update the card's approved status
            $this->db->query("UPDATE serials SET approved = 1, updated_at = :updated_at WHERE id = :id");
            $this->db->bind(':id', $id);
            $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

            if (!$this->db->execute()) {
                throw new Exception("خطا در تایید کارت گارانتی");
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function rejectCard($id)
    {
        try {
            // First check if the card exists
            $this->db->query("SELECT id, approved FROM serials WHERE id = :id");
            $this->db->bind(':id', $id);
            $card = $this->db->fetch();

            if (!$card) {
                throw new Exception("کارت گارانتی مورد نظر یافت نشد");
            }

            // Update the card's approved status
            $this->db->query("UPDATE serials SET approved = 0, updated_at = :updated_at WHERE id = :id");
            $this->db->bind(':id', $id);
            $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

            if (!$this->db->execute()) {
                throw new Exception("خطا در لغو تایید کارت گارانتی");
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAllCardsWithoutPagination()
    {
        $this->db->query("SELECT * FROM serials");
        return $this->db->fetchAll();
    }

    public function getFilteredCardsWithoutPagination($filters)
    {
        $sql = "SELECT * FROM serials WHERE 1=1";
        $params = [];

        // فیلتر بر اساس سریال اول
        if (!empty($filters['serial'])) {
            $sql .= " AND serial LIKE :serial";
            $params[':serial'] = '%' . $filters['serial'] . '%';
        }

        // فیلتر بر اساس سریال دوم
        if (!empty($filters['serial2'])) {
            $sql .= " AND serial2 LIKE :serial2";
            $params[':serial2'] = '%' . $filters['serial2'] . '%';
        }

        // فیلتر بر اساس مدل دستگاه
        if (!empty($filters['model'])) {
            $sql .= " AND model LIKE :model";
            $params[':model'] = '%' . $filters['model'] . '%';
        }

        // فیلتر بر اساس شرکت وارد کننده
        if (!empty($filters['company'])) {
            $sql .= " AND company LIKE :company";
            $params[':company'] = '%' . $filters['company'] . '%';
        }

        // فیلتر بر اساس شماره سند
        if (!empty($filters['sh_sanad'])) {
            $sql .= " AND sh_sanad LIKE :sh_sanad";
            $params[':sh_sanad'] = '%' . $filters['sh_sanad'] . '%';
        }

        // فیلتر بر اساس تاریخ صدور کارت گارانتی (از تاریخ)
        if (!empty($filters['start_guarantee_from'])) {
            $sql .= " AND start_guarantee >= :start_guarantee_from";
            $params[':start_guarantee_from'] = $filters['start_guarantee_from'];
        }

        // فیلتر بر اساس تاریخ صدور کارت گارانتی (تا تاریخ)
        if (!empty($filters['start_guarantee_to'])) {
            $sql .= " AND start_guarantee <= :start_guarantee_to";
            $params[':start_guarantee_to'] = $filters['start_guarantee_to'];
        }

        // فیلتر بر اساس تاریخ انقضا کارت گارانتی (از تاریخ)
        if (!empty($filters['expite_guarantee_from'])) {
            $sql .= " AND expite_guarantee >= :expite_guarantee_from";
            $params[':expite_guarantee_from'] = $filters['expite_guarantee_from'];
        }

        // فیلتر بر اساس تاریخ انقضا کارت گارانتی (تا تاریخ)
        if (!empty($filters['expite_guarantee_to'])) {
            $sql .= " AND expite_guarantee <= :expite_guarantee_to";
            $params[':expite_guarantee_to'] = $filters['expite_guarantee_to'];
        }

        // فیلتر بر اساس وضعیت گارانتی (منقضی شده، فعال، نزدیک به انقضا)
        if (!empty($filters['guarantee_status'])) {
            $today = date('Y-m-d');

            if ($filters['guarantee_status'] == 'expired') {
                $sql .= " AND expite_guarantee < :today";
                $params[':today'] = $today;
            } elseif ($filters['guarantee_status'] == 'active') {
                $sql .= " AND expite_guarantee >= :today";
                $params[':today'] = $today;
            } elseif ($filters['guarantee_status'] == 'expiring_soon') {
                $thirtyDaysLater = date('Y-m-d', strtotime('+30 days'));
                $sql .= " AND expite_guarantee >= :today AND expite_guarantee <= :thirtyDaysLater";
                $params[':today'] = $today;
                $params[':thirtyDaysLater'] = $thirtyDaysLater;
            }
        }

        // اضافه کردن مرتب‌سازی
        $sql .= " ORDER BY id DESC";

        // اجرای کوئری با پارامترها
        $this->db->query($sql);

        // بایند کردن پارامترها
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->fetchAll();
    }
}
