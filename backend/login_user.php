<?php
include 'db_connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  session_start();
  $user = $result->fetch_assoc();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['user_name'] = $user['name'];
  $_SESSION['user_role'] = $user['role'];
  echo "Login successful!";
} else {
  echo "Invalid credentials!";
}
?>
