<?php

class CustomersModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCustomers()
    {
        $this->db->query("SELECT * FROM customers");
        return $this->db->fetchAll();
    }

    public function getCustomerBycodemelli($codemelli)
    {
        $this->db->query("SELECT * FROM customers WHERE codemelli = :codemelli");
        $this->db->bind(':codemelli', $codemelli);
        return $this->db->fetch();
    }

    public function createCustomer($data)
    {
        $this->db->query("INSERT INTO customers (name, codemelli, phone, address, mobile, passport, ostan, shahr, address, codeposti) 
                          VALUES (:name, :codemelli, :phone, :address, :mobile, :passport, :ostan, :shahr, :address, :codeposti)");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':codemelli', $data['codemelli']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':passport', $data['passport']);
        $this->db->bind(':ostan', $data['ostan']);
        $this->db->bind(':shahr', $data['shahr']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':codeposti', $data['codeposti']);


        return $this->db->execute();
    }

    public function getAllCustomersByAgent()
    {
        $this->db->query("SELECT DISTINCT customers .* 
                          FROM customers 
                          INNER JOIN receptions ON receptions.customer_id = customers.id 
                          WHERE receptions.user_id = :user_id");
        $this->db->bind(':user_id', $_SESSION['id']);
        return $this->db->fetchAll();
    }

    public function getCustomerById($id)
    {
        $this->db->query("SELECT * FROM customers WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->fetch();
    }

    public function updateCustomer($id, $data)
    {
        $this->db->query("UPDATE customers SET name = :name, codemelli = :codemelli, phone = :phone, mobile = :mobile, passport = :passport, ostan = :ostan, shahr = :shahr, address = :address, codeposti = :codeposti WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':codemelli', $data['codemelli']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':passport', $data['passport']);
        $this->db->bind(':ostan', $data['ostan']);
        $this->db->bind(':shahr', $data['shahr']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':codeposti', $data['codeposti']);
        return $this->db->execute();
    }

    public function getCustomerByPassport($passport)
    {
        $this->db->query("SELECT * FROM customers WHERE passport = :passport");
        $this->db->bind(':passport', $passport);
        return $this->db->fetch();
    }

    public function searchCustomers($search_name = '', $search_codemelli = '', $search_mobile = '', $search_passport = '', $page = 1, $per_page = 20)
    {
        $offset = ($page - 1) * $per_page;
        $sql = "SELECT * FROM customers WHERE 1=1";
        $params = [];

        if (!empty($search_name)) {
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $search_name . '%';
        }

        if (!empty($search_codemelli)) {
            $sql .= " AND codemelli LIKE :codemelli";
            $params[':codemelli'] = '%' . $search_codemelli . '%';
        }

        if (!empty($search_mobile)) {
            $sql .= " AND mobile LIKE :mobile";
            $params[':mobile'] = '%' . $search_mobile . '%';
        }

        if (!empty($search_passport)) {
            $sql .= " AND passport LIKE :passport";
            $params[':passport'] = '%' . $search_passport . '%';
        }

        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $params[':limit'] = $per_page;
        $params[':offset'] = $offset;

        $this->db->query($sql);

        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->fetchAll();
    }

    public function countSearchResults($search_name = '', $search_codemelli = '', $search_mobile = '', $search_passport = '')
    {
        $sql = "SELECT COUNT(*) as total FROM customers WHERE 1=1";
        $params = [];

        if (!empty($search_name)) {
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $search_name . '%';
        }

        if (!empty($search_codemelli)) {
            $sql .= " AND codemelli LIKE :codemelli";
            $params[':codemelli'] = '%' . $search_codemelli . '%';
        }

        if (!empty($search_mobile)) {
            $sql .= " AND mobile LIKE :mobile";
            $params[':mobile'] = '%' . $search_mobile . '%';
        }

        if (!empty($search_passport)) {
            $sql .= " AND passport LIKE :passport";
            $params[':passport'] = '%' . $search_passport . '%';
        }

        $this->db->query($sql);

        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        $result = $this->db->fetch();
        return $result->total;
    }

    public function deleteCustomer($id)
    {
        $this->db->query("DELETE FROM customers WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function searchCustomersByAgent($search_name = '', $search_codemelli = '', $search_mobile = '', $page = 1, $per_page = 10)
    {
        $offset = ($page - 1) * $per_page;
        $sql = "SELECT DISTINCT customers.* 
                FROM customers 
                INNER JOIN receptions ON receptions.customer_id = customers.id 
                WHERE receptions.user_id = :user_id";
        $params = [':user_id' => $_SESSION['id']];

        if (!empty($search_name)) {
            $sql .= " AND customers.name LIKE :name";
            $params[':name'] = '%' . $search_name . '%';
        }

        if (!empty($search_codemelli)) {
            $sql .= " AND customers.codemelli LIKE :codemelli";
            $params[':codemelli'] = '%' . $search_codemelli . '%';
        }

        if (!empty($search_mobile)) {
            $sql .= " AND customers.mobile LIKE :mobile";
            $params[':mobile'] = '%' . $search_mobile . '%';
        }

        $sql .= " ORDER BY customers.id DESC LIMIT :limit OFFSET :offset";
        $params[':limit'] = $per_page;
        $params[':offset'] = $offset;

        $this->db->query($sql);

        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->fetchAll();
    }

    public function countSearchResultsByAgent($search_name = '', $search_codemelli = '', $search_mobile = '')
    {
        $sql = "SELECT COUNT(DISTINCT customers.id) as total 
                FROM customers 
                INNER JOIN receptions ON receptions.customer_id = customers.id 
                WHERE receptions.user_id = :user_id";
        $params = [':user_id' => $_SESSION['id']];

        if (!empty($search_name)) {
            $sql .= " AND customers.name LIKE :name";
            $params[':name'] = '%' . $search_name . '%';
        }

        if (!empty($search_codemelli)) {
            $sql .= " AND customers.codemelli LIKE :codemelli";
            $params[':codemelli'] = '%' . $search_codemelli . '%';
        }

        if (!empty($search_mobile)) {
            $sql .= " AND customers.mobile LIKE :mobile";
            $params[':mobile'] = '%' . $search_mobile . '%';
        }

        $this->db->query($sql);

        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        $result = $this->db->fetch();
        return $result->total;
    }
}