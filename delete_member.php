<?php
// Include the database connection file
include('database.php');

// Check if the member ID is provided via POST
if(isset($_POST['member_id'])) {
    // Sanitize the member ID
    $member_id = mysqli_real_escape_string($conn, $_POST['member_id']);

    // Prepare the SQL query to delete the member record
    $sql = "DELETE FROM members WHERE id = '$member_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Return a success response
        echo "Member deleted successfully";
    } else {
        // Return an error response
        echo "Error deleting member: " . $conn->error;
    }
} else {
    // Return an error response if member ID is not provided
    echo "Member ID not provided";
}

