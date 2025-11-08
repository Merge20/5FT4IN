<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../backend/db_connect.php';

if (!isset($_GET['id'])) {
    echo "Invalid property ID.";
    exit();
}

$property_id = $_GET['id'];
$sql = "SELECT * FROM properties WHERE id='$property_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Property not found.";
    exit();
}

$property = $result->fetch_assoc();

// Fetch amenities
$amenities = [];
$amenity_result = $conn->query("SELECT amenities FROM property_amenities WHERE property_id='$property_id'");
if ($amenity_result && $amenity_result->num_rows > 0) {
    $row = $amenity_result->fetch_assoc();
    $amenities = explode(", ", $row['amenities']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $booking_date = date('Y-m-d');

    $check = $conn->query("SELECT * FROM bookings WHERE user_id='$user_id' AND property_id='$property_id' AND status!='Cancelled'");
    if ($check->num_rows > 0) {
        $message = "You already have an active booking for this property.";
    } else {
        $conn->query("INSERT INTO bookings (user_id, property_id, booking_date, status) VALUES ('$user_id', '$property_id', '$booking_date', 'Pending')");
        $message = "Booking request sent successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $property['title']; ?> - Details</title>
    <link rel="stylesheet" href="./styles/property_details.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="properties.php">Properties</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="property-wrapper">
        <div class="property-image">
            <img src="../<?php echo $property['image']; ?>" alt="<?php echo $property['title']; ?>">
        </div>

        <div class="property-content">
            <h1><?php echo $property['title']; ?></h1>
            <p class="location"><i class="fa-solid fa-location-dot"></i> <?php echo $property['location']; ?></p>
            <p class="price">₹<?php echo number_format($property['price']); ?> / month</p>
            <p class="type"><i class="fa-solid fa-house"></i> <?php echo $property['type']; ?></p>

            <div class="details-section">
                <h3>About This Property</h3>
                <p><?php echo nl2br($property['details']); ?></p>
            </div>

            <?php if (!empty($amenities)): ?>
                <div class="amenities-section">
                    <h3>Amenities</h3>
                    <div class="amenities-list">
                        <?php foreach ($amenities as $item): ?>
                            <div class="amenity">
                                <?php
                                switch (trim($item)) {
                                    case 'WiFi':
                                        echo "<i class='fa-solid fa-wifi'></i> WiFi";
                                        break;
                                    case 'Parking':
                                        echo "<i class='fa-solid fa-car'></i> Parking";
                                        break;
                                    case 'AC':
                                        echo "<i class='fa-solid fa-snowflake'></i> Air Conditioning";
                                        break;
                                    case 'Balcony':
                                        echo "<i class='fa-solid fa-city'></i> Balcony";
                                        break;
                                    case 'Furnished':
                                        echo "<i class='fa-solid fa-couch'></i> Furnished";
                                        break;
                                    default:
                                        echo "<i class='fa-solid fa-check'></i> " . htmlspecialchars($item);
                                }
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>

            <form method="POST" class="booking-form">
                <button type="submit" class="book-btn">Book Now</button>
            </form>
        </div>
    </div>
</body>
</html>
