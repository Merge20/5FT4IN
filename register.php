<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Rental - Register</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container">
    <h2>Create an Account</h2>

    <form action="register.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Register</button>

        <p class="link">Already registered? <a href="index.php">Login</a></p>
    </form>
</div>
</body>
</html>
