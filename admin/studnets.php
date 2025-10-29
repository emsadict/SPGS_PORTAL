<?php 
session_start();
include_once("../fun.inc.php");

$db_handle = new DBController();
$conn = $db_handle->connectDB();

// Redirect if not authenticated
if (!isset($_SESSION['spgs_auth'])) {
    header("Location: index.php");
    exit();
}

$spgs_auth = $_SESSION['spgs_auth'];
$user = $spgs_auth[1];
$adminrec = getRecs("admin_table", "username", $user);
$role = $adminrec['role'];

$registrationTable = '';

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $deleteQuery = mysqli_query($conn, "DELETE FROM course_reg WHERE id = $delete_id");
    if ($deleteQuery) {
        echo "<script>alert('Record deleted successfully');</script>";
    }
}

// Handle fetch by matric number
if (isset($_POST['fetch'])) {
    $matricno = mysqli_real_escape_string($conn, $_POST['matricno']);
    $query = mysqli_query($conn, "SELECT * FROM course_reg WHERE matricno = '$matricno'");
    $registrationTable = buildTable($query);
}

// Handle filter by department
if (isset($_POST['filter'])) {
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $session = mysqli_real_escape_string($conn, $_POST['session']);

    $query = mysqli_query($conn, "SELECT * FROM course_reg WHERE faculty='$faculty' AND dept='$dept' AND level='$level' AND session='$session'");
    $registrationTable = buildTable($query);
}

// Helper function to build HTML table
function buildTable($result) {
    if (mysqli_num_rows($result) == 0) {
        return "<p>No records found.</p>";
    }

    $table = '<table class="table table-bordered">';
    $table .= '<thead><tr>
        <th>S/N</th><th>Matric No</th><th>Faculty</th><th>Dept</th><th>Level</th><th>Semester</th><th>Session</th><th>Courses</th><th>Actions</th>
    </tr></thead><tbody>';

    $sn = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $courses = '';
        for ($i = 1; $i <= 20; $i++) {
            $courseKey = "course$i";
            if (!empty($row[$courseKey])) {
                $courses .= $row[$courseKey] . "<br>";
            }
        }

        $table .= "<tr>
            <td>{$sn}</td>
            <td>{$row['matricno']}</td>
            <td>{$row['faculty']}</td>
            <td>{$row['dept']}</td>
            <td>{$row['level']}</td>
            <td>{$row['semester']}</td>
            <td>{$row['session']}</td>
            <td>{$courses}</td>
            <td>
                <a href='?delete_id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this record?');\" class='btn btn-danger btn-sm'>Delete</a>
                <a href='edit_course.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
            </td>
        </tr>";
        $sn++;
    }

    $table .= '</tbody></table>';
    return $table;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>course registration</title>
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
      <h1>Search Student couse reg</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Dashboard</a></li>
          <li class="breadcrumb-item">Student Registration</li>
          <li class="breadcrumb-item active">Course Registration</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row" style="padding-left: 10px;">
       

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body" style="padding-left: 10px;">
              <h5 >search by Matricno/Reg Number</h5>

              
            </div>
            <form method="POST" action="">
  <div class="row mb-3">
    <div class="col-md-6" style="padding-left: 10px;">
      <label>Enter Matric No</label>
      <input type="text" name="matricno" class="form-control" required>
    </div>
    <div class="col-md-6 d-flex align-items-end">
      <button type="submit" name="fetch" class="btn btn-primary">Fetch</button>
    </div>
  </div>
</form>

          </div>
        </div> <br>

<!--by faculty and dept and Level --->



<!-- --->

<div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 >Search by Department</h5>

              
            </div>
<form method="POST" action="">
  <div class="row" style="padding-left: 10px;">
    <!-- Faculty Dropdown -->
    <div class="col-md-3">
      <label>Faculty</label>
      <select name="faculty" id="faculty" class="form-control" required>
        <option value="">Select Faculty</option>
        <?php
          $facQuery = mysqli_query($conn, "SELECT DISTINCT faculty FROM screened_candidates_2022 WHERE faculty != ''");
          while ($fac = mysqli_fetch_assoc($facQuery)) {
            echo "<option value='{$fac['faculty']}'>{$fac['faculty']}</option>";
          }
        ?>
      </select>
    </div><br>

    <!-- Department Dropdown -->
    <div class="col-md-3">
      <label>Department</label>
      <select name="dept" id="dept" class="form-control" required>
        <option value="">Select Department</option>
      </select>
    </div><br>

    <!-- Level Dropdown -->
    <div class="col-md-2">
      <label>Level</label>
      <select name="level" id="level" class="form-control" required>
        <option value="">Select Level</option>
      </select>
    </div><br>

    <!-- Session Dropdown -->
    <div class="col-md-2">
      <label>Session</label>
      <select name="session" id="session" class="form-control" required>
        <option value="">Select Session</option>
      </select>
    </div><br><br><br>

    <!-- Submit Button -->
    <div class="col-md-2 ">
      <button type="submit" name="filter" class="btn btn-primary">Search</button><br><br><br>
    </div>
  </div>
</form>


          </div>
        </div>
         <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Default Table</h5>
                <?php echo $registrationTable; ?>
              <!-- Default Table -->


              <!-- End Default Table Example -->
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php 
    include_once("footer.php");



   ?>
 <!-- End Footer -->

<script>
$(document).ready(function() {
  $('#faculty').change(function() {
    var faculty = $(this).val();
    $.post('load_dept.php', {faculty: faculty}, function(data) {
      $('#dept').html(data);
    });
  });

  $('#dept').change(function() {
    var dept = $(this).val();
    $.post('load_level.php', {dept: dept}, function(data) {
      $('#level').html(data);
    });
  });

  $('#level').change(function() {
    var level = $(this).val();
    $.post('load_session.php', {level: level}, function(data) {
      $('#session').html(data);
    });
  });
});
</script>
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

</html>