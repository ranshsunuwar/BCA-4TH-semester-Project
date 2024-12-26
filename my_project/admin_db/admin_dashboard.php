<?php
session_start();

// Check if user is logged in and has the admin role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'hr1') {
    header("Location: ../login_pg/login.html");

    exit();
}
?>
<h1>Welcome, Admin!</h1>
<a href="../login_pg/login.html">Logout</a>


