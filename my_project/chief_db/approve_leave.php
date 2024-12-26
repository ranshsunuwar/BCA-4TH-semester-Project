<?php
session_start();
include('../login_pg/log_db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $leave_id = $_POST['leave_id'];
    $action = $_POST['action']; // 'approve' or 'reject'

    $query = "UPDATE leave_requests SET status = ?, reviewed_by = 'chief', reviewed_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $action, $leave_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Leave reviewed successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to review leave.']);
    }
    exit;
}
?>
