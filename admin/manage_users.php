<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../backend/db_connect.php';

// Handle delete user request
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    // Prevent admin from deleting their own account or another admin
    $conn->query("DELETE FROM users WHERE id='$delete_id' AND role='user'");
    header("Location: manage_users.php");
    exit();
}

// Fetch all users except admins
$sql = "SELECT id, name, email, phone, role FROM users WHERE role='user' ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="./styles/manage_users.css">
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

    <div class="hero-row">
        <div class="hero-title">Manage Users</div>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>U{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                                    <button type='submit' class='delete-btn'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
