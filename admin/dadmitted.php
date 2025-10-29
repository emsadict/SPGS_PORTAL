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

// CSV download
if (isset($_POST['download_csv'])) {
  $regno = $_POST['regno'];
  $faculty = $_POST['faculty'];
  $dept = $_POST['dept'];
 // $email = $_POST['email'];
  $programme = $_POST['programme'];


  $query = "SELECT * FROM admitted_2022 WHERE 1";
  if (!empty($regno)) $query .= " AND regno='$regno'";
  if (!empty($faculty)) $query .= " AND faculty='$faculty'";
  if (!empty($dept)) $query .= " AND dept='$dept'";
  if (!empty($session)) $query .= " AND session='$session'";
  if (!empty($programme)) $query .= " AND programme='$programme'";

  $result = mysqli_query($conn, $query);

  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="student_programmes.csv"');

  $output = fopen('php://output', 'w');
  fputcsv($output, ['Regno', 'Surname', 'Other Names', 'Department', 'Programme', 'email','phoneno']);

  while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
      $row['regno'],
      $row['surname'],
      $row['onames'],
      $row['dept'],
      $row['programme'],
      $row['email'],
      $row['phoneno']
    
    ]);
  }

  fclose($output);
  exit;
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
      <h1>View Addmitted student Record</h1>
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
        <form method="POST" action="dadmitted.php" id="searchForm">
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
                $facQuery = mysqli_query($conn, "SELECT DISTINCT faculty FROM admitted_2022");
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
    if (isset($_POST['search_screened'])) {
      $regno = $_POST['regno'];
      $faculty = $_POST['faculty'];
      $dept = $_POST['dept'];
     // $session = $_POST['session'];
      $programme = $_POST['programme'];

      $query = "SELECT * FROM admitted_2022 WHERE 1";
      if (!empty($regno)) $query .= " AND regno='$regno'";
      if (!empty($faculty)) $query .= " AND faculty='$faculty'";
      if (!empty($dept)) $query .= " AND dept='$dept'";
      if (!empty($session)) $query .= " AND session='$session'";
      if (!empty($programme)) $query .= " AND programme='$programme'";

      $result = mysqli_query($conn, $query);

      echo "<div class='card mt-4'><div class='card-body'>";
      echo "<h5 class='card-title'>Student Records</h5>";

      if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered'>
        <thead>
        <tr>
          <th>S/N</th>
          <th>Regno</th>
          <th>Surname</th>
          <th>Onames</th>
          <th>Dept</th>
          <th>Programme</th>
         <th>Session</th>
        </tr>
        </thead>
        <tbody>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
            <td>{$i}</td>
            <td>{$row['regno']}</td>
            <td>{$row['surname']}</td>
            <td>{$row['onames']}</td>
            <td>{$row['dept']}</td>
            <td>{$row['programme']}</td>
             <td>{$row['session']}</td>
          </tr>";
          $i++;
        }

        echo "</tbody></table>";
      } else {
        echo "<div class='alert alert-warning'>No records found.</div>";
      }

      echo "</div></div>";
    }
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
        url: 'fetch_dept_admitted.php',
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
        url: 'fetch_programme_admitted.php',
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