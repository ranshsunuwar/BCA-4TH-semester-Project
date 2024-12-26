<?php
session_start();
include('../login_pg/log_db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $leave_type = $_POST['leave_type'];
    $reason = $_POST['reason'];

    $query = "INSERT INTO leave_requests (user_id, leave_type, reason, status, requested_at) VALUES (?, ?, ?, 'pending', NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $leave_type, $reason);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Leave request submitted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit leave request.']);
    }
    exit;
}
?>
