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

    public function agent() {
        $data = [
            "receptions" => $this->receptionsModel->getAllReceptionsByAgent()
          ];
        return $this->view("agent/receptions/read",$data);      
    }


    public function create() {
        return $this->view("agent/receptions/create");
    }

    

    

   
}

