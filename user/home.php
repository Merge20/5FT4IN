<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../backend/db_connect.php';
$user_name = $_SESSION['user_name'];

// Fetch top 3 featured properties
$sql = "SELECT * FROM properties ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./styles/home.css">
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="properties.php">Properties</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="logout.php">Logout</a>
    </div>

    <section class="hero">
        <h1>Welcome, <?php echo htmlspecialchars($user_name); ?> 👋</h1>
        <p>Find your perfect rental home — verified, affordable, and easy to book.</p>
        <a href="properties.php" class="browse-btn">Browse Properties</a>
    </section>

    <section class="features">
        <div class="feature-card">
            <div class="icon">&#127968;</div>
            <h3>Verified Properties</h3>
            <p>All properties are listed and verified to ensure safety and trust.</p>
        </div>
        <div class="feature-card">
            <div class="icon">&#128188;</div>
            <h3>Easy Booking</h3>
            <p>Book your favorite property in just a few simple steps.</p>
        </div>
        <div class="feature-card">
            <div class="icon">&#128100;</div>
            <h3>Personal Dashboard</h3>
            <p>Track your bookings and manage your profile with ease.</p>
        </div>
    </section>

    <section class="featured">
        <h2>Featured Properties</h2>
        <div class="properties-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='property-card'>
                        <img src='{$row['image']}' alt='{$row['title']}'>
                        <div class='property-info'>
                            <h3>{$row['title']}</h3>
                            <p>{$row['location']}</p>
                            <p class='price'>₹{$row['price']} / month</p>
                            <a href='property_details.php?id={$row['id']}' class='details-btn'>View Details</a>
                        </div>
                    </div>";
                }
            } else {
                echo "<p style='text-align:center; width:100%;'>No properties available right now.</p>";
            }
            ?>
        </div>
    </section>
</body>
</html>
