<?php
session_start();
include('../login_pg/log_db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $status = $_POST['status'];

    $query = "INSERT INTO attendance (user_id, status, date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $status);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Attendance marked successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to mark attendance.']);
    }
    exit;
}
?>
