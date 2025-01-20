<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM receipts WHERE user_id = ? ORDER BY date DESC');
$stmt->execute([$_SESSION['user_id']]);
$receipts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Receipts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Receipt Portal</h1>
        <ul>
            <li><a href="generate_receipt.php">Generate Receipt</a></li>
            <li><a href="view_receipts.php">View Receipts</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>
<div class="container">
    <h2>Receipts</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Amount Charged</th>
            <th>Amount Paid</th>
            <th>Balance</th>
            <th>Date</th>
            <th>Signature</th>
        </tr>
        <?php foreach ($receipts as $receipt): ?>
        <tr>
            <td><?php echo htmlspecialchars($receipt['name']); ?></td>
            <td><?php echo htmlspecialchars($receipt['description']); ?></td>
            <td><?php echo htmlspecialchars($receipt['amount_charged']); ?></td>
            <td><?php echo htmlspecialchars($receipt['amount_paid']); ?></td>
            <td><?php echo htmlspecialchars($receipt['balance']); ?></td>
            <td><?php echo htmlspecialchars($receipt['date']); ?></td>
            <td><?php echo htmlspecialchars($receipt['signature']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
