<?php
// Process payment and generate receipt

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$card = $_POST['card'];
$expiry = $_POST['expiry'];
$cvv = $_POST['cvv'];

// Here you would integrate with a payment gateway and process the payment

// Assuming payment is successful, generate receipt
$receipt = "Receipt Details:\n";
$receipt .= "Name: $name\n";
$receipt .= "Email: $email\n";
$receipt .= "Address: $address\n";
$receipt .= "Credit Card: $card\n";
$receipt .= "Expiry: $expiry\n";
$receipt .= "CVV: $cvv\n";
// Add more details as needed

// Save or send the receipt (e.g., email it to the customer)
// For demonstration purposes, let's just print it
echo nl2br($receipt);
