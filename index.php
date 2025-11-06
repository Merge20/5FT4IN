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
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>

        <p class="link">Don't have an account? <a href="register.php">Register</a></p>
        <p class="link">Don't have an account? <a href="home.php">HOME PAGE</a></p>
    </form>
</div>
</body>
</html>
