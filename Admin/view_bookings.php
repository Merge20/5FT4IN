<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="./styles/view_bookings.css">
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

    <div class="hero">View Bookings</div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Property</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>BK01</td>
                    <td>Rohit Sharma</td>
                    <td>Green View Apartment</td>
                    <td>10-02-2025</td>
                    <td>15-02-2025</td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
                <tr>
                    <td>BK02</td>
                    <td>Simran Kaur</td>
                    <td>Blue Orchid Flats</td>
                    <td>21-03-2025</td>
                    <td>25-03-2025</td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
                <tr>
                    <td>BK03</td>
                    <td>Aryan Singh</td>
                    <td>Sunshine Villas</td>
                    <td>01-04-2025</td>
                    <td>05-04-2025</td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
