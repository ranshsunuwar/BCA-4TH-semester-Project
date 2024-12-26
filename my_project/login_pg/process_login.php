<?php
// Include database connection
include 'log_db_conn.php';
session_start();

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check the user
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password (use password_verify if hashed)
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['category'] = $user['category']; // Save category in the session

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: ../admin_db/admin_dashboard.php");
            } elseif ($user['role'] === 'employee') {
                header("Location: ../employee_db/employee_dashboard.php");
            } elseif ($user['role'] === 'chief') {
                header("Location: ../chief_db/chief_dashboard.php");
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
