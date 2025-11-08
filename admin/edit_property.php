<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../backend/db_connect.php';

// Get property ID
if (!isset($_GET['id'])) {
    header("Location: manage_properties.php");
    exit();
}

$property_id = $_GET['id'];

// Fetch property details
$sql = "SELECT * FROM properties WHERE id='$property_id'";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    echo "Property not found.";
    exit();
}
$property = $result->fetch_assoc();

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    $update_sql = "UPDATE properties 
                   SET title='$title', location='$location', price='$price', type='$type', description='$description'";

    // Handle optional new image upload
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = "./uploads/" . $image_name;
            $update_sql .= ", image='$image_path'";
        } else {
            $message = "❌ Failed to upload new image.";
        }
    }

    $update_sql .= " WHERE id='$property_id'";

    if ($conn->query($update_sql) === TRUE) {
        $message = "✅ Property updated successfully!";
        // Refresh data
        $result = $conn->query("SELECT * FROM properties WHERE id='$property_id'");
        $property = $result->fetch_assoc();
    } else {
        $message = "❌ Database error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
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

    <div class="hero">Edit Property</div>

    <div class="form-box">
        <?php if (!empty($message)) echo "<p style='color: green; text-align:center;'>$message</p>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <label>Property Name</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($property['title']); ?>" required>

            <label>Location</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($property['location']); ?>" required>

            <label>Monthly Rent</label>
            <input type="text" name="price" value="<?php echo htmlspecialchars($property['price']); ?>" required>

            <label>Property Type</label>
            <select name="type" required>
                <option <?php if($property['type'] == 'Apartment') echo 'selected'; ?>>Apartment</option>
                <option <?php if($property['type'] == 'Villa') echo 'selected'; ?>>Villa</option>
                <option <?php if($property['type'] == 'Flat') echo 'selected'; ?>>Flat</option>
                <option <?php if($property['type'] == 'Studio') echo 'selected'; ?>>Studio</option>
                <option <?php if($property['type'] == 'Room') echo 'selected'; ?>>Room</option>
            </select>

            <label>Description</label>
            <textarea name="description" required><?php echo htmlspecialchars($property['description']); ?></textarea>

            <label>Current Image</label>
            <div class="image-preview">
                <img src="../<?php echo $property['image']; ?>" alt="Property Image" style="width:200px; border-radius:8px; margin-bottom:10px;">
            </div>

            <label>Upload New Image (optional)</label>
            <input type="file" name="image" accept="image/*">

            <button type="submit" class="save-btn">Update Property</button>
        </form>
    </div>
</body>
</html>
