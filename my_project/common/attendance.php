<!-- common/attendance.php -->
<?php
// Assuming user_id and role are stored in the session
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

// If the user is an employee, show only their attendance
if ($user_role === 'employee') {
    $sql = "SELECT * FROM attendance WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Show only this employee's attendance
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Display the employee's attendance
    while ($row = $result->fetch_assoc()) {
        echo "<p>Attendance Date: " . $row['date'] . "</p>";
    }
}
// If the user is an admin or chief, show attendance for all employees
elseif ($user_role === 'admin' || $user_role === 'chief') {
    $sql = "SELECT * FROM attendance"; // Show attendance for all employees
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Display all employee attendances
    while ($row = $result->fetch_assoc()) {
        echo "<p>Employee ID: " . $row['user_id'] . " - Attendance Date: " . $row['date'] . "</p>";
    }
}
?>
