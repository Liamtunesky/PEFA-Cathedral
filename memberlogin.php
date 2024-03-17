<?php
// Start the session
session_start();

// Database connection and other configurations
include('database.php');

// Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Check if the connection is established successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

// Initialize variables to hold form data and error messages
$username = $password = $firstname = $lastname = $contact = '';
$username_err = $password_err = $firstname_err = $lastname_err = $contact_err = '';

// Handle form submission (Login or Registration)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's a registration form submission
    if (isset($_POST["registration"])) {
        // Validate first name
        if (empty(trim($_POST["firstname"]))) {
            $firstname_err = "Please enter your first name.";
        } else {
            $firstname = trim($_POST["firstname"]);
        }

        // Validate last name
        if (empty(trim($_POST["lastname"]))) {
            $lastname_err = "Please enter your last name.";
        } else {
            $lastname = trim($_POST["lastname"]);
        }

        // Validate contact
        if (empty(trim($_POST["contact"]))) {
            $contact_err = "Please enter your contact.";
        } else {
            $contact = trim($_POST["contact"]);
        }

        // Validate username
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } else {
            $username = trim($_POST["username"]);
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password."; 
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have at least 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

       // If no errors, proceed with registration
if (empty($username_err) && empty($password_err) && empty($firstname_err) && empty($lastname_err) && empty($contact_err)) {
    // Prepare and execute INSERT statement for registration
    $sql = "INSERT INTO member_login (firstname, lastname, contact, username, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_contact);
        
        $param_firstname = $firstname;
        $param_lastname = $lastname;
        $param_contact = $contact;
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        if (mysqli_stmt_execute($stmt)) {
            // Registration successful
            echo "Registration successful!";
        } else {
            echo "Error: " . mysqli_error($conn); // Check for SQL execution error
        }
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn); // Check for SQL preparation error
    }
}
        // Validate username
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } else {
            $username = trim($_POST["username"]);
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password."; 
        } else {
            $password = trim($_POST["password"]);
        }

        // Check if there are no errors
        if (empty($username_err) && empty($password_err)) {
            // Prepare a select statement
            $sql = "SELECT username, password FROM member_login WHERE username = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = $username;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if username exists, if yes then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION["username"] = $username;

                                // Redirect user to store.php
                                header("location: store.php");
                                exit();
                            } else {
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else {
                        // Display an error message if username doesn't exist
                        $username_err = "No account found with that username.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <!-- Include Font Awesome for icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            font-family: Verdana, Geneva, Tahoma, sans-serif;
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

        /* CSS for form */
        .form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Box shadow */
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: calc(100% - 20px); /* Adjusted width */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-container input[type="submit"] {
            width: calc(100% - 20px); /* Adjusted width */
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* CSS for modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 300px; /* Adjusted width */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    text-align: center; /* Center align content */
}

.modal-content h2 {
    margin-bottom: 20px; /* Added spacing below the heading */
}

.modal-content input[type="text"],
.modal-content input[type="password"] {
    width: calc(100% - 40px); /* Adjusted width */
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.modal-content input[type="submit"] {
    width: calc(100% - 40px); /* Adjusted width */
    padding: 10px;
    margin-top: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Style the registration link */
        #registerLink {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        #registerLink:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Login form -->
    <div class="form-container">
    <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
        <!-- Link to open registration modal -->
        <a href="#" id="registerLink">Not registered? Register here</a>
    </div>

    <!-- Hidden registration modal -->
    <div id="registrationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Registration Form</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="firstname" placeholder="First name" value="<?php echo htmlspecialchars($firstname); ?>"><br>
                <input type="text" name="lastname" placeholder="Last name" value="<?php echo htmlspecialchars($lastname); ?>"><br>
                <input type="text" name="contact" placeholder="Contact" value="<?php echo htmlspecialchars($contact); ?>"><br>
                <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required><br>
                <span class="error"><?php echo $username_err; ?></span><br>
                <input type="password" name="password" placeholder="Password" required>
                <div class="password-toggle" onclick="togglePasswordVisibility('password')">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div><br>
                <span class="error"><?php echo $password_err; ?></span><br>
                <input type="submit" value="Register">
                </form>
        </div>
    </div>

    <script>
          // JavaScript to toggle modal
    document.getElementById('registerLink').addEventListener('click', function() {
        document.getElementById('registrationModal').style.display = 'block';
    });

    document.getElementsByClassName('close')[0].addEventListener('click', function() {
        document.getElementById('registrationModal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('registrationModal')) {
            document.getElementById('registrationModal').style.display = 'none';
        }
    });

    // JavaScript to generate username
    document.getElementById('firstname').addEventListener('input', generateUsername);
    document.getElementById('lastname').addEventListener('input', generateUsername);

    function generateUsername() {
        var firstname = document.getElementById('firstname').value.trim().toLowerCase();
        var lastname = document.getElementById('lastname').value.trim().toLowerCase();
        var username = firstname + '_' + lastname;
        document.getElementById('username').value = username;
    }

    // JavaScript to toggle password visibility
    function togglePasswordVisibility(inputId) {
        var input = document.getElementById(inputId);
        input.type = input.type === "password" ? "text" : "password";
    }
    </script>
</body>
</html>

