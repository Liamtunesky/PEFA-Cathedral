<?php
// Include the database connection file
include('database.php');

// Check if the member ID is provided
if(isset($_GET['id'])) {
    // Sanitize the input
    $member_id = $_GET['id'];

    // Prepare and execute the query to fetch member details
    $stmt = $conn->prepare("SELECT * FROM members WHERE id = ?");
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if member exists
    if($result->num_rows > 0) {
        // Fetch member details
        $member = $result->fetch_assoc();

        // Convert member details to JSON format and return
        echo json_encode($member);
    } else {
        // Member not found
        echo json_encode(array('error' => 'Member not found'));
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // ID parameter not provided
    echo json_encode(array('error' => 'Member ID not provided'));
}

