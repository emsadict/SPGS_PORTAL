<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get total amount made weekly
$stmt = $pdo->prepare('
    SELECT 
        YEARWEEK(date, 1) AS week,
        SUM(amount_charged) AS total_charged,
        SUM(amount_paid) AS total_paid,
        SUM(balance) AS total_balance
    FROM receipts
    WHERE user_id = ?
    GROUP BY YEARWEEK(date, 1)
    ORDER BY YEARWEEK(date, 1) DESC
');
$stmt->execute([$_SESSION['user_id']]);
$weekly_totals = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Totals</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Receipt Portal</h1>
        <ul>
            <li><a href="generate_receipt.php">Generate Receipt</a></li>
            <li><a href="view_receipts.php">View Receipts</a></li>
            <li><a href="weekly_totals.php">Weekly Totals</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>
<div class="container">
    <h2>Weekly Totals</h2>
    <table>
        <tr>
            <th>Week</th>
            <th>Total Charged</th>
            <th>Total Paid</th>
            <th>Total Balance</th>
        </tr>
        <?php foreach ($weekly_totals as $total): ?>
        <tr>
            <td><?php echo htmlspecialchars($total['week']); ?></td>
            <td><?php echo htmlspecialchars($total['total_charged']); ?></td>
            <td><?php echo htmlspecialchars($total['total_paid']); ?></td>
            <td><?php echo htmlspecialchars($total['total_balance']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
