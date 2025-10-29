<?php 
session_start();
    include_once("../fun.inc.php");
    $db_handle = new DBController();
$conn = $db_handle->connectDB();

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


$registrationTable = '';
//update session
if (isset($_POST['update_screened'])) {
  $id = $_POST['id'];
  $regno = $_POST['regno'];
  $surname = $_POST['surname'];
  $onames = $_POST['onames'];
  $dept = $_POST['dept'];
  $session = $_POST['session'];
  $semester = $_POST['semester'];

  $update = "UPDATE Screened_Candidates_2022 SET 
    regno='$regno', surname='$surname', onames='$onames',
    dept='$dept', session='$session', semester='$semester'
    WHERE id='$id'";

  if (mysqli_query($conn, $update)) {
    $updateMessage = "<div class='alert alert-success'>✅ Candidate record successfully updated.</div>";
  } else {
    $updateMessage = "<div class='alert alert-danger'>❌ Update failed. Please try again.</div>";
  }
}


//function
function renderCandidateDetailsForm($candidate) {
  return "
  <div class='card mt-4'>
    <div class='card-header'>Candidate Details Form</div>
    <div class='card-body'>
      <form method='POST' action='studentdata.php'>
        <input type='hidden' name='id' value='{$candidate['id']}'>
        <div class='row'>
          <div class='col-md-6 mb-3'>
            <label>Regno</label>
            <input type='text' name='regno' class='form-control' value='{$candidate['regno']}'>
          </div>
          <div class='col-md-6 mb-3'>
            <label>Surname</label>
            <input type='text' name='surname' class='form-control' value='{$candidate['surname']}'>
          </div>
          <div class='col-md-6 mb-3'>
            <label>Other Names</label>
            <input type='text' name='onames' class='form-control' value='{$candidate['onames']}'>
          </div>
          <div class='col-md-6 mb-3'>
            <label>Department</label>
            <input type='text' name='dept' class='form-control' value='{$candidate['dept']}'>
          </div>
          <div class='col-md-6 mb-3'>
            <label>Session</label>
            <input type='text' name='session' class='form-control' value='{$candidate['session']}'>
          </div>
          <div class='col-md-6 mb-3'>
            <label>Semester</label>
            <input type='text' name='semester' class='form-control' value='{$candidate['semester']}'>
          </div>
        </div>
        <button type='submit' name='update_screened' class='btn btn-primary'>Update Record</button>
      </form>
    </div>
  </div>
  ";
}

//function end
$screenedResults = [];

if (isset($_POST['search_screened'])) {
  $regno = $_POST['regno'];
  $faculty = $_POST['faculty'];
  $dept = $_POST['dept'];
  $session = $_POST['session'];

  $query = "SELECT * FROM Screened_Candidates_2022 WHERE 1";
  if (!empty($regno)) $query .= " AND regno='$regno'";
  if (!empty($faculty)) $query .= " AND faculty='$faculty'";
  if (!empty($dept)) $query .= " AND dept='$dept'";
  if (!empty($session)) $query .= " AND session='$session'";

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $screenedResults[] = $row;
    }
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
      <h1>View Student Record</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Dashboard</a></li>
          <li class="breadcrumb-item">Student Details</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row" style="padding-left: 10px;">
       

        <div class="col-lg-6">

  
        </div> <br>

<!--by faculty and dept and Level --->



<!-- --->

<div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 >Search by matric</h5>
              
            </div>
<form method="POST" action="studentdata.php">
  
    <div class="col-md-4" style="padding-left: 10px;">
      <label>Enter Matric No</label>
      <input type="text" name="regno" class="form-control" style="padding-left: 10px;"  placeholder="Search by RegNo">
    </div><br>

  <div class="col-md-4" style="padding-left: 10px;">
     <h5 >Search by Department</h5>
  <select name="faculty" id="faculty" class="form-control">
    <option value="">Select Faculty</option>
    <?php
    $facQuery = mysqli_query($conn, "SELECT DISTINCT faculty FROM Screened_Candidates_2022");
    while ($row = mysqli_fetch_assoc($facQuery)) {
      echo "<option value='{$row['faculty']}'>{$row['faculty']}</option>";
    }
    ?>
  </select>
  </div> <br>
  <div class="col-md-4" style="padding-left: 10px;">
  <select name="dept" id="dept" class="form-control">
    <option value="">Select Department</option>
  </select>
  </div><br>
  <div class="col-md-4" style="padding-left: 10px;">
  <select name="session" id="session" class="form-control">
    <option value="">Select Session</option>
  </select>
  </div><br>
   <div class="col-md-4" style="padding-left: 10px;">
  <button class="btn btn-success" type="submit" name="search_screened">Search</button>
   </div><br>
