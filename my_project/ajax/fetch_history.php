<?php
session_start();
include('../login_pg/log_db_conn.php');

// Fetch leave history for the logged-in user
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM leave_requests WHERE employee_id = ? ORDER BY requested_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$history = [];
while ($row = $result->fetch_assoc()) {
    $history[] = $row;
}

echo json_encode($history);
?>
