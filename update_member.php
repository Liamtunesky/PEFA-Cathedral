<?php
include('database.php'); // Include the database connection file

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['edit-first-name']) && isset($_POST['edit-last-name']) && isset($_POST['edit-contact']) && isset($_POST['edit-email']) && isset($_POST['edit-dob']) && isset($_POST['edit-doa']) && isset($_POST['edit-qualification']) && isset($_POST['edit-role']) && isset($_POST['edit-ministry']) && isset($_POST['id'])) {
        // Extract data from POST request
        $id = $_POST['id'];
        $firstName = $_POST['edit-first-name'];
        $lastName = $_POST['edit-last-name'];
        $contact = $_POST['edit-contact'];
        $email = $_POST['edit-email'];
        $dob = $_POST['edit-dob'];
        $doa = $_POST['edit-doa'];
        $qualification = $_POST['edit-qualification'];
        $role = $_POST['edit-role'];
        $ministry = $_POST['edit-ministry'];

        // Prepare and execute the update query
        $sql = "UPDATE members SET first_name=?, last_name=?, contact=?, email=?, DOB=?, DOA=?, qualification=?, role=?, ministry=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $firstName, $lastName, $contact, $email, $dob, $doa, $qualification, $role, $ministry, $id);
        
        if ($stmt->execute()) {
            // Update successful
            echo "Member details updated successfully";
        } else {
            // Update failed
            echo "Error updating member: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        // Required fields are missing
        echo "Error: All required fields must be filled.";
    }
} else {
    // Invalid request method
    echo "Error: Invalid request method.";
}

// Close the database connection
$conn->close();

