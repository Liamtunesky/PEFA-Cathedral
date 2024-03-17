<?php
include('database.php');
include('includes/header.php');
include('includes/navbar.php');

// Function to fetch members from the database with optional filtering
function getMembersFromDatabase($filter = null) {
    global $conn;
    $members = array();
    
    // Example query to fetch members
    $sql = "SELECT * FROM members";
    
    // Add filtering conditions if provided
    if ($filter) {
        $sql .= " WHERE $filter";
    }
    
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($result) {
        // Fetch associative array of members
        while ($row = mysqli_fetch_assoc($result)) {
            $members[] = $row;
        }
    } else {
        // Handle query error
        echo "Error fetching members: " . mysqli_error($conn);
    }

    return $members;
}

// Function to fetch donations from the database with optional filtering
function getDonationsFromDatabase($filter = null) {
    global $conn;
    $donations = array();
    
    // Example query to fetch donations
    $sql = "SELECT * FROM donations";
    
    // Add filtering conditions if provided
    if ($filter) {
        $sql .= " WHERE $filter";
    }
    
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($result) {
        // Fetch associative array of donations
        while ($row = mysqli_fetch_assoc($result)) {
            $donations[] = $row;
        }
    } else {
        // Handle query error
        echo "Error fetching donations: " . mysqli_error($conn);
    }

    return $donations;
}

// Function to fetch products from the database with optional filtering
function getProductsFromDatabase($filter = null) {
    global $conn;
    $products = array();
    
    // Example query to fetch products
    $sql = "SELECT * FROM products";
    
    // Add filtering conditions if provided
    if ($filter) {
        $sql .= " WHERE $filter";
    }
    
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($result) {
        // Fetch associative array of products
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    } else {
        // Handle query error
        echo "Error fetching products: " . mysqli_error($conn);
    }

    return $products;
}

function getTransactionsFromDatabase($filter = null) {
    global $conn;
    $transactions = array();
    
    // Example query to fetch transactions
    $sql = "SELECT * FROM transactions";
    
    // Add filtering conditions if provided
    if ($filter) {
        $sql .= " WHERE $filter";
    }
    
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($result) {
        // Fetch associative array of transactions
        while ($row = mysqli_fetch_assoc($result)) {
            $transactions[] = $row;
        }
    } else {
        // Handle query error
        echo "Error fetching transactions: " . mysqli_error($conn);
    }

    return $transactions;
}

// Fetch members from the database
$current_members = getMembersFromDatabase();

// Fetch donations from the database
$donations = getDonationsFromDatabase();

// Fetch products from the database
$products = getProductsFromDatabase();

// Fetch transactions from the database
$transactions = getTransactionsFromDatabase();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <style>
        /* CSS styles */
        .report-container {
            display: inline-block;
            width: calc(33.33% - 20px);
            margin: 10px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }
        .report-container:hover {
            transform: translate(5%, 5%);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .report-container h3 {
            margin-top: 10px;
        }
        .icon {
            font-size: 50px;
            margin-bottom: 10px;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            z-index: 9999;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }
        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .close-btn {
            cursor: pointer;
            font-size: 20px;
            color: #888;
        }
        .print-btn {
            cursor: pointer;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        /* Icon colors */
        .members-icon {
            color: green;
        }
        .donations-icon {
            color: blue;
        }
        .products-icon {
            color: maroon;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <h1 class="mt-4">Reports</h1>

            <!-- Member's Report Container -->
            <div class="report-container" onclick="showPopup('Members Report', <?php echo htmlspecialchars(json_encode($current_members)); ?>)">
                <div class="icon members-icon"><i class="fas fa-users"></i></div>
                <h3>Member's Report</h3>
            </div>

            <!-- Donations Report Container -->
            <div class="report-container" onclick="showPopup('Donations Report', <?php echo htmlspecialchars(json_encode($donations)); ?>)">
                <div class="icon donations-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <h3>Donations Report</h3>
            </div>

            <!-- Products Report Container -->
            <div class="report-container" onclick="showPopup('Products Report', <?php echo htmlspecialchars(json_encode($products)); ?>)">
                <div class="icon products-icon"><i class="fas fa-shopping-cart"></i></div>
                <h3>Products Report</h3>
            </div>

            <!-- Transaction Report Container -->
            <div class="report-container" onclick="showPopup('Transaction Report', <?php echo htmlspecialchars(json_encode($transactions)); ?>)">
                <div class="icon products-icon"><i class="fas fa-mobile-alt"></i></div>
                <h3>Transaction Report</h3>
            </div>

            <!-- Popup -->
            <div class="popup" id="popup">
                <div class="popup-header">
                    <h2 id="popup-title"></h2>
                    <span class="close-btn" onclick="closePopup()">&times;</span>
                </div>
                <div id="popup-content"></div>
                <button class="print-btn" onclick="printPopup()">Print</button>
            </div>

            <!-- Overlay -->
            <div class="overlay" id="overlay"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script>
        function showPopup(title, data) {
            document.getElementById('popup-title').textContent = title;
            var content = generateTable(data);
            document.getElementById('popup-content').innerHTML = content;
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function printPopup() {
            window.print();
        }

        function generateTable(data) {
            var table = '<table class="table">';
            if (Array.isArray(data) && data.length > 0) {
                table += '<thead><tr>';
                Object.keys(data[0]).forEach(function(key) {
                    table += '<th>' + key + '</th>';
                });
                table += '</tr></thead><tbody>';
                data.forEach(function(row) {
                    table += '<tr>';
                    Object.values(row).forEach(function(value) {
                        table += '<td>' + value + '</td>';
                    });
                    table += '</tr>';
                });
                table += '</tbody>';
            } else {
                table += '<tbody><tr><td>No data available</td></tr></tbody>';
            }
            table += '</table>';
            return table;
        }
    </script>
</body>
</html>

<?php
include('includes/script.php');
?>
