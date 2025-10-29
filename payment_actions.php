<?php
include_once("fun.inc.php");

function getUnimedConnection() {
    return mysqli_connect("localhost", "unimed5_spgs", "pay@UN1M3D", "unimed5_unimedportaldb");
}

function getGraduateConnection() {
    return mysqli_connect("localhost", "spgsportal_graduatedb", "@Reproduction@1", "spgsportal_graduate");
}



function generateTransactionId() {
    return 'SSF' . rand(2000000000, 2999999999);
}

function generateEcall() {
    return 'EC' . strtoupper(uniqid());
}

//$conn = payconnect("unimed5_unimedportaldb");
$conn = getUnimedConnection();
$message = "";
$candidate = null;
$departments = [];

// Fetch departments for dropdown
$departments = [];

// Use resultnew() to query the correct database
$deptQuery = "SELECT DISTINCT dept FROM Screened_Candidates_2022 ORDER BY dept ASC";
$deptResult = resultnew($deptQuery);
if ($deptResult && mysqli_num_rows($deptResult) > 0) {
    while ($row = mysqli_fetch_assoc($deptResult)) {
        $departments[] = $row['dept'];
    }
}

// Fetch candidate details by regno
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fetch'])) {
   // $regno = mysqli_real_escape_string(payconnect("unimed5_unimedportaldb"), $_POST['regno']); // sanitize with local connection
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $query = "SELECT * FROM Screened_Candidates_2022 WHERE regno='$regno'";
    $result = resultnew($query);
    if ($result && mysqli_num_rows($result) > 0) {
        $candidate = mysqli_fetch_assoc($result);
    } else {
        $message = "<p class='error'>No candidate found with Reg No: $regno</p>";
    }
}

// Insert payment record
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {
    $transactionid = generateTransactionId();
    $ecall = generateEcall();

    $matricno = $_POST['matricno'];
    $sname = $_POST['sname'];
    $oname = $_POST['oname'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $studenttype = 'PG';
    $programmetype = $_POST['programmetype'];
    $amount = (float)$_POST['amount'];
    $feestatus = $_POST['feestatus'];
    $feetype = $_POST['feetype'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $session = $_POST['session'];
    $status = $_POST['status'];
    $platformrep = $_POST['platformrep'];
    $refdate = date('Y-m-d');

    $query = "INSERT INTO paymentinvoice (transactionid, matricno, sname, oname, faculty, department, level, studenttype, programmetype, amount, feestatus, feetype, mobile, email, session, ecall, status, platformrep, refdate)
              VALUES ('$transactionid', '$matricno', '$sname', '$oname', '$faculty', '$department', '$level', '$studenttype', '$programmetype', '$amount', '$feestatus', '$feetype', '$mobile', '$email', '$session', '$ecall', '$status', '$platformrep', '$refdate')";
    if (mysqli_query($conn, $query)) {
        $message = "<p class='message'>Record inserted successfully. Transaction ID: <strong>$transactionid</strong>, eCall: <strong>$ecall</strong></p>";
    } else {
        $message = "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UNIMED SPGS Payment Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 40px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-section {
            margin-bottom: 40px;
        }
        .form-section h3 {
            margin-bottom: 20px;
            color: #0d6efd;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
        .error {
            margin-top: 20px;
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">UNIMED SPGS Payment Portal</h2>

    <?= $message ?>

    <!-- Fetch Form -->
    <div class="form-section">
        <form method="POST" class="row g-3">
            <h3>Fetch Candidate by Reg No</h3>
            <div class="col-md-8">
                <label for="regno" class="form-label">Reg No:</label>
                <input type="text" class="form-control" name="regno" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" name="fetch" class="btn btn-primary w-100">Fetch</button>
            </div>
        </form>
    </div>

    <!-- Insert Form -->
    <?php if ($candidate): ?>
    <div class="form-section">
        <form method="POST" class="row g-3">
            <h3>Insert Payment Record</h3>
            <input type="hidden" name="matricno" value="<?= $candidate['regno'] ?>">

            <div class="col-md-6">
                <label class="form-label">Surname:</label>
                <input type="text" class="form-control" name="sname" value="<?= $candidate['surname'] ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Other Names:</label>
                <input type="text" class="form-control" name="oname" value="<?= $candidate['onames'] ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Faculty:</label>
                <input type="text" class="form-control" name="faculty" value="<?= $candidate['faculty'] ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Department:</label>
                <select name="department" class="form-select" required>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= $dept ?>" <?= $dept == $candidate['dept'] ? 'selected' : '' ?>><?= $dept ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Level:</label>
                <select name="level" class="form-select" required>
                    <option value="700">700</option>
                    <option value="800">800</option>
                    <option value="900">900</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Programme Type:</label>
                <select name="programmetype" class="form-select" required>
                    <option value="Postgraduate Diploma">Postgraduate Diploma</option>
                    <option value="Masters">Masters</option>
                    <option value="Doctorate">Doctorate</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Amount:</label>
                <input type="number" class="form-control" name="amount" step="0.01" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fee Status:</label>
                <input type="text" class="form-control" name="feestatus" value="PAID" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fee Type:</label>
                <select name="feetype" class="form-select" required>
                    <option value="UNIMED SPGS ACCEPTANCE FEE">UNIMED SPGS ACCEPTANCE FEE</option>
                    <option value="UNIMED SPGS SCHOOL FEE">UNIMED SPGS SCHOOL FEE</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Mobile:</label>
                <input type="text" class="form-control" name="mobile" value="<?= $candidate['phoneno'] ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="<?= $candidate['email'] ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Session:</label>
                <select name="session" class="form-select" required>
                    <option value="2024/2025">2024/2025</option>
                    <option value="2025/2026">2025/2026</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select" required>
                    <option value="PAID">PAID</option>
                    <option value="UNPAID">UNPAID</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Platform Rep:</label>
                <select name="platformrep" class="form-select" required>
                    <option value="etz">etz</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" name="insert" class="btn btn-success w-100">Insert Record</button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
