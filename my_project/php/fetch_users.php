<?php
include('log_db_conn.php');  // Include the connection file

// Example of fetching data from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"]. " - Role: " . $row["role"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();  // Close the connection
?>
