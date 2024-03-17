<?php
// Include the database connection file
include('database.php');

// Check if donation ID is provided and is numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the donation ID to prevent SQL injection
    $donation_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare and execute SQL statement to delete the donation
    $sql = "DELETE FROM donations WHERE donation_id = $donation_id";
    if(mysqli_query($conn, $sql)) {
        // Donation deleted successfully
        echo "<script>alert('Donation deleted successfully.');window.location.href='donations.php';</script>";
        exit();
    } else {
        // Error occurred while deleting donation
        echo "<script>alert('Error occurred while deleting donation.');window.location.href='donations.php';</script>";
        exit();
    }
} else {
    // If donation ID is not provided or not numeric, redirect to donations.php
    header("Location: donations.php");
    exit();
}

