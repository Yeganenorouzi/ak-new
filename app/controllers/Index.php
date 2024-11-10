<?php
class Index extends Controller {
    public function index() {
        header("location:".URLROOT."/auth/login");
    }
}
?>

