<?php 
class Profile extends Controller {
    private $userModel; 
    public function __construct() {
        $this->userModel = $this->model("UserModel");
    }

    public function index() {
       return $this->view("public/profile");
    }
}
?>
