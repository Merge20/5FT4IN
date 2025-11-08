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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./styles/home.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <h1>Welcome Back, <?php echo htmlspecialchars($admin_name); ?></h1>
    </div>

    <div class="cards">
        <div class="card">
            <div class="icon blue"><i class="fa-solid fa-users"></i></div>
            <span>Users</span>
            <p class="count"><?php echo $userCount; ?></p>
        </div>
        <div class="card">
            <div class="icon green"><i class="fa-solid fa-house"></i></div>
            <span>Properties</span>
            <p class="count"><?php echo $propertyCount; ?></p>
        </div>
        <div class="card">
            <div class="icon orange"><i class="fa-solid fa-calendar-check"></i></div>
            <span>Bookings</span>
            <p class="count"><?php echo $bookingCount; ?></p>
        </div>
    </div>
</body>
</html>
