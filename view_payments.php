<?php
include_once("fun.inc.php");

function getUnimedConnection() {
    return mysqli_connect("localhost", "unimed5_spgs", "pay@UN1M3D", "unimed5_unimedportaldb");
}

$conn = getUnimedConnection();
$message = "";
$payments = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $query = "SELECT * FROM paymentinvoice WHERE matricno='$regno' ORDER BY refdate DESC";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $payments[] = $row;
        }
    } else {
        $message = "<div class='alert alert-warning'>No payment records found for Reg No: <strong>$regno</strong></div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = (int)$_POST['id'];
    $query = "DELETE FROM paymentinvoice WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        $message = "<div class='alert alert-success'>Payment record deleted successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error deleting record: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Search Payment Records</h2>

    <?= $message ?>

    <form method="POST" class="row g-3 mb-4">
        <div class="col-md-8">
            <label for="regno" class="form-label">Enter Reg No:</label>
            <input type="text" class="form-control" name="regno" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" name="search" class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    <?php if (!empty($payments)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Transaction ID</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Session</th>
                    <th>Ref Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $pay): ?>
                <tr>
                    <td><?= $pay['transactionid'] ?></td>
                    <td><?= $pay['feetype'] ?></td>
                    <td>₦<?= number_format($pay['amount'], 2) ?></td>
                    <td><?= $pay['status'] ?></td>
                    <td><?= $pay['session'] ?></td>
                    <td><?= $pay['refdate'] ?></td>
                    <td>
                        <a href="edit_payment.php?id=<?= $pay['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                            <input type="hidden" name="id" value="<?= $pay['id'] ?>">
                            <button type="submit" name="delete" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
