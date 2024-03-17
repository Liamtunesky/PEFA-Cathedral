<?php
include ('database.php'); // Include the database connection file
include('includes/header.php'); 
include('includes/navbar.php'); 


// Check if the form is submitted for adding a new member
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'process_registration.php'; // Include the registration processing script
}

// Fetch current members from the database
$current_members = getMembersFromDatabase($conn);

// Function to fetch members from the database
function getMembersFromDatabase($conn) {
    // Your database query to fetch members
    $sql = "SELECT * FROM members";
    $result = $conn->query($sql);

    $members = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
    }

    return $members;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Members Management</title>
    <style>
        .add-member-button {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
    max-width: 500px; /* Adjust max-width as needed */
    max-height: 60%; /* Adjust max-height as needed */
    overflow: auto;
    background-color: #fefefe;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
}

.modal-content {
    background-color: #fefefe;
    padding: 15px;
    border: none;
    border-radius: 10px;
    position: relative;
    
}

.form-group {
    margin-bottom: 20px;
}

/* Close Button Style */
.close {
    color: #aaa;
    position: absolute;
    right: 20px;
    top: 10px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .modal-content {
        padding: 10px; /* Adjust padding for smaller screens */
    }

    .form-group {
        margin-bottom: 15px; /* Adjust margin for smaller screens */
    }
}

    </style>
</head>
<body>
<div id="layoutSidenav_content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Members Management</h2>
                <!-- Add New Member Button -->
                <button class="add-member-button" id="add-member-btn">Add New Member</button>
                <!-- Add Member Form -->
                <div id="add-member-modal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="close-modal">&times;</span>
                        
                        <form id="add-member-form" method="post" action="process_registration.php">
                        <h3 style="color: black;">Enter Member Details</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Left Content (Green Background) -->
                                    
                                    <div class="form-group">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control" pattern="[A-Za-z']+">
                                        <small id="first-name-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control" pattern="[A-Za-z']+">
                                        <small id="last-name-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact:</label>
                                        <input type="text" id="contact" name="contact" class="form-control" pattern="[0-9]{10}" required>
                                        <small id="contact-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">Date of Birth:</label>
                                        <input type="date" id="dob" name="dob" class="form-control" required>
                                        <small id="dob-error" class="text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Right Content (Blue Background) -->
                                    <div class="form-group">
                                        <label for="doa">Date of Admission:</label>
                                        <input type="date" id="doa" name="doa" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="qualification">Qualification:</label>
                                        <input type="text" id="qualification" name="qualification" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role:</label>
                                        <input type="text" id="role" name="role" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ministry">Ministry:</label>
                                        <select id="ministry" name="ministry" class="form-control" required>
                                            <option value="youth">Youth</option>
                                            <option value="men">Men</option>
                                            <option value="women">Women</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Add Member" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Member List -->
                
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
                                            <th>Age</th>
                                            <th>Date of Admission</th>
                                           
                                            <th>Qualification</th>
                                            <th>Role</th>
                                            <th>Ministry</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($current_members as $member) { ?>
                                            <tr>
                                                <td><?php echo $member['id']; ?></td>
                                                <td><?php echo $member['first_name']; ?></td>
                                                <td><?php echo $member['last_name']; ?></td>
                                                <td><?php echo $member['contact']; ?></td>
                                                <td><?php echo $member['email']; ?></td>
                                                <td>
                                                    <?php 
                                                        $dob = new DateTime($member['DOB']);
                                                        $now = new DateTime();
                                                        $age = $now->diff($dob)->y;
                                                        echo $age; 
                                                    ?>
                                                </td>
                                                <td><?php echo $member['DOA']; ?></td>
                                                
                                                <td><?php echo $member['qualification']; ?></td>
                                                <td><?php echo $member['role']; ?></td>
                                                <td><?php echo $member['ministry']; ?></td>
                                                <td>
                                                    <button class="edit-button" style="background-color: blue; color: white; border: none;" onclick="openEditModal(<?php echo $member['id']; ?>)">&#43;</button>
                                                    <button class="delete-button" style="background-color: red; color: white; border: none;" onclick="openDeleteModal(<?php echo $member['id']; ?>)">&#8722;</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                    <!-- Edit Modal -->
                    <div id="edit-modal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeEditModal()">&times;</span>
                            <h2>Edit Member</h2>
                            <form id="edit-member-form">
                                <!-- Edit modal content goes here -->
                                <div class="form-group">
                                    <label for="edit-first-name">First Name:</label>
                                    <input type="text" id="edit-first-name" name="edit-first-name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-last-name">Last Name:</label>
                                    <input type="text" id="edit-last-name" name="edit-last-name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-contact">Contact:</label>
                                    <input type="text" id="edit-contact" name="edit-contact" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-email">Email:</label>
                                    <input type="email" id="edit-email" name="edit-email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-dob">Date of Birth:</label>
                                    <input type="date" id="edit-dob" name="edit-dob" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-doa">Date of Admission:</label>
                                    <input type="date" id="edit-doa" name="edit-doa" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-qualification">Qualification:</label>
                                    <input type="text" id="edit-qualification" name="edit-qualification" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-role">Role:</label>
                                    <input type="text" id="edit-role" name="edit-role" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-ministry">Ministry:</label>
                                    <select id="edit-ministry" name="edit-ministry" class="form-control">
                                        <option value="youth">Youth</option>
                                        <option value="men">Men</option>
                                        <option value="women">Women</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Modal -->
            <div id="delete-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                    <h2>Delete Member</h2>
                    <p>Are you sure you want to delete this member?</p>
                    <button onclick="confirmDelete()" class="btn btn-danger">Confirm Delete</button>
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
    

    <script>
        // Get the modal
        var modal = document.getElementById('add-member-modal');

        // Get the button that opens the modal
        var btn = document.getElementById("add-member-btn");

        // Get the <span> element that closes the modal
        var span = document.getElementById("close-modal");

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        // Get the Date of Birth input element
        var dobInput = document.getElementById('dob');

        // Add an event listener to listen for changes in the input value
        dobInput.addEventListener('change', function() {
            // Get the selected Date of Birth value
            var dobValue = new Date(dobInput.value);
            // Get the current date
            var currentDate = new Date();
            // Calculate the difference in years
            var ageDifference = currentDate.getFullYear() - dobValue.getFullYear();

            // Check if the user is at least 18 years old
        if (ageDifference < 18) {
            // Display an error message
            document.getElementById('dob-error').textContent = 'You must be at least 18 years old.';
            // Clear the Date of Birth value
            dobInput.value = '';
        } else {
            // Clear any existing error message
            document.getElementById('dob-error').textContent = '';
        }
});
        // Get the Contact input element
        var contactInput = document.getElementById('contact');

        // Add an event listener to listen for input events
        contactInput.addEventListener('input', function() {
            // Check if the length of the input value exceeds 10 characters
            if (contactInput.value.length > 10) {
                // Display an error message
                document.getElementById('contact-error').textContent = 'Please enter a maximum of 10 digits.';
                // Truncate the input value to 10 characters
                contactInput.value = contactInput.value.slice(0, 10);
            } else {
                // Clear any existing error message
                document.getElementById('contact-error').textContent = '';
            }
        });
       
    // Get the edit modal
var editModal = document.getElementById('edit-modal');

// Function to open the edit modal and fetch member details
function openEditModal(id) {
    // Open the edit modal here and pass the ID to fetch the corresponding record
    console.log("Open edit modal for ID: " + id);

    // Send an AJAX request to fetch member details
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Parse the JSON response
            var member = JSON.parse(this.responseText);

            // Populate the edit modal fields with member data
            document.getElementById("edit-first-name").value = member.first_name;
            document.getElementById("edit-last-name").value = member.last_name;
            document.getElementById("edit-contact").value = member.contact;
            document.getElementById("edit-email").value = member.email;
            document.getElementById("edit-dob").value = member.DOB;
            document.getElementById("edit-doa").value = member.DOA;
            document.getElementById("edit-qualification").value = member.qualification;
            document.getElementById("edit-role").value = member.role;
            document.getElementById("edit-ministry").value = member.ministry;

            // Show the edit modal
            editModal.style.display = "block";
        }
    };
    xhttp.open("GET", "get_member.php?id=" + id, true);
    xhttp.send();
}

