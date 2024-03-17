<?php
// Include the database connection file
include('database.php');
include('includes/header.php');
include('includes/navbar.php');

// Fetch donations records from the database
$donations = getDonationsFromDatabase($conn);

// Function to fetch donations records from the database
function getDonationsFromDatabase($conn) {
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM donations";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $donations = array();

    while ($row = $result->fetch_assoc()) {
        // Sanitize the data before displaying it
        $donations[] = array_map('htmlspecialchars', $row);
    }

    return $donations;
}

// Function to add a new donation to the database
function addDonationToDatabase($conn, $donation) {
    $sql = "INSERT INTO donations (donor_information, type, amount, payment_method, purpose, receipt_info) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // Assign values to parameters
    $donor_info = $donation['donor_info'];
    $type = $donation['type'];
    $amount = $donation['amount'];
    $payment_method = $donation['payment_method'];
    $purpose = $donation['purpose'];
    $receipt_info = $donation['receipt_info'];

    $stmt->bind_param("ssdsss", $donor_info, $type, $amount, $payment_method, $purpose, $receipt_info);

    // Execute the prepared statement
    if ($stmt->execute()) {
        return true; // Donation added successfully
    } else {
        return false; // Error occurred while adding donation
    }
}

// Initialize variables for error messages
$errors = array(
    'donor_info' => '',
    'type' => '',
    'amount' => '',
    'payment_method' => '',
    'purpose' => '',
    'receipt_info' => ''
);

