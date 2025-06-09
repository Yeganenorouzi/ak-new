<?php

class Customers extends Controller
{
    private $customersModel;
    public function __construct()
    {
        $this->customersModel = $this->model("CustomersModel");
    }

    public function index()
    {
        $search_name = $_GET['search_name'] ?? '';
        $search_codemelli = $_GET['search_codemelli'] ?? '';
        $search_mobile = $_GET['search_mobile'] ?? '';
        $search_passport = $_GET['search_passport'] ?? '';
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $per_page = 10;

        $total_results = $this->customersModel->countSearchResults($search_name, $search_codemelli, $search_mobile, $search_passport);
        $total_pages = ceil($total_results / $per_page);

        $data = [
            "customers" => $this->customersModel->searchCustomers($search_name, $search_codemelli, $search_mobile, $search_passport, $page, $per_page),
            "pagination" => [
                "current_page" => $page,
                "total_pages" => $total_pages,
                "total_results" => $total_results,
                "per_page" => $per_page
            ]
        ];
        return $this->view("admin/customers/list", $data);
    }


    public function searchOrCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // تعیین نوع جستجو
            $search_type = $_POST['search_type'] ?? 'codemelli';

            if ($search_type === 'passport') {
                $passport = $_POST['passport'] ?? '';
                $customer = $this->customersModel->getCustomerByPassport($passport);
            } else {
                $codemelli = $_POST['codemelli'] ?? '';
                $customer = $this->customersModel->getCustomerBycodemelli($codemelli);
            }

            if ($customer) {
                echo json_encode([
                    'status' => 'found',
                    'data' => $customer
                ]);
            } else {
                echo json_encode([
                    'status' => 'not_found'
                ]);
            }
        }
    }

    public function createCustomer()
    {
        $data = [
            'codemelli' => $_POST['codemelli'],
            'name' => $_POST['name'],
            'mobile' => $_POST['mobile'],
            'phone' => $_POST['phone'],
            'ostan' => $_POST['ostan'],
            'shahr' => $_POST['shahr'],
            'address' => $_POST['address'],
            'codeposti' => $_POST['codeposti'],
            'passport' => $_POST['passport']
        ];

        $result = $this->customersModel->createCustomer($data);
        if ($result) {
            echo json_encode(['status' => 'created']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function agent()
    {
        $search_name = $_GET['search_name'] ?? '';
        $search_codemelli = $_GET['search_codemelli'] ?? '';
        $search_mobile = $_GET['search_mobile'] ?? '';
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $per_page = 10;

        $total_results = $this->customersModel->countSearchResultsByAgent($search_name, $search_codemelli, $search_mobile);
        $total_pages = ceil($total_results / $per_page);

        $data = [
            "customersAgent" => $this->customersModel->searchCustomersByAgent($search_name, $search_codemelli, $search_mobile, $page, $per_page),
            "pagination" => [
                "current_page" => $page,
                "total_pages" => $total_pages,
                "total_results" => $total_results,
                "per_page" => $per_page
            ]
        ];
        return $this->view("agent/customers/list", $data);
    }

    public function edit($id)
    {
        // ایجاد نمونه از مدل پذیرش‌ها
        $receptionsModel = $this->model("ReceptionsModel");

        $data = [
            "customer" => $this->customersModel->getCustomerById($id),
            "receptions" => $receptionsModel->getReceptionsByCustomerId($id)
        ];
        return $this->view("agent/customers/update", $data);
    }

    public function update($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->customersModel->updateCustomer($id, $_POST);
                header("Location: " . URLROOT . "/customers/agent");
                exit();
            }
            // اگر متد POST نبود، به صفحه قبل برگردد
            header("Location: " . URLROOT . "/customers/edit/" . $id);
            exit();
        } catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            $this->view('agent/customers/update', $data);
        }
    }

    public function delete($id)
    {
        try {
            if ($this->customersModel->deleteCustomer($id)) {
                $_SESSION['success'] = "مشتری با موفقیت حذف شد";
            } else {
                $_SESSION['error'] = "خطا در حذف مشتری";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header("Location: " . URLROOT . "/customers");
        exit();
    }
}
