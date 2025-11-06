<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="./styles/manage_users.css">
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

    <div class="hero-row">
        <div class="hero-title">Manage Users</div>
        <button class="add-btn">Add User</button>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Rohit Sharma</td>
                    <td>rohit@gmail.com</td>
                    <td>9876543210</td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
                <tr>
                    <td>02</td>
                    <td>Simran Kaur</td>
                    <td>simran@gmail.com</td>
                    <td>9977665544</td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
                <tr>
                    <td>03</td>
                    <td>Aryan Singh</td>
                    <td>aryan@gmail.com</td>
                    <td>9001122334</td>
                    <td><button class="cancel-btn">Cancel</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
