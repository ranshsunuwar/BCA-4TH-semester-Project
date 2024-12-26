<?php
// Start the session to access session data
session_start();

// Destroy the session to log the user out
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect the user to the login page or home page
header("Location: ../login_pg/login.html");
exit();
?>
