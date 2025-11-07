<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Properties</title>
    <link rel="stylesheet" href="./styles/properties.css">
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="properties.php">Properties</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="hero">
        <h1>Available Rental Properties</h1>
        <p>Search and filter to find your ideal home.</p>
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Search by location or name">
        <select>
            <option>All Types</option>
            <option>Apartment</option>
            <option>Villa</option>
            <option>Studio</option>
            <option>Room</option>
        </select>
        <button class="search-btn">Search</button>
    </div>

    <div class="properties-grid">
        <div class="property-card">
            <img src="https://via.placeholder.com/350x220" alt="Property 1">
            <div class="property-info">
                <h3>Green View Apartment</h3>
                <p>Sector 42, Gurgaon</p>
                <p class="price">₹18,000 / month</p>
                <a href="property_details.php" class="details-btn">View Details</a>
            </div>
        </div>

        <div class="property-card">
            <img src="https://via.placeholder.com/350x220" alt="Property 2">
            <div class="property-info">
                <h3>Sunshine Villas</h3>
                <p>Noida Sector 52</p>
                <p class="price">₹25,000 / month</p>
                <a href="property_details.php" class="details-btn">View Details</a>
            </div>
        </div>

        <div class="property-card">
            <img src="https://via.placeholder.com/350x220" alt="Property 3">
            <div class="property-info">
                <h3>Blue Orchid Flats</h3>
                <p>Indirapuram, Ghaziabad</p>
                <p class="price">₹14,500 / month</p>
                <a href="property_details.php" class="details-btn">View Details</a>
            </div>
        </div>
    </div>

</body>
</html>
