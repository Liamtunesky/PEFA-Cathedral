<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include('database.php');
include('includes/header.php');
include('includes/navbar.php');

// Function to fetch products records from the database
function getProductsFromDatabase($conn)
{
    // Your database query to fetch products records
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    $products = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = array(
                'product_id' => $row['product_id'],
                'picture' => $row['picture'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'stock' => $row['stock'],
            );
        }
    }

    return $products;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted"; // Debugging line
    
    // Upload product picture
    $targetDirectory = "Church/church products/uploads/";

// Check if the directory doesn't exist
if (!file_exists($targetDirectory)) {
    // Create the directory recursively
    if (!mkdir($targetDirectory, 0777, true)) {
        // Failed to create directory
        die('Failed to create directory ' . $targetDirectory);
    }
}
    $targetFile = $targetDirectory . basename($_FILES["productPicture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Process form data
    $productName = $_POST['name'];
    $productDescription = $_POST['description'];
    $productPrice = $_POST['price'];
    $productStock = $_POST['stock'];

    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["productPicture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["productPicture"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // Handle errors
        echo "File upload failed"; // Debugging line
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["productPicture"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now insert data into database
            $sql = "INSERT INTO products (picture, name, description, price, stock) VALUES ('$targetFile', '$productName', '$productDescription', '$productPrice', '$productStock')";
            if ($conn->query($sql) === TRUE) {
                // Record inserted successfully, you can redirect or display a success message
                echo "New record created successfully";
            } else {
                // Error inserting record
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // Error uploading file
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Fetch products from the database
$products = getProductsFromDatabase($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
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
    </style>
</head>
<body>
    

<div id="layoutSidenav_content">
    <div class="container">
        <h2>Products</h2>
        <!-- Button to trigger the modal -->
<button type="button" id="open-modal" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Add New Product</button>

        <!-- Modal for adding a new product -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                   <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                        <span class="close" id="close-modal">&times;</span>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Form to add product details -->
                        <form id="addProductForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            <!-- Picture -->
                            <div class="form-group">
                                <label for="productPicture">Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="productPicture" name="productPicture" required>
                                    <label class="custom-file-label" for="productPicture">Choose file</label>
                                </div>
                            </div>
                            <!-- Product Name -->
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name" required>
                            </div>
                            <!-- Description -->
                            <div class="form-group">
                                <label for="productDescription">Description</label>
                                <textarea class="form-control" id="productDescription" name="description" rows="3" placeholder="Enter product description" required></textarea>
                            </div>
                            <!-- Price -->
                            <div class="form-group">
                                <label for="productPrice">Price</label>
                                <input type="text" class="form-control" id="productPrice" name="price" placeholder="Enter product price" required>
                            </div>
                            <!-- Stock -->
                            <div class="form-group">
                                <label for="productStock">Stock</label>
                                <input type="number" class="form-control" id="productStock" name="stock" placeholder="Enter product stock" required>
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid px-4">
            <div class="row">
                <div class="card-body">
                    <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td><?php echo $product['product_id']; ?></td>
                                    <!-- Display picture -->
                                    <td><img src="<?php echo $product['picture']; ?>" alt="Product Picture" style="max-width: 100px;"></td>
                                    <td><?php echo $product['name']; ?></td>
                                    <td><?php echo $product['description']; ?></td>
                                    <td><?php echo $product['price']; ?></td>
                                    <td><?php echo $product['stock']; ?></td>
                                    <td>
                                        <!-- Edit button -->
                                        <button onclick="openEditModal('<?php echo $product['product_id']; ?>', '<?php echo $product['name']; ?>', '<?php echo $product['description']; ?>', '<?php echo $product['price']; ?>', '<?php echo $product['stock']; ?>')" class="btn btn-primary">Edit</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit modal for editing products -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <span class="close" id="close-edit-modal">&times;</span>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Form to edit product details -->
                <form id="editProductForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <!-- Product ID (hidden) -->
                    <input type="hidden" id="editProductId" name="editProductId">
                    <!-- Picture -->
                    <div class="form-group">
                        <label for="editProductPicture">Picture</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="editProductPicture" name="editProductPicture">
                            <label class="custom-file-label" for="editProductPicture">Choose file</label>
                        </div>
                    </div>
                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="editProductName">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="editProductName" required>
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="editProductDescription">Description</label>
                        <textarea class="form-control" id="editProductDescription" name="editProductDescription" rows="3" required></textarea>
                    </div>
                    <!-- Price -->
                    <div class="form-group">
                        <label for="editProductPrice">Price</label>
                        <input type="text" class="form-control" id="editProductPrice" name="editProductPrice" required>
                    </div>
                    <!-- Stock -->
                    <div class="form-group">
                        <label for="editProductStock">Stock</label>
                        <input type="number" class="form-control" id="editProductStock" name="editProductStock" required>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
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
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap JavaScript (popper.js is required for Bootstrap modals) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Get the modal
    var modal = document.getElementById("addProductModal");

    // Get the close button element
    var closeBtn = document.getElementById("close-modal");

    // Get the button to open the modal
    var openBtn = document.getElementById("open-modal");

    // When the user clicks the button, open the modal 
    openBtn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on the close button, close the modal
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
     // Get the edit modal
     var editModal = document.getElementById("editProductModal");

// Get the close button element for edit modal
var closeEditBtn = document.getElementById("close-edit-modal");

// When the user clicks on the close button for edit modal, close the modal
closeEditBtn.onclick = function() {
    editModal.style.display = "none";
}

// Function to open edit modal and populate with product details
function openEditModal(productId, productName, productDescription, productPrice, productStock) {
    // Set values in the edit form
    document.getElementById("editProductId").value = productId;
    document.getElementById("editProductName").value = productName;
    document.getElementById("editProductDescription").value = productDescription;
    document.getElementById("editProductPrice").value = productPrice;
    document.getElementById("editProductStock").value = productStock;
    
    // Show the edit modal
    editModal.style.display = "block";
}
</script>

</body>
</html>
<?php

include('includes/script.php');
?>
