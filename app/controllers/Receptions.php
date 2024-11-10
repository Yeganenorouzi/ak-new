<?php

class Receptions extends Controller
{
    private $receptionsModel;
    public function __construct()
    {
        $this->receptionsModel = $this->model("ReceptionsModel");
    }

    public function admin() {
        $data = [
            "receptions" => $this->receptionsModel->getAllReceptions()
          ];
        return $this->view("admin/receptions/read",$data);      
    }

   
}

