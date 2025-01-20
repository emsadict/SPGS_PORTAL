<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $amount_charged = $_POST['amount_charged'];
    $amount_paid = $_POST['amount_paid'];
    $balance = $amount_charged - $amount_paid;
    $signature = $_POST['signature'];

    $stmt = $pdo->prepare('INSERT INTO receipts (user_id, name, description, amount_charged, amount_paid, balance, signature) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$user_id, $name, $description, $amount_charged, $amount_paid, $balance, $signature]);

    header('Location: view_receipts.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Receipt</title>
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
    <form method="POST">
        <h2>Generate Receipt</h2>
        <input type="text" name="name" placeholder="Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" step="0.01" name="amount_charged" placeholder="Amount Charged" required>
        <input type="number" step="0.01" name="amount_paid" placeholder="Amount Paid" required>
        <input type="text" name="signature" placeholder="Signature" required>
        <button type="submit">Generate</button>
    </form>
</div>
</body>
</html>
