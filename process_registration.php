<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $doa = $_POST['doa'];
    $qualification = $_POST['qualification'];
    $role = $_POST['role'];
    $ministry = $_POST['ministry'];

    // Calculate age from DOB
    $dob_timestamp = strtotime($dob);
    $current_timestamp = time();
    $age = date('Y', $current_timestamp) - date('Y', $dob_timestamp);

    // You can perform any necessary validation or processing here

    // Example: Saving to a database
    // Replace these lines with your database handling logic
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "church";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to insert data into database
    $sql = "INSERT INTO members (first_name, last_name, contact, email, dob, doa, age, qualification, role, ministry)
            VALUES ('$first_name', '$last_name', '$contact', '$email', '$dob', '$doa', '$age', '$qualification', '$role', '$ministry')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

