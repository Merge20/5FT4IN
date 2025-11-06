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
        <form>
            <label>Property Name</label>
            <input type="text" placeholder="Enter property name">

            <label>Location</label>
            <input type="text" placeholder="Enter location">

            <label>Monthly Rent</label>
            <input type="text" placeholder="Example: ₹18000">

            <label>Property Type</label>
            <select>
                <option>Apartment</option>
                <option>Villa</option>
                <option>Flat</option>
                <option>Studio</option>
                <option>Room</option>
            </select>

            <label>Description</label>
            <textarea placeholder="Enter short property details"></textarea>

            <button class="save-btn">Save Property</button>
        </form>
    </div>
</body>
</html>
