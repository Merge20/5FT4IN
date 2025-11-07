<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../backend/db_connect.php';

// Fetch total counts
$userCount = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$propertyCount = $conn->query("SELECT COUNT(*) AS total FROM properties")->fetch_assoc()['total'];
$bookingCount = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];

$admin_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="./styles/home.css">
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_properties.php">Manage Properties</a>
        <a href="add_property.php">Add Property</a>
        <a href="view_bookings.php">View Bookings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="hero">
        <h1>Welcome Back, <?php echo htmlspecialchars($admin_name); ?> 👋</h1>
        <p>Control and monitor your house rental platform from one place.</p>
    </div>

    <div class="cards">
        <div class="card">
            <div class="icon" style="display:flex;align-items:center;justify-content:center;color:#fff;font-size:22px;">👥</div>
            <span>Users</span>
            <p style="font-size:28px;font-weight:600;margin-top:6px;"><?php echo $userCount; ?></p>
        </div>
        <div class="card">
            <div class="icon" style="display:flex;align-items:center;justify-content:center;color:#fff;font-size:22px;">🏠</div>
            <span>Properties</span>
            <p style="font-size:28px;font-weight:600;margin-top:6px;"><?php echo $propertyCount; ?></p>
        </div>
        <div class="card">
            <div class="icon" style="display:flex;align-items:center;justify-content:center;color:#fff;font-size:22px;">📅</div>
            <span>Bookings</span>
            <p style="font-size:28px;font-weight:600;margin-top:6px;"><?php echo $bookingCount; ?></p>
        </div>
    </div>
</body>
</html>
