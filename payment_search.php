<!DOCTYPE html>
<html>
<head>
    <title>Payment Invoice Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
            text-align: center;
        }
        input[type="text"] {
            padding: 10px;
            width: 300px;
            margin-right: 10px;
        }
        button {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
        }
        .no-result {
            text-align: center;
            color: red;
            margin-top: 20px;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            background: #eee;
            text-decoration: none;
            border-radius: 4px;
        }
        .pagination a.active {
            background: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Search Payment Invoice</h2>
    <form method="GET">
        <input type="text" name="search" placeholder="Enter Matric No or Transaction ID" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Search</button>
    </form>

<?php
function getPaymentInvoiceColumns() {
    $conn = mysqli_connect("localhost", "unimed5_spgs", "pay@UN1M3D", "unimed5_unimedportaldb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SHOW COLUMNS FROM paymentinvoice";
    $result = mysqli_query($conn, $query);

    $columns = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $columns[] = $row['Field'];
        }
    }

    return $columns;
}

function payconnect() {
    $conn = mysqli_connect("localhost", "unimed5_spgs", "pay@UN1M3D", "unimed5_unimedportaldb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function retInvoiceP($matricno, $paytype, $session) {
    $conn = payconnect();
    $query = "SELECT * FROM paymentinvoice WHERE matricno='$matricno' AND feetype='$paytype' AND session='$session' AND feestatus='PAID' ORDER BY DESC DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) >= 1 ? mysqli_fetch_array($result) : 0;
}

function getSumPaid($matricno, $feetypePattern, $session) {
    $conn = payconnect();
    $feetypePattern = mysqli_real_escape_string($conn, $feetypePattern);
    $matricno = mysqli_real_escape_string($conn, $matricno);
    $session = mysqli_real_escape_string($conn, $session);

    $query = "SELECT SUM(amount) FROM paymentinvoice 
              WHERE matricno='$matricno' 
              AND feetype LIKE '%$feetypePattern%' 
              AND session='$session' 
              AND feestatus='PAID'";
    $result = mysqli_query($conn, $query);
    $recs = mysqli_fetch_array($result);
    return $result && mysqli_num_rows($result) >= 1 ? $recs[0] : 0;
}

// Search and pagination
$conn = payconnect();
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, trim($_GET['search'])) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 50;
$offset = ($page - 1) * $limit;

$where = "WHERE feetype LIKE 'UNIMED SPGS%'";
if ($search) {
    $where .= " AND (matricno LIKE '%$search%' OR transactionid LIKE '%$search%')";
}

$countQuery = "SELECT COUNT(*) as total FROM paymentinvoice $where";
$countResult = mysqli_query($conn, $countQuery);
$totalRows = $countResult ? mysqli_fetch_assoc($countResult)['total'] : 0;
$totalPages = max(1, ceil($totalRows / $limit));

$query = "SELECT * FROM paymentinvoice $where ORDER BY refdate DESC LIMIT $offset, $limit";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>Matric No</th>
            <th>Surname</th>
            <th>onames</th>
            <th>Transaction ID</th>
            <th>Fee Type</th>
            <th>Amount</th>
            <th>Session</th>
            <th>Status</th>
            <th>refdate</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['matricno']}</td>
                <td>{$row['sname']}</td>
                <td>{$row['oname']}</td>
                <td>{$row['transactionid']}</td>
                <td>{$row['feetype']}</td>
                <td>₦" . number_format($row['amount'], 2) . "</td>
                <td>{$row['session']}</td>
                <td>{$row['feestatus']}</td>
                <td>{$row['refdate']}</td>
              </tr>";
    }
    echo "</table>";

    // Pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = $i == $page ? 'active' : '';
        $params = http_build_query(array_merge($_GET, ['page' => $i]));
        echo "<a href='?$params' class='$active'>$i</a>";
    }
    echo "</div>";
} else {
    echo "<p class='no-result'>No payment records found.</p>";
}
?>

</div><?php
$columns = getPaymentInvoiceColumns();
echo "<ul>";
foreach ($columns as $col) {
    echo "<li>$col</li>";
}
echo "</ul>";
?>
</body>
</html>
