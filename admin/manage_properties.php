<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../backend/db_connect.php';

// Handle delete property request
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $conn->query("DELETE FROM properties WHERE id='$delete_id'");
    header("Location: manage_properties.php");
    exit();
}

// Fetch all properties
$sql = "SELECT * FROM properties ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Properties</title>
    <link rel="stylesheet" href="./styles/manage_properties.css">
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
        <div class="hero-title">Manage Properties</div>
        <a href="add_property.php" class="add-btn">+ Add Property</a>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Property Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Rent (₹)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>P{$row['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['type']}</td>
                            <td>{$row['location']}</td>
                            <td>{$row['price']}</td>
                            <td>
                                <a href='edit_property.php?id={$row['id']}' class='edit-btn'>Edit</a>
                                <form method='POST' action='' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this property?\")'>
                                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                                    <button type='submit' class='delete-btn'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No properties found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
