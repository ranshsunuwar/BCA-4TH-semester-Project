<!-- common/submit_leave_req.php -->
<?php
session_start();
include 'db_connect.php'; // Include database connection

$user_id = $_SESSION['user_id'];
$leave_type = $_POST['leave_type'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$category = $_SESSION['category']; // 'teaching' or 'non-teaching'

// Decide approver based on the category
if ($category === 'teaching') {
    $first_approver = 'admin'; // Or 'hod' depending on your setup
} else {
    $first_approver = 'chief';
}

// Insert leave request into the database
$sql = "INSERT INTO leave_requests (user_id, first_approver, leave_type, start_date, end_date, status)
        VALUES (?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $user_id, $first_approver, $leave_type, $start_date, $end_date);
$stmt->execute();

// Redirect or show success message
header("Location: ../employee_db/employee_dashboard.php?status=leave_request_submitted");
exit();
?>
