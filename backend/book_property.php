<?php
include 'db_connect.php';
session_start();

$user_id = $_SESSION['user_id'];
$property_id = $_POST['property_id'];
$booking_date = date('Y-m-d');

$sql = "INSERT INTO bookings (user_id, property_id, booking_date)
        VALUES ('$user_id', '$property_id', '$booking_date')";

if ($conn->query($sql) === TRUE) {
  echo "Booking request sent!";
} else {
  echo "Error: " . $conn->error;
}
?>
