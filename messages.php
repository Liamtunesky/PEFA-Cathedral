<?php
include('database.php');
include('includes/header.php');
include('includes/navbar.php');

// Function to retrieve prayer requests from the database
function getPrayersFromDatabase($conn) {
    // Initialize an empty array to store prayer requests
    $prayerRequests = [];

    // SQL query to select prayer requests
    $sql = "SELECT * FROM prayer_request";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch data row by row
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the prayer requests array
            $prayerRequests[] = $row;
        }
    } else {
        // Handle the case where the query fails
        echo "Error fetching prayer requests: " . mysqli_error($conn);
    }

    // Return the array of prayer requests
    return $prayerRequests;
}

// Retrieve prayer requests from the database
$prayerRequests = getPrayersFromDatabase($conn);

// Function to retrieve password requests from the database
function getPasswordRequestsFromDatabase($conn) {
    // Initialize an empty array to store password requests
    $passwordRequests = [];

    // SQL query to select forgotten password requests
    $sql = "SELECT * FROM ForgottenPasswords";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch data row by row
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the password requests array
            $passwordRequests[] = $row;
        }
    } else {
        // Handle the case where the query fails
        echo "Error fetching password requests: " . mysqli_error($conn);
    }

    // Return the array of password requests
    return $passwordRequests;
}

// Retrieve password requests from the database
$passwordRequests = getPasswordRequestsFromDatabase($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
   
</head>
<body>
<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="card-body">
                <h1>Prayer Requests</h1>
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Request</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th> <!-- Added Action column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prayerRequests as $request) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($request['id']); ?></td>
                                <td><?php echo htmlspecialchars($request['firstname']); ?></td>
                                <td><?php echo htmlspecialchars($request['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($request['email']); ?></td>
                                <td><?php echo htmlspecialchars($request['contact_number']); ?></td>
                                <td><?php echo htmlspecialchars($request['request']); ?></td>
                                <td><?php echo htmlspecialchars($request['date']); ?></td>
                                <td><?php echo htmlspecialchars($request['status']); ?></td>
                                <td>
                                    <button class="btn btn-primary" onclick="editPrayerRequest(<?php echo $request['id']; ?>)">Edit</button>
                                    <button class="btn btn-danger" onclick="deletePrayerRequest(<?php echo $request['id']; ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Forgotten Password Form -->
<div class="container-fluid px-4">
    <div class="row">
        <div class="card-body">
            <h1>Forgotten Password Requests</h1>
            <table id="passwordRequestsTable" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th> <!-- Added Action column -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($passwordRequests as $request) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($request['id']); ?></td>
                            <td><?php echo htmlspecialchars($request['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($request['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($request['email']); ?></td>
                            <td><?php echo htmlspecialchars($request['contact_number']); ?></td>
                            <td><?php echo htmlspecialchars($request['date']); ?></td>
                            <td><?php echo htmlspecialchars($request['status']); ?></td>
                            <td>
                                <button class="btn btn-primary" onclick="editPasswordRequest(<?php echo $request['id']; ?>)">Edit</button>
                                <button class="btn btn-danger" onclick="deletePasswordRequest(<?php echo $request['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- Edit Prayer Request Modal -->
<div class="modal fade" id="editPrayerRequestModal" tabindex="-1" aria-labelledby="editPrayerRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPrayerRequestModalLabel">Edit Prayer Request</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form fields for editing prayer requests -->
                <form id="editPrayerRequestForm">
                    <div class="form-group">
                        <label for="editFirstName">First Name</label>
                        <input type="text" class="form-control" id="editFirstName" name="editFirstName">
                    </div>
                    <div class="form-group">
                        <label for="editLastName">Last Name</label>
                        <input type="text" class="form-control" id="editLastName" name="editLastName">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="editEmail">
                    </div>
                    <div class="form-group">
                        <label for="editContact">Contact</label>
                        <input type="text" class="form-control" id="editContact" name="editContact">
                    </div>
                    <div class="form-group">
                        <label for="editRequest">Request</label>
                        <textarea class="form-control" id="editRequest" name="editRequest"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editDate">Date</label>
                        <input type="text" class="form-control" id="editDate" name="editDate" disabled>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select class="form-control" id="editStatus" name="editStatus">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Password Request Modal -->
<div class="modal fade" id="editPasswordRequestModal" tabindex="-1" aria-labelledby="editPasswordRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPasswordRequestModalLabel">Edit Password Request</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form fields for editing password requests -->
                <form id="editPasswordRequestForm">
                    <div class="mb-3">
                        <label for="editPasswordFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="editPasswordFirstName" name="editPasswordFirstName">
                    </div>
                    <div class="mb-3">
                        <label for="editPasswordLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="editPasswordLastName" name="editPasswordLastName">
                    </div>
                    <!-- Add other fields here -->
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to populate edit modal for prayer request
    function editPrayerRequest(id) {
        // Find the prayer request with the given ID
        var request = <?php echo json_encode($prayerRequests); ?>;
        var selectedRequest = request.find(req => req.id === id);

        // Populate the modal with the request data
        document.getElementById('editFirstName').value = selectedRequest.firstname;
        document.getElementById('editLastName').value = selectedRequest.lastname;
        document.getElementById('editEmail').value = selectedRequest.email;
        document.getElementById('editContact').value = selectedRequest.contact_number;
        document.getElementById('editRequest').value = selectedRequest.request;
        document.getElementById('editDate').value = selectedRequest.date;
        document.getElementById('editStatus').value = selectedRequest.status;

        // Show the modal
        $('#editPrayerRequestModal').modal('show');
    }

    // Function to populate edit modal for password request
    function editPasswordRequest(id) {
        // Find the password request with the given ID
        var request = <?php echo json_encode($passwordRequests); ?>;
        var selectedRequest = request.find(req => req.id === id);

        // Populate the modal with the request data
        document.getElementById('editPasswordFirstName').value = selectedRequest.firstname;
        document.getElementById('editPasswordLastName').value = selectedRequest.lastname;
        // Populate other fields similarly

        // Show the modal
        $('#editPasswordRequestModal').modal('show');
    }
</script>

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
</body>
</html>
<?php
include('includes/script.php');
?>

<!-- JavaScript functions for edit, delete, and response handling -->
<script>
    function editPrayerRequest(id) {
        // Add your edit logic here
        alert('Edit prayer request with ID ' + id);
    }

    function deletePrayerRequest(id) {
        // Add your delete logic here
        alert('Delete prayer request with ID ' + id);
    }

    function editPasswordRequest(id) {
        // Add your edit logic here
        alert('Edit password request with ID ' + id);
    }

    function deletePasswordRequest(id) {
        // Add your delete logic here
        alert('Delete password request with ID ' + id);
    }


</script>
