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
    </style>
</head>
<body>
<div class="container">
    <h2>Search Payment Invoice</h2>
    <form method="POST">
        <input type="text" name="search" placeholder="Enter Matric No or Transaction ID" required>
        <button type="submit">Search</button>
    </form>

<?php
// Replace with your actual DB connection
function payconnect($query) {
    $conn = mysqli_connect("localhost", "unimed5_spgs", "pay@UN1M3D", "unimed5_unimedportaldb");
    return mysqli_query($conn, $query);
}

// Optional: your existing functions
function retInvoiceP($matricno, $paytype, $session) {
    $checkQuery = "SELECT * FROM paymentinvoice WHERE matricno='$matricno' AND feetype='$paytype' AND session='$session' AND feestatus='PAID' ORDER BY id DESC LIMIT 1";
    $checkResult = payconnect($checkQuery);
    return mysqli_num_rows($checkResult) >= 1 ? mysqli_fetch_array($checkResult) : 0;
}

function getSumPaid($matricno, $feetype, $session) {
    $checkQuery = "SELECT SUM(amount) FROM paymentinvoice WHERE matricno='$matricno' AND feetype='$feetype' AND session='$session' AND feestatus='PAID'";
    $checkResult = payconnect($checkQuery);
    $recs = mysqli_fetch_array($checkResult);
    return mysqli_num_rows($checkResult) >= 1 ? $recs[0] : 0;
}

// Handle search
$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$query = $search
    ? "SELECT * FROM paymentinvoice WHERE matricno LIKE '%$search%' OR transactionid LIKE '%$search%' ORDER BY id DESC"
    : "SELECT * FROM paymentinvoice ORDER BY id DESC LIMIT 500";

$result = payconnect($query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>Matric No</th>
            <th>surname</th>
            <th>Transaction ID</th>
            <th>Fee Type</th>
            <th>Amount</th>
            <th>Session</th>
            <th>Status</th>
            <th>Date Paid</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['matricno']}</td>
                <td>{$row['oname']}</td>
                <td>{$row['transactionid']}</td>
                <td>{$row['feetype']}</td>
                <td>₦" . number_format($row['amount'], 2) . "</td>
                <td>{$row['session']}</td>
                <td>{$row['feestatus']}</td>
                <td>{$row['Date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p class='no-result'>No payment records found.</p>";
}
?>
</div>
</body>
</html>
