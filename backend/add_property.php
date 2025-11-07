<?php
include 'db_connect.php';

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$location = $_POST['location'];
$image = $_POST['image'];

$sql = "INSERT INTO properties (title, description, price, location, image)
        VALUES ('$title', '$description', '$price', '$location', '$image')";

if ($conn->query($sql) === TRUE) {
  echo "Property added successfully!";
} else {
  echo "Error: " . $conn->error;
}
?>
