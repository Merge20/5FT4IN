<?php
session_start();
include './backend/db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check admin table first
    $adminQuery = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $adminResult = $conn->query($adminQuery);

    if ($adminResult->num_rows > 0) {
        $admin = $adminResult->fetch_assoc();
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['user_name'] = $admin['name'];
        $_SESSION['user_role'] = 'admin';
        header("Location: ./admin/home.php");
        exit();
    }

    $userQuery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $user = $userResult->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = 'user';
        header("Location: ./user/home.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Rental - Login</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if ($error): ?>
        <p style="color:red; font-weight:500; margin-bottom:10px;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p class="link">Don't have an account? <a href="register.php">Register</a></p>
    </form>
</div>
</body>
</html>
