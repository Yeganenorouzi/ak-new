<?php
class Index extends Controller
{
    public function index()
    {
        // Check if user is already logged in
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            // Redirect to appropriate dashboard based on user role
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                header("location:" . URLROOT . "/dashboard/admin");
            } else {
                header("location:" . URLROOT . "/dashboard/agent");
            }
        } else {
            // User not logged in, redirect to login page
            header("location:" . URLROOT . "/auth/login");
        }
        exit();
    }
}
?>