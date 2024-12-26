<?php
session_start();
include('../login_page/db_connect.php');

// Ensure only admin can access this page
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../login_page/login.html");
    exit;
}

// Check if the form is submitted via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $leave_id = $_POST['leave_id'];
    $action = $_POST['action']; // 'approve' or 'reject'

    // Update leave status in the database
    $query = "UPDATE leave_requests SET status = ?, reviewed_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $action, $leave_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Leave status updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update leave status.']);
    }
    exit;
}

// Fetch pending leave requests
$query = "SELECT id, employee_name, leave_type, reason, status FROM leave_requests WHERE status = 'pending'";
$result = $conn->query($query);
?>
