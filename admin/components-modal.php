<?php 
session_start();
    include_once("../fun.inc.php");
    if(!isset($_SESSION['spgs_auth']))
    {

    header("location: index.php");
    }
   else{

    $spgs_auth=$_SESSION['spgs_auth'];

    $user=$spgs_auth[1];
   // echo $user;
    $adminrec=getRecs("admin_table","username",$user);
   $role = $adminrec['role'];
 //  echo $role;
  //  $sessionRec=$admrecS['session'];
    //$programme=$admrecS['programme'];

    
    $result = resultnew( "SELECT * FROM spgs_basicinfo WHERE faculty LIKE '%Allied Health Sciences%' AND regno NOT IN (SELECT regno from admitted_2022) ORDER BY `dept`,`programme` ");
    $row = mysqli_num_rows($result);
    echo "Total Registered Users:" . $row;
  }


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Allied Health Sciences Applicants </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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
      <h1>Allied Health Sciences Applicants</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">Applications</li>
          <li class="breadcrumb-item active">Allied Health Sciences</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Allied Health Sciences Applications</h5>
<?php 
              echo "</head>";
    //echo "<body>";
    echo "<meta name='viewport' content='width=device-width,initial-scale=1.0'>";
    echo "<div class='col-md-12 container-fluid  '>";
    echo "<div class='box container-fluid' style='border:1px solid grey; margin-top:40px;  padding:10px; border-radius: 5px; box-shadow: 3px 3px 3px gray; background-color:; float: center;'>";
    echo "<div class='text-primary'><center><h2>Welcome to Admin Panel</h2></center>";
    echo "<hr>";
    echo "Available Doctorate Applications:" . $row;

    echo "<th><a href='usersdata.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>View Users</button></a></th>";
    echo "<th><a href='masters.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>Masters</button></th>";

    echo "<th><a href='phd.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>PhD</button></a></th>";
    /*
    echo "<th><a href='pgd.php'  ><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>PGD_OLD</button></th>";
    */
    echo "<th><a href='2022pgd.php'  ><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>PGD_NEW</button></a></th>";
    echo "<a href='admin-logout.php'><button class='btn btn-outline-warning' style='float:right; margin-right:40px; padding:4px;'>Logout</button></a>";
    echo "<th><a href='admin-panel.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>All Applicants</button></a></th>";

    echo "<hr>";
    echo "<div class='text-primary'><center><h3>ALL APPLICANTS </h3></center>";
    echo "</br>";
  echo "<table class='table table-striped table-bordered table-responsive'>";
    echo "<tr>";
    echo "<th>S.no</th>";
    echo "<th>REG NO.</th>";
    echo "<th>First Name</th>";
    //echo "<th>Last Name</th>";
    //echo "<th style='width:50px;'>Faculty</th>";
    echo "<th>Dept</th>";
    echo "<th>Prog</th>";
    echo "<th>Profile Image</th>";
   // echo "<th>Olevel1</th>";
  //  echo "<th>Olevel2</th>";
  echo "<th>Delete Users</th>";
    echo "<th>Edit User Details</th>";
    echo "<th>User Details</th>";
    echo "</tr>";
    
    $i = 0;
    while ($retrieve = mysqli_fetch_array($result)) {
      $id = $retrieve['regno'];
      $fname = $retrieve['surname'];
      $lname = $retrieve['onames'];
      $dept = $retrieve['dept'];
      $prog = $retrieve['programme'];
      $Faculty = $retrieve['faculty'];
      $pro = $retrieve['passport'];
     // $ol1 = $retrieve['olevel1'];
     // $ol2 = $retrieve['olevel2'];
      echo "<tr align='left';>";

      echo "<th>" . $i = $i + 1;
      "</th>";
      echo "<th>$id</th>";
      echo "<th>$fname</th>";
      //echo "<th>$lname</th>";
    //  echo "<th style='width:70px;'>$Faculty</th>";
      echo "<th style='width:70px;'>$dept</th>";
      echo "<th style='width:70px;'>$prog</th>";
      echo "<th><img src='../pass/$pro' height='100px' width='100px'></th>";
   //   echo "<th><img src='images/result/$ol1' height='100px' width='100px'></th>";
    //  echo "<th><img src='images/result/$ol2' height='100px' width='100px'></th>";
      echo "<th><a href='delete-admin.php?del=$id'><button class='btn btn-danger'>Delete</button></th>";
      echo "<th><a href='update-admin.php?user=$id'><button class='btn btn-primary'>Edit</button></th>";
      echo "<th><a href='userdata.php?user=$id' target='_blank';><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px; '>Details</button></th>";
      echo "</tr>";
    }
    echo "</table>";

    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>
            </div>
          </div>


          <div class="card">
            <div class="card-body">
              <h5 class="card-title">With Icon</h5>

    
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Outlined</h5>

              


              

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