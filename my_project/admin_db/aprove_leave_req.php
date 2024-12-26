<?php
session_start();

// Include database connection
include '../includes/db_connect.php';

// Ensure user is logged in and is an admin or HOD
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'hod'])) {
    header("Location: ../login_pg/login.html");
    exit();
}

// Get the leave request ID and approval decision
if (isset($_GET['request_id'], $_GET['decision'])) {
    $request_id = $_GET['request_id'];
    $decision = $_GET['decision']; // 'approved' or 'rejected'

    // If approved, change status to 'approved by admin' or similar
    if ($decision === 'approved') {
        $status = 'approved by admin';
    } else {
        $status = 'rejected';
    }

    // Prepare SQL to update the leave request status
    $sql = "UPDATE leave_requests SET status = ? WHERE request_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $request_id);
    $stmt->execute();

    // Redirect back to the admin dashboard
    echo "Leave request $decision successfully.";
    // Optionally, redirect to another page (leave requests or dashboard):
    // header("Location: admin_dashboard.php");
    // exit();
} else {
    echo "Invalid request.";
}
?>