// Check if form is submitted for adding a new donation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $isValid = true;

    // Validate Donor's Information
    if (empty($_POST['donor_info'])) {
        $isValid = false;
        $errors['donor_info'] = 'Donor\'s Information is required';
    }

    // Validate Type
    if (empty($_POST['type'])) {
        $isValid = false;
        $errors['type'] = 'Type is required';
    }

    // Validate Amount
    if (!is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
        $isValid = false;
        $errors['amount'] = 'Amount must be a positive number';
    }

    // Validate Purpose
    if (empty($_POST['purpose'])) {
        $isValid = false;
        $errors['purpose'] = 'Purpose is required';
    }

    // Validate Receipt Information
    if (empty($_POST['receipt_info'])) {
        $isValid = false;
        $errors['receipt_info'] = 'Receipt Information is required';
    }

    // If form data is valid, add the donation to the database
    if ($isValid) {
        $donation_data = array(
            'donor_info' => $_POST['donor_info'],
            'type' => $_POST['type'],
            'amount' => $_POST['amount'],
            'payment_method' => 'M-Pesa', // Hardcoded for M-Pesa
            'purpose' => $_POST['purpose'],
            'receipt_info' => $_POST['receipt_info']
        );

        // Add the donation to the database
        if (addDonationToDatabase($conn, $donation_data)) {
            // Donation added successfully
            echo '<script>alert("Donation added successfully."); window.location.href = "donations.php";</script>';
            // Redirect to prevent form resubmission
            header("Location: donations.php");
            exit();
        } else {
            // Error occurred while adding donation
            echo '<script>alert("Failed to add donation. Please try again."); window.location.href = "donations.php";</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    .form-popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.95); /* Semi-transparent white background */
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 90%;
        width: 400px;
        z-index: 1001; /* Ensure the popup appears above other elements */
    }

    .form-popup .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .text-danger {
        color: red;
    }

    /* Truncate text for tabs */
    .truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    </style>
</head>

<body>
    <div id="layoutSidenav_content">
        <div class="container">
        
            <h2>Donations Management</h2>
            <!-- Button to toggle the form popup -->
            <button onclick="toggleFormPopup()" class="btn btn-primary mb-3">Add New Donation</button>
            <!-- Form for adding new donation (initially hidden) -->
            <div class="form-popup" id="addDonationForm">
            <button type="button" class="close" onclick="toggleFormPopup()" aria-label="Close">
             <span aria-hidden="true">&times;</span>
            </button>

                <h4>Add New Donation</h4>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="donor_info">Donor's Information:</label>
                        <input type="text" id="donor_info" name="donor_info" class="form-control" required>
                        <span class="text-danger"><?php echo $errors['donor_info']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="Donation">Donation</option>
                            <option value="Tithe">Tithe</option>
                            <option value="Offering">Offering</option>
                        </select>
                        <span class="text-danger"><?php echo $errors['type']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" class="form-control" required>
                        <span class="text-danger"><?php echo $errors['amount']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method:</label>
                        <select id="payment_method" name="payment_method" class="form-control" required readonly>
                            <option value="M-Pesa" selected>M-Pesa</option>
                        </select>
                        <span class="text-danger"><?php echo $errors['payment_method']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="purpose">Purpose:</label>
                        <input type="text" id="purpose" name="purpose" class="form-control" required>
                        <span class="text-danger"><?php echo $errors['purpose']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="receipt_info">Receipt Information:</label>
                        <input type="text" id="receipt_info" name="receipt_info" class="form-control" required>
                        <span class="text-danger"><?php echo $errors['receipt_info']; ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            
            <!-- Display donations table -->
            <div class="container-fluid px-4">
            <div class="row">
                <div class="card-body">
            <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Donor's Information</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Purpose</th>
                            <th>Receipt Information</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($donations as $donation) { ?>
                            <tr>
                                <td><?php echo $donation['donation_id']; ?></td>
                                <td><?php echo $donation['donor_information']; ?></td>
                                <td><?php echo $donation['type']; ?></td>
                                <td><?php echo $donation['amount']; ?></td>
                                <td><?php echo $donation['payment_method']; ?></td>
                                <td><?php echo $donation['purpose']; ?></td>
                                <td><?php echo $donation['receipt_info']; ?></td>
                                <td>
                                <button type="button" class="btn btn-primary" onclick="openEditPopup(<?php echo $donation['donation_id']; ?>)">Edit</button>
                                    <!-- Delete button (with confirmation) -->
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $donation['donation_id']; ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>  
        <?php foreach ($donations as $donation) { ?>
    <!-- Edit Donation Modal -->
    <div class="modal fade" id="editDonationModal<?php echo $donation['donation_id']; ?>" tabindex="-1" aria-labelledby="editDonationModalLabel<?php echo $donation['donation_id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDonationModalLabel<?php echo $donation['donation_id']; ?>">Edit Donation</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Donation Form with pre-filled data -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="donation_id" value="<?php echo $donation['donation_id']; ?>">
                        <div class="form-group">
                            <label for="edit_donor_info<?php echo $donation['donation_id']; ?>">Donor's Information:</label>
                            <input type="text" id="edit_donor_info<?php echo $donation['donation_id']; ?>" name="edit_donor_info" class="form-control" value="<?php echo $donation['donor_information']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_type<?php echo $donation['donation_id']; ?>">Type:</label>
                            <select id="edit_type<?php echo $donation['donation_id']; ?>" name="edit_type" class="form-control" required>
                                <option value="Donation" <?php if ($donation['type'] == 'Donation') echo 'selected'; ?>>Donation</option>
                                <option value="Tithe" <?php if ($donation['type'] == 'Tithe') echo 'selected'; ?>>Tithe</option>
                                <option value="Offering" <?php if ($donation['type'] == 'Offering') echo 'selected'; ?>>Offering</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_amount<?php echo $donation['donation_id']; ?>">Amount:</label>
                            <input type="number" id="edit_amount<?php echo $donation['donation_id']; ?>" name="edit_amount" class="form-control" value="<?php echo $donation['amount']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_purpose<?php echo $donation['donation_id']; ?>">Purpose:</label>
                            <input type="text" id="edit_purpose<?php echo $donation['donation_id']; ?>" name="edit_purpose" class="form-control" value="<?php echo $donation['purpose']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_receipt_info<?php echo $donation['donation_id']; ?>">Receipt Information:</label>
                            <input type="text" id="edit_receipt_info<?php echo $donation['donation_id']; ?>" name="edit_receipt_info" class="form-control" value="<?php echo $donation['receipt_info']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
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
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript to toggle form popup -->
    <!-- JavaScript to toggle form popup -->
    <script>
       function toggleFormPopup() {
            var formPopup = document.getElementById("addDonationForm");
            if (formPopup.style.display === "none" || formPopup.style.display === "") {
                formPopup.style.display = "block";
            } else {
                formPopup.style.display = "none";
            }
        }

        // Function to open the edit donation popup and populate with donation details
        function openEditPopup(donationId) {
            // Fetch donation details based on donationId and populate the form fields
            var donation = <?php echo json_encode($donations); ?>;
            var selectedDonation = donation.find(d => d.donation_id === donationId);
            document.getElementById("editDonationId").value = selectedDonation.donation_id;
            document.getElementById("editDonorInfo").value = selectedDonation.donor_information;
            // Populate other form fields similarly

            // Display the popup
            $('#editDonationModal').modal('show');
        }

        // Function to confirm and delete donation
        function confirmDelete(donationId) {
            if (confirm("Are you sure you want to delete this donation?")) {
                // Redirect to delete_donation.php with donation ID as parameter
                window.location.href = "delete_donation.php?id=" + donationId;
            }
        }
       
    </script>
    
</body>

</html>
<?php
include('includes/script.php');
?>
