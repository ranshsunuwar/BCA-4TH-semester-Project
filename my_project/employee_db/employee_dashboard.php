<?php
session_start();

// Check if user is logged in and has the employee role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'employee') {
    header("Location: ../login_pg/login.html");
    exit();
}

// Get the user's category from the session
$category = $_SESSION['category'];
?>

<h1>Welcome, employee!</h1>

<?php if ($category === 'teaching'): ?>
    <p>You are a Teaching Staff member.</p>
    <!-- Add teaching-specific content here -->
    <ul>
        <li>View Assigned Classes</li>
        <li>Apply for Leave</li>
    </ul>
<?php else: ?>
    <p>You are a Non-Teaching Staff member.</p>
    <!-- Add non-teaching-specific content here -->
    <ul>
        <li>View Job Duties</li>
        <li>Submit Work Reports</li>
    </ul>
<?php endif; ?>

<a href="../login_pg/login.html">Logout</a>
