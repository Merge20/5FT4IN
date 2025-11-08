<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../backend/db_connect.php';

$booking_id = $_POST['booking_id'];
$user_id = $_SESSION['user_id'];

$sql = "UPDATE bookings SET status='Cancelled' WHERE id='$booking_id' AND user_id='$user_id'";
if ($conn->query($sql) === TRUE) {
    header("Location: my_bookings.php");
    exit();
} else {
    echo "Error cancelling booking: " . $conn->error;
}
?>