</form>


    <!-- Level Dropdown -->
    

    <!-- Session Dropdown -->
    <br><br><br>

    <!-- Submit Button -->
  
  </div>
</form>


          </div>
        </div>
         <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
                <?php echo $registrationTable; ?>
              <!-- Default Table -->
             <?php
if (isset($_POST['search_screened'])) {
  $regno = $_POST['regno'];
  $faculty = $_POST['faculty'];
  $dept = $_POST['dept'];
  $session = $_POST['session'];

  $query = "SELECT * FROM Screened_Candidates_2022 WHERE 1";
  if (!empty($regno)) $query .= " AND regno='$regno'";
  if (!empty($faculty)) $query .= " AND faculty='$faculty'";
  if (!empty($dept)) $query .= " AND dept='$dept'";
  if (!empty($session)) $query .= " AND session='$session' order by programme";

  $result = mysqli_query($conn, $query);

  echo "<div class='card mt-4'><div class='card-body'>";
  echo "<h5 class='card-title'>Screened Candidates</h5>";

  if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead><tr>
            <th>S/N</th>
            <th>Regno</th>
            <th>Surname</th>
            <th>Onames</th>
            <th>Dept</th>
            <th>program</th>
            <th>Session</th>
            <th>Semester</th>
            <th>Action</th>
          </tr></thead><tbody>";

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
              <td>{$row['semester']}</td>
              <td>
                <button type='button' class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' 
                  onclick='fillEditModal(".json_encode($row).")'>Edit</button>
              </td>
            </tr>";
      $i++;
    }

    echo "</tbody></table>";
  } else {
    echo "<div class='alert alert-warning'>No records found.</div>";
  }

  echo "</div></div>";
}
if (isset($updateMessage)) echo $updateMessage; 

?>
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="studentdata.php">
        <div class="modal-header">
          <h5 class="modal-title">Edit Candidate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Regno</label>
              <input type="text" name="regno" id="edit-regno" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
              <label>Surname</label>
              <input type="text" name="surname" id="edit-surname" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
              <label>Other Names</label>
              <input type="text" name="onames" id="edit-onames" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
              <label>Department</label>
              <input type="text" name="dept" id="edit-dept" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
              <label>Session</label>
              <select name="session" id="edit-session" class="form-control">
                <option value="">Select Session</option>
                <?php
                $sessions = mysqli_query($conn, "SELECT DISTINCT session FROM Screened_Candidates_2022 ORDER BY session DESC");
                while ($s = mysqli_fetch_assoc($sessions)) {
                  echo "<option value='{$s['session']}'>{$s['session']}</option>";
                }
                ?>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label>Semester</label>
              <select name="semester" id="edit-semester" class="form-control">
                <option value="">Select Semester</option>
                <option value="FIRST">FIRST</option>
                <option value="SECOND">SECOND</option>
                <option value="THIRD">THIRD</option>
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="update_screened" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
 <!-- End Footer -->
<script>
$(document).ready(function() {
 

$('#faculty').change(function() {
  var faculty = $(this).val();
  $.post('load_dept_session.php', {faculty: faculty}, function(data) {
    let parts = data.split('|');
    $('#dept').html(parts[0]);
    $('#session').html(parts[1]);
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

  $('#searchForm').submit(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'search_screened.php',
    method: 'POST',
    data: $(this).serialize(),
    success: function(response) {
      $('#resultsTable tbody').html(response);
    }
  });
});

});

function fillEditModal(data) {
  document.getElementById('edit-id').value = data.id;
  document.getElementById('edit-regno').value = data.regno;
  document.getElementById('edit-surname').value = data.surname;
  document.getElementById('edit-onames').value = data.onames;
  document.getElementById('edit-dept').value = data.dept;
  document.getElementById('edit-session').value = data.session;
  document.getElementById('edit-semester').value = data.semester;
}

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