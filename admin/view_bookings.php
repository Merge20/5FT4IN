<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../backend/db_connect.php';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id']) && isset($_POST['action'])) {
    $booking_id = $_POST['booking_id'];
    $action = $_POST['action'];

    if ($action === 'confirm') {
        $conn->query("UPDATE bookings SET status='Confirmed' WHERE id='$booking_id'");
    } elseif ($action === 'cancel') {
        $conn->query("UPDATE bookings SET status='Cancelled' WHERE id='$booking_id'");
    }

    header("Location: view_bookings.php");
    exit();
}

// Fetch all bookings
$sql = "SELECT b.id AS booking_id, b.booking_date, b.status,
               u.name AS user_name, u.email AS user_email,
               p.title AS property_name, p.location
        FROM bookings b
        JOIN users u ON b.user_id = u.id
        JOIN properties p ON b.property_id = p.id
        ORDER BY b.id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="./styles/view_bookings.css">
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
        <div class="hero-title">All Bookings</div>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Property</th>
                    <th>Location</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $status = strtolower($row['status']);

                        echo "<tr>
                                <td>BK{$row['booking_id']}</td>
                                <td>{$row['user_name']}</td>
                                <td>{$row['user_email']}</td>
                                <td>{$row['property_name']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['booking_date']}</td>
                                <td><span class='status {$status}'>{$row['status']}</span></td>
                                <td>";

                        // Action buttons based on status
                        if ($status === 'pending') {
                            echo "
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                                    <button type='submit' name='action' value='confirm' class='update-btn confirm-btn'>Confirm</button>
                                </form>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                                    <button type='submit' name='action' value='cancel' class='update-btn cancel-btn'>Cancel</button>
                                </form>";
                        } elseif ($status === 'confirmed') {
                            echo "
                                <button class='update-btn confirm-btn disabled-btn' disabled>Confirm</button>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                                    <button type='submit' name='action' value='cancel' class='update-btn cancel-btn'>Cancel</button>
                                </form>";
                        } elseif ($status === 'cancelled') {
                            echo "
                                <button class='update-btn confirm-btn disabled-btn' disabled>Confirm</button>
                                <button class='update-btn cancel-btn disabled-btn' disabled>Cancel</button>";
                        }

                        echo "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center;'>No bookings found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
