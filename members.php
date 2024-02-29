<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$database = "Church";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the members table
$sql = "SELECT * FROM members";
$result = $conn->query($sql);

// Close the MySQL connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
</head>
<body>
    <h1>Members</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <!-- Add more columns if needed -->
        </tr>
        <?php
        // Loop through each row of the result set
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                // Add more cells for additional columns
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No members found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
