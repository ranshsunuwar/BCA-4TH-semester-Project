<?php
session_start();

// Include database connection
include '../includes/db_connect.php';

// Ensure user is logged in and is the chief
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'chief') {
    header("Location: ../login_pg/login.html");
    exit();
}

// Get the leave request ID and approval decision
if (isset($_GET['request_id'], $_GET['decision'])) {
    $request_id = $_GET['request_id'];
    $decision = $_GET['decision']; // 'approved' or 'rejected'

    // Prepare SQL to update the leave request status
    $sql = "UPDATE leave_requests SET status = ? WHERE request_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $decision, $request_id);
    $stmt->execute();

    // Redirect back to the chief's dashboard
    echo "Leave request $decision successfully.";
    // Optionally, redirect to another page (leave history or dashboard):
    // header("Location: chief_dashboard.php");
    // exit();
} else {
    echo "Invalid request.";
}
?>
