<?php 
session_start();
include_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

if (!isset($_SESSION['spgs_auth'])) {
  header("location: index.php");
  exit;
}

$spgs_auth = $_SESSION['spgs_auth'];
$user = $spgs_auth[1];
$adminrec = getRecs("admin_table", "username", $user);
$role = $adminrec['role'];
$message = "";
// CSV download
// Handle account creation
if (isset($_POST['create_account'])) {
  $id = $_POST['id'];

  $check = mysqli_query($conn, "SELECT * FROM spgs_acc WHERE id='$id'");
  if (mysqli_num_rows($check) > 0) {
    $data = mysqli_fetch_assoc($check);

    // Double-check regno exists in admitted_2022
    $regno = $data['username'];
    $admitCheck = mysqli_query($conn, "SELECT * FROM admitted_2022 WHERE regno='$regno'");
    $alreadyExists = mysqli_query($conn, "SELECT * FROM spgs_acc_2021_2022 WHERE username='$regno'");

    if (mysqli_num_rows($admitCheck) > 0 && mysqli_num_rows($alreadyExists) == 0) {
    $stmt = $conn->prepare("INSERT INTO spgs_acc_2021_2022 (username, password, question, answer, session, accdate) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $data['username'], $data['password'], $data['question'], $data['answer'], $data['session'], $data['accdate']);
    $stmt->execute();
    $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  Account created for {$data['username']}.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";

  } else {
    $message = "<div class='alert alert-warning'>Account already exists or student not admitted.</div>";
  }
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Students  / Record</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 10 2024 with Bootstrap v5.3.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
    <?php include_once("header.php"); ?>

  <!-- End Header -->


  <!-- ======= Sidebar ======= -->
     <?php include_once("sidebar.php"); ?>
     <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Activate Student Account</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Dashboard</a></li>
          <li class="breadcrumb-item">Student Details</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="card">
      <div class="card-body">
        <form method="POST" action='createstu.php'>
          <div class="row">
            <div class="col-md-4">
              <label>Matric No</label>
              <input type="text" name="regno" class="form-control" placeholder="Search by RegNo">
            </div>
          </div><br />

            <div class="row">
            <div class="col-md-4">
              <label>Faculty</label>
              <select name="faculty" id="faculty" class="form-control">
             <option value="">Select Faculty</option>
               <?php
                $facQuery = mysqli_query($conn, "SELECT DISTINCT faculty FROM spgs_basicinfo");
                 while ($row = mysqli_fetch_assoc($facQuery)) {
                  echo "<option value='{$row['faculty']}'>{$row['faculty']}</option>";
                  }
                 ?>
             </select>
            </div>
            </div><br/>
            <div class="row">
            <div class="col-md-4">
           <select name="dept" id="dept" class="form-control">
           <option value="">Select Department</option>
            </select>
            </div><br/>
            
            <div class="col-md-4">
            <select name="programme" id="programme" class="form-control">
            <option value="">Select Programme</option>
            </select>
            </div><br/>
            </div>
            <div class="row">
            <div class="col-12 mt-4">
              <button class="btn btn-success" type="submit" name="search_screened">Search</button><br/><br/>
              <button class="btn btn-secondary" type="submit" name="download_csv">Download CSV</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <?php
    // Display eligible students
$query = "
  SELECT s.*
  FROM spgs_acc s
  INNER JOIN admitted_2022 a ON s.username = a.regno
  LEFT JOIN spgs_acc_2021_2022 sa ON s.username = sa.username
  WHERE sa.username IS NULL
";

$result = mysqli_query($conn, $query);

echo "<div class='card mt-4'><div class='card-body'>";
echo "<h5 class='card-title'>Eligible Students for Account Creation</h5>";
if (!empty($message)) {
  echo $message;
}

if (mysqli_num_rows($result) > 0) {
    
  echo "<table class='table table-bordered'>
  <thead>
  <tr>
    <th>S/N</th>
    <th>Username</th>
    <th>Session</th>
    <th>Account Date</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>";

  $i = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
      <td>{$i}</td>
      <td>{$row['username']}</td>
      <td>{$row['session']}</td>
      <td>{$row['accdate']}</td>
      <td>
        <form method='POST' action='createstu.php'>
          <input type='hidden' name='id' value='{$row['id']}'>
          <button type='submit' name='create_account' class='btn btn-primary btn-sm'>Create Account</button>
        </form>
      </td>
    </tr>";
    $i++;
  }

  echo "</tbody></table>";
} else {
  echo "<div class='alert alert-info'>No eligible students found.</div>";
}

echo "</div></div>";

    ?>
  </section></main>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
<script>
$(document).ready(function() {
  $('#faculty').on('change', function() {
    const faculty = $(this).val();
    if (faculty !== "") {
      $.ajax({
        url: 'fetch_dept_spgs.php',
        type: 'POST',
        data: { faculty: faculty },
        success: function(response) {
          $('#dept').html(response);
          $('#programme').html('<option value="">Select Programme</option>');
        },
        error: function(xhr, status, error) {
          console.log("AJAX error: " + error);
        }
      });
    }
  });

  $('#dept').on('change', function() {
    const dept = $(this).val();
    if (dept !== "") {
      $.ajax({
        url: 'fetch_programme_spgs.php',
        type: 'POST',
        data: { dept: dept },
        success: function(response) {
          $('#programme').html(response);
        },
        error: function(xhr, status, error) {
          console.log("AJAX error: " + error);
        }
      });
    }
  });
});
</script>

</html>