// Function to close the edit modal
function closeEditModal() {
    // Close the edit modal
    editModal.style.display = "none";
}
// Function to handle form submission and update member details
document.getElementById("edit-member-form").addEventListener("submit", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Get the form data
    var formData = new FormData(this);

    // Send an AJAX request to update member details
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Update successful, close the edit modal
                closeEditModal();
                // Reload the page or update UI as needed
                location.reload(); // For demonstration purposes, you may choose to reload the page
            } else {
                // Error handling if update fails
                console.error("Error updating member: " + xhr.responseText);
                // Handle error, display message to the user, etc.
            }
        }
    };
    xhr.open("POST", "update_member.php", true);
    xhr.send(formData);
});

    function openDeleteModal(id) {
        // Open the delete modal here and pass the ID to confirm deletion
        console.log("Open delete modal for ID: " + id);
        if (confirm("Are you sure you want to delete this member?")) {
            // If user confirms deletion, call confirmDelete function
            confirmDelete(id);
        }
    }

    var deleteMemberId; // Variable to store the ID of the member to be deleted

    function confirmDelete(id) {
        // Handle the delete confirmation here
        console.log("Confirmed deletion for ID: " + id);
        
        // Perform AJAX request to delete the member from the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_member.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Deletion successful, close modal and reload page or update UI as needed
                    console.log("Member deleted successfully");
                    // Reload the page or update UI
                    location.reload(); // Reload the page for demonstration purposes
                } else {
                    // Error handling if deletion fails
                    console.error("Error deleting member: " + xhr.responseText);
                    // Handle error, display message to the user, etc.
                }
            }
        };
        xhr.send("member_id=" + id);
    }
    </script>
</body>
</html>

<?php
include('includes/script.php');

?>
