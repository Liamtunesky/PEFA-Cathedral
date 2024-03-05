<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

// Database connection
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "church";

$connection = mysqli_connect($server_name, $db_username, $db_password, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database
$sql = "SELECT * FROM members";
$result = mysqli_query($connection, $sql);
?>
            <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Church Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </main>

    <div class="container-fluid px-4">
        <div class="row">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Join date</th>
                            <th>Active Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Loop through the database results and display them in the table
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['DOB'] . "</td>";
                            echo "<td>" . $row['DOA'] . "</td>";
                            echo "<td>" . $row['active_status'] . "</td>";
                            // Calculate age from date of birth
                            $dob = new DateTime($row['DOB']);
                            $now = new DateTime();
                            $age = $now->diff($dob)->y;
                            echo "<td>" . $age . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
                
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PEFA Githurai Media Team 2024</div>
                            <div>
                                <a href="#" id="privacyPolicyLink" onclick="openPopup('privacy')">Privacy Policy</a>
    &middot;
    <a href="#" id="termsConditionsLink" onclick="openPopup('terms')">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
