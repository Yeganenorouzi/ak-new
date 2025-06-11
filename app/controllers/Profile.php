<?php
class Profile extends Controller
{
    public function __construct()
    {
        // هیچ نیازی به model نیست چون فقط redirect می‌کنیم
    }

    public function index()
    {
        // Redirect به Users controller
        header("Location: " . URLROOT . "/users/profile");
        exit();
    }
}
?>