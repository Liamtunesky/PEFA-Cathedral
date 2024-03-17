<?php
// Set up database connection
include ('database.php');

// Initialize variables for error message and success message
$error_message = '';
$success_message = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $request = $_POST["request"];

    // Insert data into 'forgottenpasswords' table
    $sql = "INSERT INTO forgottenpasswords (firstname, lastname, email, contact_number, age, gender, request) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiss", $firstName, $lastName, $email, $contact, $age, $gender, $request);

    if ($stmt->execute()) {
        // Success message if insertion is successful
        $success_message = "Your request has been submitted successfully.";
    } else {
        // Error message if insertion fails
        $error_message = "Error occurred while submitting your request. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Add Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientBackground 15s ease infinite;
        }
        @keyframes gradientBackground {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        .forgot-password-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Increased max-width */
            margin: 100px auto;
        }
        .forgot-password-container h2 {
            text-align: center;
        }
        .forgot-password-container form {
            display: flex;
            flex-direction: column;
        }
        .forgot-password-container input[type="text"],
        .forgot-password-container input[type="email"],
        .forgot-password-container input[type="number"],
        .forgot-password-container select,
        .forgot-password-container textarea,
        .forgot-password-container input[type="submit"] {
            width: 100%;
            padding: 20px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
        }
        .forgot-password-container select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 24px;
        }
        .forgot-password-container input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        .forgot-password-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="forgot-password-container">
    <h2>Forgot Password</h2>
    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <?php if (!empty($success_message)) : ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php else: ?>
    <form action="#" method="post" id="forgotPasswordForm">
        <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
        <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="text" name="contact" id="contact" placeholder="Contact" required>
        <input type="number" name="age" id="age" placeholder="Age" required>
        <select name="gender" id="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <textarea name="request" id="request" placeholder="Please state your request" required></textarea>
        <input type="submit" value="Submit">
    </form>
    <?php endif; ?>
</div>

<!-- Add Font Awesome Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>
</html>
