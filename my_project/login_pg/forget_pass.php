<?php
session_start();
include('../login_pg/log_db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if email exists
    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a reset token
        $token = bin2hex(random_bytes(32));
        $query = "UPDATE users SET reset_token = ?, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $token, $email);
        if ($stmt->execute()) {
            // Simulate sending an email
            echo "Password reset link: <a href='reset_password.php?token=$token'>Reset Password</a>";
        }
    } else {
        echo "Email not found!";
    }
    exit;
}
?>


