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
        $limit = (int)$limit;
        $offset = (int)$offset;

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

    public function getCardBySerial($serial)
    {
        $this->db->query("SELECT * FROM serials WHERE serial = :serial");
        $this->db->bind(':serial', $serial);
        return $this->db->fetch();
    }

    public function createCard($data)
    {
        try {
            // تنظیم مقادیر پیش‌فرض برای فیلدهای سیستمی
            $data['is_import'] = 0;        // کارت وارداتی نیست
            $data['added_by_user'] = 1;    // کاربر پیش‌فرض با ID = 1
            $data['approved'] = 1;         // تایید شده
            $data['did'] = 0;             // شناسه پیش‌فرض

            $this->db->query("INSERT INTO serials
            (code_dastgah, title, coding_derakhtvare, model, att1_code, att1_val, att2_code, att2_val, 
            att3_code, att3_val, att4_code, att4_val, serial, serial2, company, sh_sanad, 
            code_guarantee, sharh_guarantee, code_agent_service, agent_service, start_guarantee, 
            expite_guarantee, is_import, added_by_user, approved, did , created_at, updated_at) 
            VALUES 
            (:code_dastgah, :title, :coding_derakhtvare, :model, :att1_code, :att1_val, :att2_code, 
            :att2_val, :att3_code, :att3_val, :att4_code, :att4_val, :serial, :serial2, :company, 
            :sh_sanad, :code_guarantee, :sharh_guarantee, :code_agent_service, :agent_service, 
            :start_guarantee, :expite_guarantee, :is_import, :added_by_user, :approved, :did , :created_at, :updated_at)");

            // bind parameters
            $this->db->bind(':code_dastgah', $data['code_dastgah']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':coding_derakhtvare', $data['coding_derakhtvare']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':att1_code', $data['att1_code']);
            $this->db->bind(':att1_val', $data['att1_val']);
            $this->db->bind(':att2_code', $data['att2_code']);
            $this->db->bind(':att2_val', $data['att2_val']);
            $this->db->bind(':att3_code', $data['att3_code']);
            $this->db->bind(':att3_val', $data['att3_val']);
            $this->db->bind(':att4_code', $data['att4_code']);
            $this->db->bind(':att4_val', $data['att4_val']);
            $this->db->bind(':serial', $data['serial']);
            $this->db->bind(':serial2', $data['serial2']);
            $this->db->bind(':company', $data['company']);
            $this->db->bind(':sh_sanad', $data['sh_sanad']);
            $this->db->bind(':code_guarantee', $data['code_guarantee']);
            $this->db->bind(':sharh_guarantee', $data['sharh_guarantee']);
            $this->db->bind(':code_agent_service', $data['code_agent_service']);
            $this->db->bind(':agent_service', $data['agent_service']);
            $this->db->bind(':start_guarantee', $data['start_guarantee']);
            $this->db->bind(':expite_guarantee', $data['expite_guarantee']);
            $this->db->bind(':is_import', $data['is_import']);
            $this->db->bind(':added_by_user', $data['added_by_user']);
            $this->db->bind(':approved', $data['approved']);
            $this->db->bind(':did', $data['did']);
            $this->db->bind(':created_at', date('Y-m-d H:i:s'));
            $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

            if ($this->db->execute()) {
                return true;
            }

            throw new Exception("خطا در ذخیره‌سازی اطلاعات");
        } catch (PDOException $e) {
            // اگر خطای تکراری بودن سریال باشد
            if ($e->getCode() == 23000) {
                throw new Exception("این سریال قبلاً در سیستم ثبت شده است");
            }
            // سایر خطاهای دیتابیس
            throw new Exception("خطا در ارتباط با پایگاه داده: " . $e->getMessage());
        }
    }

    public function insertSerial($data)
    {
        $this->db->query('INSERT INTO serials (serial, serial2, company, sh_sanad, code_dastgah, title, coding_derakhtvare, model, start_guarantee, expite_guarantee, code_agent_service, att1_code, att1_val, att2_code, att2_val, att3_code, att3_val, att4_code, att4_val, code_guarantee, sharh_guarantee, agent_service) VALUES (:serial, :serial2, :company, :sh_sanad, :code_dastgah, :title, :coding_derakhtvare, :model, :start_guarantee, :expite_guarantee, :code_agent_service, :att1_code, :att1_val, :att2_code, :att2_val, :att3_code, :att3_val, :att4_code, :att4_val, :code_guarantee, :sharh_guarantee, :agent_service)');

        // Bind values
        $this->db->bind(':serial', $data['serial']);
        $this->db->bind(':serial2', $data['serial2']);
        $this->db->bind(':company', $data['company']);
        $this->db->bind(':sh_sanad', $data['sh_sanad']);
        $this->db->bind(':code_dastgah', $data['code_dastgah']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':coding_derakhtvare', $data['coding_derakhtvare']);
        $this->db->bind(':model', $data['model']);
        $this->db->bind(':start_guarantee', $data['start_guarantee']);
        $this->db->bind(':expite_guarantee', $data['expite_guarantee']);
        $this->db->bind(':code_agent_service', $data['code_agent_service']);
        $this->db->bind(':att1_code', $data['att1_code']);
        $this->db->bind(':att1_val', $data['att1_val']);
        $this->db->bind(':att2_code', $data['att2_code']);
        $this->db->bind(':att2_val', $data['att2_val']);
        $this->db->bind(':att3_code', $data['att3_code']);
        $this->db->bind(':att3_val', $data['att3_val']);
        $this->db->bind(':att4_code', $data['att4_code']);
        $this->db->bind(':att4_val', $data['att4_val']);
        $this->db->bind(':code_guarantee', $data['code_guarantee']);
        $this->db->bind(':sharh_guarantee', $data['sharh_guarantee']);
        $this->db->bind(':agent_service', $data['agent_service']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }





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
        att4_val = :att4_val
        WHERE id = :id");

        $this->db->bind(':code_dastgah', $data['code_dastgah']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':coding_derakhtvare', $data['coding_derakhtvare']);
        $this->db->bind(':model', $data['model']);
        $this->db->bind(':att1_code', $data['att1_code']);
        $this->db->bind(':att1_val', $data['att1_val']);
        $this->db->bind(':att2_code', $data['att2_code']);
        $this->db->bind(':att2_val', $data['att2_val']);
        $this->db->bind(':att3_code', $data['att3_code']);
        $this->db->bind(':att3_val', $data['att3_val']);
        $this->db->bind(':att4_code', $data['att4_code']);
        $this->db->bind(':att4_val', $data['att4_val']);
        $this->db->bind(':id', $id);

        $this->db->execute();
    }

    public function deleteCard($id)
    {
        $this->db->query("DELETE FROM serials WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getAllCardsWithoutPagination()
    {
        $this->db->query("SELECT * FROM serials");
        return $this->db->fetchAll(); 
       }
}
