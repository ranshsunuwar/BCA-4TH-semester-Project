<?php
session_start();

// Include database connection
include '../includes/db_connect.php';

// Ensure user is logged in and session contains necessary data
if (!isset($_SESSION['user_id']) || !isset($_SESSION['category'])) {
    header("Location: ../login_pg/login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$category = $_SESSION['category']; // 'teaching' or 'non-teaching'

// Check category and decide who the first approver is
if ($category === 'teaching') {
    $first_approver = 'admin'; // Or 'hod' if you have separate HOD
} else {
    $first_approver = 'chief'; // Non-teaching staff sends directly to Chief
}

// Ensure the form data is available
if (isset($_POST['leave_type'], $_POST['start_date'], $_POST['end_date'])) {
    // Prepare SQL query to insert leave request
    $sql = "INSERT INTO leave_requests (user_id, first_approver, leave_type, start_date, end_date, status)
            VALUES (?, ?, ?, ?, ?, 'pending')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $first_approver, $_POST['leave_type'], $_POST['start_date'], $_POST['end_date']);
    $stmt->execute();

    // Redirect or show success message
    echo "Leave request submitted successfully.";
    // Optionally redirect to leave request history page:
    // header("Location: leave_requests.php");
    // exit();
} else {
    echo "Please provide all required information.";
}
?>
