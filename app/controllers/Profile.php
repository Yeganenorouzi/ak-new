<?php 
class Profile extends Controller {
    private $profileModel; 
    public function __construct() {
        $this->profileModel = $this->model("UsersModel");
    }

    public function index() {
       return $this->view("public/profile");
    }
}
?>
