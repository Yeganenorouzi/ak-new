<?php 
class Dashboard extends Controller{

  public function __construct()
  {
    if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
      header("Location: " . URLROOT . "/auth/login");
      exit();
    }
  }
  public function admin(){
    return $this->view("admin/dashboard/index");
  
    
  }

  public function user(){
    return $this->view("user/dashboard/index");

  }

}