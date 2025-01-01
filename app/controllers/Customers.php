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
        $data = [
            "customers" => $this->customersModel->getAllCustomers()
        ];
        return $this->view("admin/customers/read", $data);
    }


    public function searchOrCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codemelli = $_POST['codemelli'];

            // Search for national code in the database
            $customer = $this->customersModel->getCustomerBycodemelli($codemelli);

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
        $data = [
            "customersAgent" => $this->customersModel->getAllCustomersByAgent()
        ];
        return $this->view("agent/customers/read", $data);
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
}
