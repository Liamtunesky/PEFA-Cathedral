<?php
// Error handling
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve total amount from URL
$total = isset($_GET['total']) ? htmlspecialchars($_GET['total']) : '';

// Debugging
echo "Total Amount: " . $total;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <title>Billing Portal</title>
</head>
<body>
    <div class="container">
        <form id="checkoutForm" action="Mpesa integration/stkpush.php" method="post">
            <div class="row">
                <div class="col">
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
                        <span>Email:</span>
                        <input type="email" id="email" name="email" placeholder="example@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        <div id="emailError" class="error"></div>
                    </div>
                    <div class="inputBox">
                        <span>Contact:</span>
                        <input type="text" id="contact" name="contact" placeholder="0700 000 000">
                    </div>
                </div>
                <div class="col">
                    <h3 class="title">Payment</h3>
                    <div class="inputBox">
                        <span>Payment Method:</span>
                        <img src="images/mpesa.png" alt="Mpesa">
                    </div>
                    <h3 class="title">Order Summary</h3>
                    <div class="flex">
                        <div class="inputBox">
                            <span>Item:</span>
                            <select id="item" name="item">
                                <?php foreach ($items as $item): ?>
                                    <option value="<?php echo $item['name']; ?>"><?php echo $item['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="inputBox">
                            <span>Quantity:</span>
                            <input type="number" id="quantity" name="quantity" value="1" min="1">
                        </div>
                    </div>
                    <div class="inputBox">
                        <span>Total Amount:</span>
                        <input type="text" id="total" name="total" value="<?php echo isset($_GET['total']) ? htmlspecialchars($_GET['total']) : ''; ?>" readonly>
                    </div>
                </div>
            </div>
            <input type="submit" value="Proceed to Checkout" class="submit-btn">
        </form>
    </div>    
</body>
</html>
