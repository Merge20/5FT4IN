<?php
include 'db_connect.php';

$result = $conn->query("SELECT * FROM properties");
$properties = [];

while ($row = $result->fetch_assoc()) {
  $properties[] = $row;
}

echo json_encode($properties);
?>
