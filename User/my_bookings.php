<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="./styles/my_bookings.css">
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
        <h1>My Bookings</h1>
        <p>Track all your current and past property bookings.</p>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Property</th>
                    <th>Location</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Status</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>BK101</td>
                    <td>Green View Apartment</td>
                    <td>Sector 42, Gurgaon</td>
                    <td>10-02-2025</td>
                    <td>15-02-2025</td>
                    <td><span class="status active">Confirmed</span></td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
                <tr>
                    <td>BK102</td>
                    <td>Blue Orchid Flats</td>
                    <td>Indirapuram, Ghaziabad</td>
                    <td>20-03-2025</td>
                    <td>25-03-2025</td>
                    <td><span class="status pending">Pending</span></td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
                <tr>
                    <td>BK103</td>
                    <td>Sunshine Villas</td>
                    <td>Noida Sector 52</td>
                    <td>05-04-2025</td>
                    <td>10-04-2025</td>
                    <td><span class="status cancelled">Cancelled</span></td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
