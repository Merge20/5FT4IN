<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../backend/db_connect.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT b.id AS booking_id, p.title AS property_name, p.location, 
        b.booking_date AS check_in, DATE_ADD(b.booking_date, INTERVAL 5 DAY) AS check_out, b.status 
        FROM bookings b
        JOIN properties p ON b.property_id = p.id
        WHERE b.user_id = '$user_id'
        ORDER BY b.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="./styles/my_bookings.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="properties.php">Properties</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="hero">
        <h1><i class="fa-solid fa-calendar-check"></i> My Bookings</h1>
        <p>Track all your current and past property bookings.</p>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th><i class="fa-solid fa-id-card"></i> ID</th>
                    <th><i class="fa-solid fa-house"></i> Property</th>
                    <th><i class="fa-solid fa-location-dot"></i> Location</th>
                    <th><i class="fa-solid fa-door-open"></i> Check-In</th>
                    <th><i class="fa-solid fa-door-closed"></i> Check-Out</th>
                    <th><i class="fa-solid fa-circle-info"></i> Status</th>
                    <th><i class="fa-solid fa-ban"></i> Cancel</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['status']);
                        $disabled = ($row['status'] === 'Cancelled' || $row['status'] === 'Confirmed') ? "disabled" : "";
                        echo "<tr>
                                <td>BK{$row['booking_id']}</td>
                                <td>{$row['property_name']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['check_in']}</td>
                                <td>{$row['check_out']}</td>
                                <td><span class='status {$statusClass}'>{$row['status']}</span></td>
                                <td>
                                    <form method='POST' action='cancel_booking.php' onsubmit='return confirm(\"Cancel this booking?\");'>
                                        <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                                        <button type='submit' class='cancel-btn' {$disabled}>Cancel</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center;'>No bookings found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
