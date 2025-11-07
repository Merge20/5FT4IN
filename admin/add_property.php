<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../backend/db_connect.php';

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    // Handle image upload
    $target_dir = "../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    if ($uploadOk) {
        $image_path = "./uploads/" . $image_name;

        $sql = "INSERT INTO properties (title, location, price, type, description, image)
                VALUES ('$title', '$location', '$price', '$type', '$description', '$image_path')";

        if ($conn->query($sql) === TRUE) {
            $message = "✅ Property added successfully!";
        } else {
            $message = "❌ Database error: " . $conn->error;
        }
    } else {
        $message = "❌ Failed to upload image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
    <link rel="stylesheet" href="./styles/add_property.css">
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

    <div class="hero">Add Property</div>

    <div class="form-box">
        <?php if (!empty($message)) echo "<p style='color: green; text-align:center;'>$message</p>"; ?>
        <form method="POST" enctype="multipart/form-data">
            <label>Property Name</label>
            <input type="text" name="title" placeholder="Enter property name" required>

            <label>Location</label>
            <input type="text" name="location" placeholder="Enter location" required>

            <label>Monthly Rent</label>
            <input type="text" name="price" placeholder="Example: 18000" required>

            <label>Property Type</label>
            <select name="type" required>
                <option>Apartment</option>
                <option>Villa</option>
                <option>Flat</option>
                <option>Studio</option>
                <option>Room</option>
            </select>

            <label>Description</label>
            <textarea name="description" placeholder="Enter short property details" required></textarea>

            <label>Upload Image</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit" class="save-btn">Save Property</button>
        </form>
    </div>
</body>
</html>
