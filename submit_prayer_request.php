<?php
include('database.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact_number'];
    $request = $_POST['request'];

    // Prepare and execute the SQL statement to insert the prayer request into the database
    $sql = "INSERT INTO prayer_request (firstname, lastname, email, contact_number, request, date, status) 
            VALUES (?, ?, ?, ?, ?, NOW(), 'Pending')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $contact, $request);

    if ($stmt->execute()) {
        // Return a success message
        echo "Prayer request submitted successfully!";
    } else {
        // Return an error message
        echo "Failed to submit prayer request. Please try again later.";
    }

    // Close the statement
    $stmt->close();
} else {
    // If the form is not submitted via POST method, redirect the user back to the form page
    header("Location: Home.html");
    exit();
}

