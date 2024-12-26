<!-- common/user_history.php -->
<?php
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

// If the user is an employee, show only their leave history
if ($user_role === 'employee') {
    $sql = "SELECT * FROM leave_requests WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Show only this employee's leave history
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Display the employee's leave history
    while ($row = $result->fetch_assoc()) {
        echo "<p>Leave Type: " . $row['leave_type'] . " - Status: " . $row['status'] . "</p>";
    }
}
// If the user is an admin or chief, show leave history for all employees
elseif ($user_role === 'admin' || $user_role === 'chief') {
    $sql = "SELECT * FROM leave_requests"; // Show leave history for all employees
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Display all employees' leave history
    while ($row = $result->fetch_assoc()) {
        echo "<p>Employee ID: " . $row['user_id'] . " - Leave Type: " . $row['leave_type'] . " - Status: " . $row['status'] . "</p>";
    }
}
?>
