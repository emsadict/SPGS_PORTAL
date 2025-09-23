<!DOCTYPE html>
<html>
<head>
    <title>Transaction Lookup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .result {
            margin-top: 20px;
            background: #e9ecef;
            padding: 15px;
            border-radius: 4px;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Find Transaction Details</h2>
    <form method="POST">
        <label for="transactionid">Enter Transaction ID:</label>
        <input type="text" name="transactionid" id="transactionid" required>
        <button type="submit">Search</button>
    </form>

    <?php
    // Replace with your actual DB connection function
    function payconnect($query) {
        $conn = mysqli_connect("localhost", "unimed5_spgs", "pay@UN1M3D", "unimed5_unimedportaldb");
        return mysqli_query($conn, $query);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $transactionid = trim($_POST['transactionid']);

        $query = "SELECT * FROM paymentinvoice WHERE transactionid='$transactionid' LIMIT 1";
        $result = payconnect($query);

        if (mysqli_num_rows($result) >= 1) {
            $row = mysqli_fetch_assoc($result);
            echo '<div class="result">';
            echo "<strong>Matric No:</strong> " . $row['matricno'] . "<br>";
            echo "<strong>FEEtype:</strong> " . $row['feetype'] . "<br>";
            echo "<strong>Transaction ID:</strong> " . $row['transactionid'] . "<br>";
            echo "<strong>Amount:</strong> ₦" . number_format($row['amount'], 2) . "<br>";
            echo "<strong>Session:</strong> " . $row['session'] . "<br>";
            echo "<strong>Status:</strong> " . $row['feestatus'] . "<br>";
            echo "<strong>Date:</strong> " . $row['datepaid'] . "<br>";
            echo '</div>';
        } else {
            echo '<p class="error">No record found for this Transaction ID.</p>';
        }
    }
    ?>
</div>
</body>
</html>
