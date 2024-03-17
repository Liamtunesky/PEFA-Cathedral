<?php
// Include the database connection file
include('database.php');
include('includes/header.php');
include('includes/navbar.php');

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details from the database based on the provided ID
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        // Redirect to error page or display error message
        echo "Product not found";
    }
} else {
    // Redirect to error page or display error message
    echo "Product ID not provided";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Update product details in the database
    $sql = "UPDATE products SET name = '$name', description = '$description', price = '$price', stock = '$stock' WHERE id = $productId";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Product updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Close the database connection
$conn->close();
?>

<div class="container">
    <h2>Edit Product</h2>
    <!-- Product Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $productId; ?>" method="post">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $product['description']; ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $product['stock']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<?php
include('includes/footer.php');
?>
