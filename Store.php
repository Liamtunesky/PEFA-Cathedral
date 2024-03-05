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
        /* Basic styles for product containers */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
        }
        .product-container {
            position: relative;
            display: inline-block;
            margin: 10px;
            overflow: hidden;
            flex: 0 0 calc(33.33% - 20px); /* Adjust width for three columns with margins */
            max-width: calc(33.33% - 20px); /* Adjust width for three columns with margins */
            box-sizing: border-box;
        }
        .product-container img {
            max-width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease-in-out;
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
        }
        .product-container:hover .product-details {
            transform: translateY(0);
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
    </div>
    <nav>
        <div class="logo">
            <a href="#"><img src="images/pefa.png" alt="logo image"></a>
        </div> 
        <div class="toggle">
            <a href=""><ion-icon name="menu-outline"></ion-icon></a>
        </div>   
        <ul class="menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="About.html">About Us</a></li>
            <li><a href="Contact.html">Contact</a></li>
            <li><a href="Ministries.html">Ministries</a></li>
            <li><a href="Store.html">Store</a></li>
        </ul>
    </nav>
       
    <!-- Product containers will go here -->
    <div class="product-container">
        
    </div>
    
    <!--Shopping Cart Section--> 
    <div class="shopping-cart">
        <h2>Shopping Cart</h2>
        <ul id="cart-items">
             Cart items will be dynamically added here 
        </ul>
        <p class="total">Total: Ksh<span id="cart-total">0.00</span></p>
        <a href="checkout.html"><button>View Cart & Checkout</button></a>
    </div>

    <script>
        let cartTotal = 0;

        function addToCart(price) {
            cartTotal += price;
            document.getElementById('cart-total').textContent = cartTotal.toFixed(2);
        }
    </script>
</body>
</html>
