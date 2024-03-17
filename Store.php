<?php
// Start the session
session_start();

// Check if user is logged in
if(isset($_SESSION['username'])) {
    $welcome_message = "Welcome, ".$_SESSION['username']."!";
} else {
    $welcome_message = "Welcome!";
}

// Include the database connection file
include('database.php');

// Check if $_SESSION['cart'] is not set, then initialize it as an empty array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Fetch products from the database
$products = getProductsFromDatabase($conn);

// Initialize cart total
$cartTotal = 0;


// Check if the cart session variable is set
if (isset($_SESSION['cart'])) {
    // Loop through each item in the cart
    foreach ($_SESSION['cart'] as $item) {
        
    }
}

// Function to fetch products from the database
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
                'stock' => $row['stock']
            );
        }
    }

    return $products;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | PEFA Githurai</title>
    <link rel="stylesheet" href="styles.css">
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Anton&family=Caveat:wght@700&display=swap" rel="stylesheet">
    <style>
body {
    /* Gradient background */
    background: linear-gradient(-45deg, #ffffff, #007bff);
    /* Other styles */
    font-family: Arial, sans-serif; /* Example font family */
    margin: 0;
    padding: 0;
    animation: gradientBackground 10s ease infinite; /* Apply animation */
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
      /* Style for login/logout buttons */
button {
    padding: 10px 20px; /* Add padding for button */
    margin: 0 10px; /* Add margin for spacing */
    border: none; /* Remove border */
    background-color: #28a745; /* Green background */
    color: #fff; /* White text color */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s; /* Smooth transition for background color */
}

/* Hover effect */
button:hover {
    background-color: #218838; /* Darker green on hover */
}
    /* Basic styles for product containers */
    .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Spread items horizontally */
    align-items: flex-start;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px; /* Adjust for negative margin */
}

.col {
    flex: 0 0 calc(33.33% - 20px); /* Set the width for each column */
    max-width: calc(33.33% - 20px); /* Set the maximum width for each column */
    padding: 0 10px; /* Adjust for column spacing */
    margin-bottom: 20px; /* Add margin at the bottom of each column */
}

.product-container {
    position: relative;
    margin: 0; /* Adjust margin as needed */
    overflow: hidden;
    width: 100%; /* Adjust width for three columns with margins */
    box-sizing: border-box;
    transition: transform 0.3s ease-in-out; /* Add transition for smoother effect */
    display: flex; /* Use flexbox */
    flex-direction: column; /* Stack child elements vertically */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add box shadow effect with increased spread */
}

.product-container:hover {
    transform: translateY(-10px); /* Transform product container up on hover */
}

.product-container img {
    width: 100%; /* Ensure the image fills the container */
    height: auto;
    display: block;
}

/* Styles for product details */
.product-details {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
    padding: 10px;
    transform: translateY(100%);
    transition: transform 0.3s ease-in-out;
    flex: 1; /* Allow product details to grow to fill available space */
}


        .product-container:hover .product-details {
            transform: translateY(0); /* Transform product details up on hover */
        }

        /* Styles for search bar */
        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .search-bar button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Styles for shopping cart */
        .shopping-cart {
            position: fixed;
            bottom: 0;
            right: 0;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
    </style>
</head>
<body>
    <div class="navbar">
        <span><ion-icon name="call-outline"></ion-icon>0797929470</span>
        <ul>
            <li><a href="https://www.facebook.com/pefagithuraicathedral" target="_blank"><ion-icon name="logo-facebook"></ion-icon></a></li>
            <li><a href="https://www.youtube.com/@PEFAGithuraiCathedral"target="_blank"><ion-icon name="logo-youtube"></ion-icon></a></li>
            <li><a href="https://www.instagram.com/pefachurchgithurai/"target="_blank"><ion-icon name="logo-instagram"></ion-icon></a></li>
        </ul>
        <?php
        // Check if the user is logged in
        //if (isset($_SESSION["username"])) {
            // User is logged in, display logout button
           // echo '<li><button onclick="location.href=\'logout.php\';">Logout</button></li>';
        //} else {
            // User is not logged in, display login button
           // echo '<li><button onclick="location.href=\'memberlogin.php\';">Login</button></li>';
        //}
        ?>
    </div>
    <nav>
        <div class="logo">
            <a href="#"><img src="images/pefa.png" alt="logo image"></a>
        </div> 
        <div class="toggle">
            <a href=""><ion-icon name="menu-outline"></ion-icon></a>
        </div>   
        <ul class="menu">
            <li><a href="Home.html">Home</a></li>
            <li><a href="About.html">About Us</a></li>
            <li><a href="Contact.html">Contact</a></li>
            <li><a href="Ministries.html">Ministries</a></li>
            <li><a href="Store.php">Store</a></li>
            
        </ul>
    </nav>
    <h1><?php echo $welcome_message; ?></h1>
    
    <!-- Product containers will go here -->
<div class="container">
    <div class="row">
        <?php
        $counter = 0; // Counter to keep track of products per row

        // Loop through each product and generate HTML content
        foreach ($products as $product) {
            // Open a new row if it's the start of a new row
            if ($counter % 3 == 0) {
                echo '<div class="row">'; // Start a new row
            }
            ?>
            <div class="col">
                <div class="product-container">
                    <img src="<?php echo $product['picture']; ?>" alt="Product Image">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo $product['description']; ?></p>
                    <p>Price: Ksh <?php echo $product['price']; ?></p>
                    <p>Stock: <?php echo $product['stock']; ?></p>
                    <!-- Add input field for stock -->
                    <input type="number" id="stock<?php echo $product['product_id']; ?>" placeholder="Quantity">
                    <!-- Add to Cart button with onclick event -->
                    <button onclick="addToCart(<?php echo $product['product_id'].', '.$product['price'].', '.$product['stock']; ?>)">Add to Cart</button>
                </div>
            </div>
            <?php
            // Increase the counter
            $counter++;

            // Close the row if it's the end of the row or the last product
            if ($counter % 3 == 0 || $counter == count($products)) {
                echo '</div>'; // Close the row
            }
        }
        ?>
    </div>
</div>

    <!--Shopping Cart Section--> 
    <div class="shopping-cart">
        <h2>Shopping Cart</h2>
        <ul id="cart-items">
             
        </ul>
        <p class="total">Total: Ksh<span id="cart-total">0.00</span></p>
        <button onclick="openCheckoutPopup()">View Cart & Checkout</button>
</div>

<script>
    function openCheckoutPopup() {
        // Create a new popup window
        var popup = window.open('', 'checkoutPopup');

        // Write HTML content to the popup window
        popup.document.write(`
            <html>
            <head>
                <title>Checkout</title>
                <style>
                * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-transform: capitalize;
            transition: all .2s linear;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
            min-height: 100vh;
            background: linear-gradient(90deg, #185bb3 60%, #ffffff 40.1%);
        }

        .container form {
            padding: 20px;
            width: 700px;
            background: #bdb7b7;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            border-style: solid;
        }

        .container form .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .container form .row .col {
            flex: 1 1 250px;
        }

        .container form .row .col .title {
            font-size: 20px;
            color: #333;
            padding-bottom: 5px;
            text-transform: uppercase;
        }

        .container form .row .col .inputBox {
            margin: 15px 0;
        }

        .container form .row .col .inputBox span {
            margin-bottom: 10px;
            display: block;
        }

        .container form .row .col .inputBox input {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px 15px;
            font-size: 15px;
            text-transform: none;
        }

        .container form .row .col .inputBox input:focus {
            border: 1px solid #000;
        }

        .container form .submit-btn {
            width: 100%;
            padding: 12px;
            font-size: 17px;
            background: #27ae60;
            color: #fff;
            margin-top: 5px;
            cursor: pointer;
        }

        .container form .submit-btn:hover {
            background: #2ecc71;
        }
    </style>

            </head>
            <body>
            <div class="container">
                <form id="checkoutForm" action="Mpesa integration/stkpush.php" method="post">
                    <h2>Checkout</h2>
                    <div class="row">
            <div class="col">
                <img src="images/mpesa.png" alt="M-Pesa Logo" style="max-width: 100px;">
                <h3 class="title">Billing Address</h3>
                <div class="inputBox">
                    <span>First Name:</span>
                    <input type="text" id="firstName" name="firstName" placeholder="Peter">
                </div>
                <div class="inputBox">
                    <span>Last Name:</span>
                    <input type="text" id="lastName" name="lastName" placeholder="Liam">
                </div>
                <div class="inputBox">
                    <span>Phone Number:</span>
                    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number" required>
                </div>
                <ul id="popup-cart-items">
                    <!-- Populate this list with selected items -->
                </ul>
                <p class="total">Total: Ksh<span id="popup-cart-total">0.00</span></p>
                <button type="submit" class="submit-btn">Proceed to Payment</button>
            </div>
        </div>
                </form>
            </div>
        </body>
        </html>
    `);
        // Copy cart items and total to the popup
        var cartItems = document.getElementById('cart-items').innerHTML;
        popup.document.getElementById('popup-cart-items').innerHTML = cartItems;
        var cartTotal = document.getElementById('cart-total').innerText;
        popup.document.getElementById('popup-cart-total').innerText = cartTotal;

        // Submit form data to stkpush.php
        popup.document.getElementById('paymentForm').onsubmit = function(event) {
            event.preventDefault();
            var name = popup.document.getElementById('name').value;
            var phoneNumber = popup.document.getElementById('phoneNumber').value;
            // You can now send the name, phone number, and other relevant data to stkpush.php using AJAX
            // Example:
            // var formData = { name: name, phoneNumber: phoneNumber, total: cartTotal };
            // fetch('Mpesa integration/stkpush.php', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify(formData)
            // })
            // .then(response => {
            //     // Handle response
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            // });
            document.getElementById("checkoutButton").addEventListener("click", function() {
            // Get form data
            var formData = new FormData(document.getElementById("checkoutForm"));

            // Send form data via AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "Mpesa integration/stkpush.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Payment successful, show success message
                            alert("Payment successful!");
                        } else {
                            // Payment failed, show error message
                            alert("Payment failed: " + response.message);
                        }
                    } else {
                        // Request failed, show error message
                        alert("Request failed: " + xhr.status);
                    }
                }
            };
            xhr.send(new URLSearchParams(formData));
        });
            // Close the popup window
            popup.close();
        };
    }
        let cartTotal = 0;

        function addToCart(productId, price, stock) {
        let quantity = parseInt(document.getElementById('stock' + productId).value); // Get the quantity entered by the user
        if (quantity > 0 && quantity <= stock) { // Check if the quantity is valid
            cartTotal += parseFloat(price * quantity); // Add the price multiplied by the quantity to the cart total
            document.getElementById('cart-total').textContent = cartTotal.toFixed(2);
        } else {
            alert("Invalid quantity!"); // Alert the user if the quantity is invalid
        }
    }
    </script>
</body>
</html>
