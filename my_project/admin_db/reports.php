<?php
session_start();
include('../login_pg/log_db_conn.php');

// Check if the user is authorized (ensure only admin access)
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../login_pg/login.html");
    exit;
}

// Fetch report data based on AJAX request
if (isset($_GET['report_type'])) {
    $report_type = $_GET['report_type'];

    if ($report_type === 'leave_summary') {
        // Fetch leave summary grouped by type
        $query = "SELECT leave_type, COUNT(*) as count FROM leave_requests GROUP BY leave_type";
        $result = $conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
        exit;
    } elseif ($report_type === 'employee_leave_history') {
        // Fetch leave history for all employees
        $query = "SELECT employee_name, leave_type, status, requested_at, reviewed_at FROM leave_requests";
        $result = $conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
        exit;
    }
}
?>
