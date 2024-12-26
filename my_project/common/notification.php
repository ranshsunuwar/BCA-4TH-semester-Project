<!-- common/notification.php -->
<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM notifications WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Display notifications
while ($row = $result->fetch_assoc()) {
    echo "<p>Notification: " . $row['message'] . "</p>";
}
?>
