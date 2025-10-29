<?php
include_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM course_reg WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $matricno = $_POST['matricno'];
    $faculty = $_POST['faculty'];
    $dept = $_POST['dept'];
    $level = $_POST['level'];
    $semester = $_POST['semester'];
    $session = $_POST['session'];

    $updateQuery = "UPDATE course_reg SET 
        matricno='$matricno', faculty='$faculty', dept='$dept', level='$level', semester='$semester', session='$session'
        WHERE id=$id";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Record updated successfully'); window.location='tables-data.php';</script>";
    } else {
        echo "Update failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>COURSE Deregistration</title>
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
      <h1>SEARCH AND De-Register a course</h1>
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

          </div>
        </div> <br>

<!--by faculty and dept and Level --->



<!-- --->

<div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 >Search by Department</h5>

              
            </div>

<form method="POST">
     <div class="row" style="padding-left: 60px 60px; width:400px; margin-left:5px;">
        <div class="col-md-3">
    <label>Matric No</label>
    <input type="text" name="matricno" value="<?= $data['matricno'] ?>" required><br>

    <label>Faculty</label>
    <input type="text" name="faculty" value="<?= $data['faculty'] ?>" required><br>

    <label>Department</label>
    <input type="text" name="dept" value="<?= $data['dept'] ?>" required><br>

    <label>Level</label>
    <input type="text" name="level" value="<?= $data['level'] ?>" required><br>

    <label>Semester</label>
    <input type="text" name="semester" value="<?= $data['semester'] ?>" required><br>

    <label>Session</label>
    <input type="text" name="session" value="<?= $data['session'] ?>" required><br>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
     </div>
     </div>
</form>



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