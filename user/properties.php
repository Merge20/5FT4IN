<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../backend/db_connect.php';

// Handle search and filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

$sql = "SELECT * FROM properties WHERE 1";
if (!empty($search)) {
    $sql .= " AND (title LIKE '%$search%' OR location LIKE '%$search%')";
}
if (!empty($type) && $type !== "All Types") {
    $sql .= " AND type='$type'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Properties</title>
    <link rel="stylesheet" href="./styles/properties.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="properties.php">Properties</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="hero">
        <h1>Available Rental Properties</h1>
        <p>Search, filter, and find your ideal home.</p>
    </div>

    <div class="search-bar">
        <form method="GET" action="properties.php">
            <input type="text" name="search" placeholder="🔍 Search by location or name" value="<?php echo htmlspecialchars($search); ?>">
            <select name="type">
                <option <?php if($type=="All Types" || $type=="") echo "selected"; ?>>All Types</option>
                <option <?php if($type=="Apartment") echo "selected"; ?>>Apartment</option>
                <option <?php if($type=="Villa") echo "selected"; ?>>Villa</option>
                <option <?php if($type=="Studio") echo "selected"; ?>>Studio</option>
                <option <?php if($type=="Room") echo "selected"; ?>>Room</option>
            </select>
            <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        </form>
    </div>

    <div class="properties-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='property-card'>
                    <img src='../{$row['image']}' alt='{$row['title']}'>
                    <div class='property-info'>
                        <h3>{$row['title']}</h3>
                        <p class='location'><i class='fa-solid fa-location-dot'></i> {$row['location']}</p>
                        <p class='price'>₹{$row['price']} / month</p>
                        <a href='property_details.php?id={$row['id']}' class='details-btn'>View Details</a>
                    </div>
                </div>";
            }
        } else {
            echo "<p style='text-align:center; width:100%; font-size:18px;'>No properties found.</p>";
        }
        ?>
    </div>
</body>
</html>
