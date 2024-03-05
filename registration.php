<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: admin.php");
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
        .login-container{
            max-width: 600px;
            margin:0 auto;
            padding:50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            position: relative;
        }
        .form-group{
            margin-bottom:30px;
            position: relative;
        }
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .password-toggle i {
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php
        if (isset($_POST["submit"])) {
            $firstName = $_POST["first_name"];
            $lastName = $_POST["last_name"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordconfirm = $_POST["confirm_password"];
            $contact = $_POST["contact"];

            // Handle profile picture upload if provided
            if (!empty($_FILES['profile_pic']['name'])) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['profile_pic']['name']);

                if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
                    echo "<div class='alert alert-success'>Profile picture uploaded successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Failed to upload profile picture.</div>";
                }
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($firstName) OR empty($lastName) OR empty($username) OR empty($email) OR empty($password) OR empty($passwordconfirm) OR empty($contact) ) {
                array_push($errors,"All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors,"Password must be at least 8 characters long");
            }
            if ($password !== $passwordconfirm) {
                array_push($errors,"Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM admin WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors,"Username already exists!");
            }
            if (count($errors) > 0) {
                foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO admin (first_name, last_name, username, email, password, contact) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $username, $email, $passwordHash, $contact);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>
        <form action="registration.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile_pic">Profile Picture:</label>
                <input type="file" class="form-control" id="profile_pic" name="profile_pic">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" placeholder="First Name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:" id="password">
                <div class="password-toggle" onclick="togglePasswordVisibility('password')">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password:" id="confirm_password">
                <div class="password-toggle" onclick="togglePasswordVisibility('confirm_password')">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="contact" placeholder="Contact:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="qualification" placeholder="Qualification:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <p>Already Registered <a href="login.php">Login Here</a></p>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>
        function togglePasswordVisibility(inputId) {
            var input = document.getElementById(inputId);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
