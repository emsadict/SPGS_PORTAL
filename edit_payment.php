<?php
include_once("fun.inc.php");

function getUnimedConnection() {
    return mysqli_connect("localhost", "unimed5_spgs", "pay@UN1M3D", "unimed5_unimedportaldb");
}

$conn = getUnimedConnection();
$message = "";
$payment = null;

// Load record by ID
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT * FROM paymentinvoice WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $payment = mysqli_fetch_assoc($result);
    } else {
        $message = "<div class='alert alert-danger'>Record not found.</div>";
    }
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $amount = (float)$_POST['amount'];
    $feetype = $_POST['feetype'];
    $status = $_POST['status'];
    $session = $_POST['session'];
    $feestatus = $_POST['feestatus'];
    $platformrep = $_POST['platformrep'];

    $query = "UPDATE paymentinvoice SET amount='$amount', feetype='$feetype', status='$status', session='$session', feestatus='$feestatus', platformrep='$platformrep' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        $message = "<div class='alert alert-success'>Record updated successfully.</div>";
        $payment = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM paymentinvoice WHERE id=$id"));
    } else {
        $message = "<div class='alert alert-danger'>Error updating record: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Payment Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Payment Record</h2>

    <?= $message ?>

    <?php if ($payment): ?>
    <form method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?= $payment['id'] ?>">

        <div class="col-md-6">
            <label class="form-label">Transaction ID:</label>
            <input type="text" class="form-control" value="<?= $payment['transactionid'] ?>" disabled>
        </div>
        <div class="col-md-6">
            <label class="form-label">Matric No:</label>
            <input type="text" class="form-control" value="<?= $payment['matricno'] ?>" disabled>
        </div>
        <div class="col-md-6">
            <label class="form-label">Amount:</label>
            <input type="number" class="form-control" name="amount" value="<?= $payment['amount'] ?>" step="0.01" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Fee Type:</label>
            <select name="feetype" class="form-select" required>
                <option value="UNIMED SPGS ACCEPTANCE FEE" <?= $payment['feetype'] == 'UNIMED SPGS ACCEPTANCE FEE' ? 'selected' : '' ?>>UNIMED SPGS ACCEPTANCE FEE</option>
                <option value="UNIMED SPGS SCHOOL FEE" <?= $payment['feetype'] == 'UNIMED SPGS SCHOOL FEE' ? 'selected' : '' ?>>UNIMED SPGS SCHOOL FEE</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Fee Status:</label>
            <input type="text" class="form-control" name="feestatus" value="<?= $payment['feestatus'] ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Session:</label>
            <select name="session" class="form-select" required>
                <option value="2024/2025" <?= $payment['session'] == '2024/2025' ? 'selected' : '' ?>>2024/2025</option>
                <option value="2025/2026" <?= $payment['session'] == '2025/2026' ? 'selected' : '' ?>>2025/2026</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Status:</label>
            <select name="status" class="form-select" required>
                <option value="PAID" <?= $payment['status'] == 'PAID' ? 'selected' : '' ?>>PAID</option>
                <option value="UNPAID" <?= $payment['status'] == 'UNPAID' ? 'selected' : '' ?>>UNPAID</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Platform Rep:</label>
            <select name="platformrep" class="form-select" required>
                <option value="etz" <?= $payment['platformrep'] == 'etz' ? 'selected' : '' ?>>etz</option>
            </select>
        </div>
        <div class="col-12">
            <button type="submit" name="update" class="btn btn-success w-100">Update Record</button>
        </div>
    </form>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
