<?php

class Customers extends Controller{
    private $customersModel;
    public function __construct()
    {
        $this->customersModel = $this->model("CustomersModel");
    }

    public function index(){
        $data = [
            "customers" => $this->customersModel->getAllCustomers()
        ];
        return $this->view("admin/customers/read", $data);
    }
}