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

    
    $result = resultnew( "SELECT * FROM spgs_basicinfo WHERE programme LIKE '%Doctorate%' AND regno NOT IN (SELECT regno from admitted_2022) ORDER BY `faculty`,`dept` ");
    $row = mysqli_num_rows($result);

    $result2 = resultnew( "SELECT * FROM spgs_basicinfo WHERE programme LIKE '%Masters%' AND regno NOT IN (SELECT regno from admitted_2022) ORDER BY `faculty`,`dept` ");
    $row2 = mysqli_num_rows($result2);

    $result3 = resultnew( "SELECT * FROM spgs_basicinfo WHERE programme LIKE '%Postgraduate Diploma%' AND regno NOT IN (SELECT regno from admitted_2022) ORDER BY `faculty`,`dept` ");
    $row3 = mysqli_num_rows($result3);
  //  echo "Total Registered Users:" . $row;
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin / Admission Processing Portal</title>
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
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="admindashboad.php" class="logo d-flex align-items-center">
        <img src="../assets/img/unimed_banner_pgschool.png" alt=""><br>
        <span class="d-none ">DOCTORATE APPLICANTS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $user ?></h6>
              <span><?php echo $role ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="admin_logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
    <?php include_once("sidebar.php"); ?>

  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Admission Processing</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Dashboard </a></li>
          <li class="breadcrumb-item">Process Admission</li>
          <li class="breadcrumb-item active">Admit Student</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          


        </div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admission Portal</h5>

              <!-- Default Tabs -->
              <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Doctorate</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Masters</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false">PGD</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabjustifiedContent">
                <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                  <?php 
              echo "</head>";
    //echo "<body>";
    echo "<meta name='viewport' content='width=device-width,initial-scale=1.0'>";
    echo "<div class='col-md-12 container-fluid  '>";
    echo "<div class='box container-fluid' style='border:1px solid grey; margin-top:40px;  padding:10px; border-radius: 5px; box-shadow: 3px 3px 3px gray; background-color:; float: center;'>";
    echo "<div class='text-primary'><center><h2>Welcome to Doctorate Admission Portal</h2></center>";
    echo "<hr>";
    echo "Available Doctorate Applications:" . $row;

   // echo "<th><a href='phd.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>PhD</button></a></th>";
  
   
    echo "<a href='admin-logout.php'><button class='btn btn-outline-warning' style='float:right; margin-right:40px; padding:4px;'>Logout</button></a>";
    echo "<th><a href='admin-panel.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>Upload Admission List</button></a></th>";

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
      echo "<th><a href='userdata.php?user=$id' target='_blank';><button class='btn btn-primary'>Edit</button></th>";
      echo "<th><a href='update-admin.php?user=$id'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px; '>Admit </button></th>";
      echo "</tr>"; 
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>
                </div>
                <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                    <?php 
              echo "</head>";
    //echo "<body>";
    echo "<meta name='viewport' content='width=device-width,initial-scale=1.0'>";
    echo "<div class='col-md-12 container-fluid  '>";
    echo "<div class='box container-fluid' style='border:1px solid grey; margin-top:40px;  padding:10px; border-radius: 5px; box-shadow: 3px 3px 3px gray; background-color:; float: center;'>";
    echo "<div class='text-primary'><center><h2>Welcome to Masters Admission Portal</h2></center>";
    echo "<hr>";
    echo "Available Masters Applications:" . $row2;

    //echo "<th><a href='phd.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>PhD</button></a></th>";
  
   
    echo "<a href='admin-logout.php'><button class='btn btn-outline-warning' style='float:right; margin-right:40px; padding:4px;'>Logout</button></a>";
    echo "<th><a href='admin-panel.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>Upload Admission List</button></a></th>";

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
    while ($retrieve = mysqli_fetch_array($result2)) {
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
      echo "<th><a href='userdata.php?user=$id' target='_blank';><button class='btn btn-primary'>Edit</button></th>";
      echo "<th><a href='update-admin.php?user=$id'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px; '>Admit </button></th>";
      echo "</tr>"; 
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>
                </div>
                <div class="tab-pane fade" id="contact-justified" role="tabpanel" aria-labelledby="contact-tab">
                    <?php 
              echo "</head>";
    //echo "<body>";
    echo "<meta name='viewport' content='width=device-width,initial-scale=1.0'>";
    echo "<div class='col-md-12 container-fluid  '>";
    echo "<div class='box container-fluid' style='border:1px solid grey; margin-top:40px;  padding:10px; border-radius: 5px; box-shadow: 3px 3px 3px gray; background-color:; float: center;'>";
    echo "<div class='text-primary'><center><h2>Welcome to Diploma Admission Portal</h2></center>";
    echo "<hr>";
    echo "Available Postgraduate Diploma Applications:" . $row3;

    //echo "<th><a href='phd.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>PhD</button></a></th>";
  
   
    echo "<a href='admin-logout.php'><button class='btn btn-outline-warning' style='float:right; margin-right:40px; padding:4px;'>Logout</button></a>";
    echo "<th><a href='admin-panel.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>Upload Admission List</button></a></th>";

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
    echo "<th>User Details</th>";
    echo "<th>Admit User</th>";
    echo "</tr>";
    
    $i = 0;
    while ($retrieve = mysqli_fetch_array($result3)) {
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
      echo "<th><a href='userdata.php?user=$id' target='_blank';><button class='btn btn-primary'>Edit</button></th>";
      echo "<th><a href='update-admin.php?user=$id'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px; '>Admit </button></th>";
      echo "</tr>"; 
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>
                </div>
              </div><!-- End Default Tabs -->

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