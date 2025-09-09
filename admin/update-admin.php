<?php
$first_no=$first_date=$first_type=$first_sub1=$first_sub2=$first_sub3=$first_sub4=$first_sub5=$first_sub6=$first_sub7=$first_sub8=$first_sub9=$sec_no=$sec_date=$sec_type=$second_sub1=$second_sub2=$second_sub3=$second_sub4=$second_sub5=$second_sub6=$second_sub7=$second_sub8=$second_sub9=$olevel1=$olevel2=$dedeg2=$dedeg3=$dedeg4=$dedeg5=$dedeg7=$cert1=$cert2=$nysc1=$nysc2=$nysc3='';
 session_start();
    include_once("../fun.inc.php");
if(!isset($_SESSION['spgs_auth']))
    {

    header("location: index.php");
    }
    $spgs_auth=$_SESSION['spgs_auth'];
    $user=$spgs_auth[1];
    $adminrec=getRecs("admin_table","username",$user);
   $role = $adminrec['role'];
$msg=$msg1=$msg2=$msg3=$msg4=$msg5=$msg6=$msg11=$msg7=$msg11=$msg8=$msg9=$msg10=$firstname=$lastname=$email=$mail=$date=$password=$c_password=$image=$name='';
 $id=$_GET['user'];

if (isset($id)) {
  $result=resultnew("SELECT * FROM `spgs_basicinfo` WHERE regno='$id' "); 
          
          $retrieve=mysqli_fetch_array($result);
          $id=$retrieve['regno'];
          $name=$retrieve['surname'];
          $last=$retrieve['onames'];
          $sex=$retrieve['sex'];
          $dob=$retrieve['dob'];
          $maritalstatus=$retrieve['maritalstatus'];
          $nationality=$retrieve['nationality'];
          $state=$retrieve['state'];
          $lg=$retrieve['lg'];
          $mail=$retrieve['email'];
          $phoneno=$retrieve['phoneno'];
          $address=$retrieve['address'];
          $image=$retrieve['passport'];
          $faculty=$retrieve['faculty'];
          $dept=$retrieve['dept'];
          $programme=$retrieve['programme'];
          $title=$retrieve['title'];
          $noksurname=$retrieve['noksurname'];
          $nokoname=$retrieve['nokoname'];
          $noktel=$retrieve['noktel'];
          $nokemail=$retrieve['nokemail'];
        }
     
         $result2=resultnew("SELECT * FROM `spgs_acad_rec` WHERE regno='$id' ");
         while ($retrieve2=mysqli_fetch_array($result2)) 
         {
          $first_no=$retrieve2['first_no'];
          $first_date=$retrieve2['first_date'];
          $first_type=$retrieve2['first_type'];
          $first_sub1=$retrieve2['first_sub1'];
          $first_sub2=$retrieve2['first_sub2'];
          $first_sub3=$retrieve2['first_sub3'];
          $first_sub4=$retrieve2['first_sub4'];
          $first_sub5=$retrieve2['first_sub5'];
          $first_sub6=$retrieve2['first_sub6'];
          $first_sub7=$retrieve2['first_sub7'];
          $first_sub8=$retrieve2['first_sub8'];
          $first_sub9=$retrieve2['first_sub9'];
          $sec_no=$retrieve2['sec_no'];
          $sec_date=$retrieve2['sec_date'];
          $sec_type=$retrieve2['sec_type'];
          $second_sub1=$retrieve2['second_sub1'];
          $second_sub2=$retrieve2['second_sub2'];
          $second_sub3=$retrieve2['second_sub3'];
          $second_sub4=$retrieve2['second_sub4'];
          $second_sub5=$retrieve2['second_sub5'];
          $second_sub6=$retrieve2['second_sub6'];
          $second_sub7=$retrieve2['second_sub7'];
          $second_sub8=$retrieve2['second_sub8'];
          $second_sub9=$retrieve2['second_sub9'];
          $olevel1=$retrieve2['olevel1'];
          $olevel2=$retrieve2['olevel2'];
          $dedeg2=$retrieve2['dedeg2'];
          $dedeg3=$retrieve2['dedeg3'];
          $dedeg4=$retrieve2['dedeg4'];
          $dedeg5=$retrieve2['dedeg5'];
          $dedeg7=$retrieve2['dedeg7'];
          $cert1=$retrieve2['cert1'];
          $cert2=$retrieve2['cert2'];
          $nysc1=$retrieve2['nysc1'];
          $nysc2=$retrieve2['nysc2'];
          $nysc3=$retrieve2['nysc3']; 

        
}
    //move records to admission table
    
if (isset($_POST['submit_admission'])) {
    $regno = $_POST['regno'];
    $surname = $_POST['surname'];
    $onames = $_POST['onames'];
    $sex = $_POST['sex'];
    $dob = $_POST['dob'];
    $faculty = $_POST['faculty'];
    $dept = $_POST['dept'];
    $programme = $_POST['programme'];
    $title = $_POST['title'];
    // Add other fields as needed

    $session = date('Y'); // or fetch from another source
    $batch = 'Batch A';   // example value
    $date_issued = date('Y-m-d');

    $sql = "INSERT INTO admitted_2022 
        (regno, surname, onames, sex, dob, faculty, dept, programme, title, session, batch, date_issued) 
        VALUES 
        ('$regno', '$surname', '$onames', '$sex', '$dob', '$faculty', '$dept', '$programme', '$title', '$session', '$batch', '$date_issued')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Student admitted successfully'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Admission failed');</script>";
    }
      
  }
?>
<title>Profile Page</title>
<style type="text/css">
  #body-bg
  {
    background-color: #efefef;
     
  
  }
table {
  font-family: arial, sans-serif;
 /* border-collapse: collapse; */
  width: 80%;
  margin-right:auto;
  margin-left: auto;
  
 

}
.container {
  background-repeat: no-repeat;
  background-position: center;
  background-image: url(bglogo.jpg);
  background-position-y: 180px;
}
td, th {
  border: 1px solid #dddddd;
  text-align: right;
  width: 100px;
  padding: 7px;
  align-content: center;
  
  
 
}
td{
   margin-right:auto;
  margin-left: auto;

}
.center{
  margin-left: auto;
  margin-right: auto;
}
/*
tr:nth-child(even) {
  background-color: #dddddd;
  width: 100%;
}
*/
img{
  margin-left: 140px;
  position: center;
}
</style>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
  $('#faculty').change(function() {
    var school = $(this).val();
    $.ajax({
      url: 'fetch_dept.php',
      method: 'POST',
      data: { school: school },
      success: function(data) {
        $('#dept').html(data);
      },
      error: function() {
        alert('Failed to fetch departments. Please try again.');
      }
    });
  });
});
</script>

</head>
<body id='body-bg'>
<?php include_once("header.php")?>
<?php include_once("sidebar.php")?>
<div class='container text-primary' style='background-color:white; margin-top:80px; margin-bottom: 20px;width: 1000px;height: 50px;margin-left: 400px;'>

  <center><button class="btn btn-outline-info" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_olevel1');">PRINT O'LEVEL 1</button></center>
  <center><button class="btn btn-outline-warning" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_olevel2');">PRINT O'LEVEL 2 </button></center>

  <center><button class="btn btn-outline-success" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_deg1');">PRINT FIRST CERT</button></center>

  <center><button class="btn btn-outline-primary" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_deg2');">PRINT SECOND CERT</button></center>
  <center><button class="btn btn-outline-secondary" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_nysc');">PRINT NYSC</button></center>
  <center><button class="btn btn-outline-success" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_datapage');">PRINT DATAPAGE</button></center>
<!--
  <a><button onclick="window.print()" class='btn btn-outline-success' style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'>Print Page</button></a> -->
</div>

<div id="printable_div_nysc" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1000px;height: 120px;margin-left: 400px;'>
<center><h3 style="align-items-center">ADMIT THE STUDENT:</h3></center> <br>

<form method="POST" action="">
  <input type="hidden" name="admit_trigger" value="1">
<center>  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#admitModal">
  ADMIT
</button></center>

</form>

</div>
  <div id="printable_div_datapage" class='container text-primary' style='background-color:white; margin-top:20px; margin-bottom: 20px;width: 1000px;height: 1800px; margin-left: 400px;'>

<a href='components-alerts.php'><button class='btn btn-outline-warning' style='float: right;margin-top:20px; padding-right: 10px; margin-left: 5px;'>Back</button></a>
    <a href="logout.php"><button class='btn btn-outline-danger' style='float: right;margin-top:20px;margin-left: 10px;'>Logout</button></a>
 <center><h2 style="margin-left: 140px;"><?php  echo ucfirst($name. " ". $last); ?></h2></center> 
<center><img src="../pass/<?php  echo $image; ?>" class="img-fluid img-thumbnail" width="100" height="80"></center>
<center>
<h5><?php echo "$faculty"; ?></h5>
<h5><?php echo "$dept"; ?></h5>
<h5><?php echo "$programme"; ?></h5>
<h5><?php echo "$title"; ?></h5>
</center>



  <table class="table-bordered center" style="border:1px solid black; margin-top:1px; width: 800px;">
         <tr>
            <th style="text-align:center;" colspan="2">Personal Details</th>
      
         </tr>
         <tr>
          <td>Reg No:   <b></b></td>
            <td style="text-align: left;"><b><?php echo "$id"; ?></b></td>
  
         </tr>
         <tr>
          <td>Names: <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$name "."$last"; ?></b></td>
  
         </tr>
         <tr>
          <td>Sex: <b></b></td>
            <td style="text-align: left;"><b><?php echo "$sex"; ?></b></td>
                
         </tr>
         <tr>
          <td>Marital: <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$maritalstatus"; ?></b></td>
     
         </tr>

          <tr>
            <td>Nationality:  <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$nationality"; ?></b></td>
        
         </tr>

          <tr>
            <td>State:  <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$state"; ?></b></td>
        
         </tr>
          <tr>
            <td>Local Govt.</b></td>
            <td style="text-align: left;"> <b> <?php echo "$lg"; ?></b></td>
    
         </tr>
          <tr>
            <td>Email:   <b></b></td>
            <td style="text-align: left;"><b><?php echo "$mail"; ?></b></td>
     
            
         </tr>
          <tr>
            <td>Phone: <b></b></td>
            <td style="text-align: left;"> <b> 0<?php echo "$phoneno"; ?></b></td>
   
         </tr>
          <tr>
            <td>Address:  <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$address"; ?></b></td>
    
         </tr>
          <tr>
            <td>Faculty:   <b></b></td>
            <td style="text-align: left;"> <b> <?php echo "$faculty"; ?></b> </td>
  
         </tr>
          <tr>
            <td>Dept: <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$dept"; ?></b></td>
   
         </tr>
          <tr>
            <td>Programme:  <b></b></td>
            <td style="text-align: left;"> <b><?php echo "$programme"; ?></b></td>
            
         </tr>
          <tr>
            <td>Title: <b></b></td>
            <td style="text-align: left;"><b><?php echo "$title"; ?></b></td>
         </tr>
         
</table>

</br>

<table class="table-bordered center" style="border:1px solid black; margin-top:1px; width: 400px;">
  <th style="text-align:center;" colspan="2"> First Sitting Olevel Record</th>
   <th style="text-align:center;" colspan="2"> Second Sitting Olevel Record</th>         
            <tr>
              <td> Exam No:</td>
              <td style="text-align: left;"> <?php echo "$first_no"; ?></td>
                <td style="text-align: left;"> <?php echo "$sec_no"; ?></td>
            </tr>

            <tr>
              <td> Date:</td>
              <td style="text-align: left;"> <?php echo "$first_date"; ?></td>
              <td style="text-align: left;"> <?php echo "$sec_date"; ?></td>
            </tr>

            <tr>
              <td> Type</td>
              <td style="text-align: left;"> <?php echo "$first_type"; ?></td>
              <td style="text-align: left;"> <?php echo "$sec_type"; ?></td>
            </tr>

            <tr>
              <td> Subject:1</td>
              <td style="text-align: left;"> <?php echo "$first_sub1"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub1"; ?></td>
            </tr>

            <tr>
              <td> Subject:2</td>
              <td style="text-align: left;"> <?php echo "$first_sub2"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub2"; ?></td>
            </tr>

            <tr>
              <td> Subject:3</td>
              <td style="text-align: left;"> <?php echo "$first_sub3"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub3"; ?></td>
            </tr>

            <tr>
              <td> Subject:4</td>
              <td style="text-align: left;"> <?php echo "$first_sub4"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub4"; ?></td>
            </tr>

             <tr>
              <td> Subject:5</td>
              <td style="text-align: left;"> <?php echo "$first_sub5"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub5"; ?></td>
            </tr>

             <tr>
              <td> Subject:6</td>
              <td style="text-align: left;"> <?php echo "$first_sub6"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub6"; ?></td>
            </tr>

             <tr>
              <td> Subject:7</td>
              <td style="text-align: left;"> <?php echo "$first_sub7"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub7"; ?></td>
            </tr>

             <tr>
              <td> Subject:8</td>
              <td style="text-align: left;"> <?php echo "$first_sub8"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub8"; ?></td>
            </tr>

             <tr>
              <td> Subject:9</td>
              <td style="text-align: left;"> <?php echo "$first_sub9"; ?></td>
              <td style="text-align: left;"> <?php echo "$second_sub9"; ?></td>
            </tr>
          
</table>
<table class="table-bordered center" style="border:1px solid black; margin-top:1px; width: 400px;">
  <th style="text-align:center;" colspan="2">Qualification</th>
            
            <tr>
              <td> Class of Deg</td>
              <td style="text-align: left;"> <?php echo "$dedeg4"; ?></td>:
            </tr>

            <tr>
              <td> Course</td>
              <td style="text-align: left;"> <?php echo "$dedeg7"; ?></td>:
            </tr>

            <tr>
              <td> Institution</td>
              <td style="text-align: left;"> <?php echo "$dedeg5"; ?></td>:
            </tr>

            <tr>
              <td> Qual.</td>
              <td style="text-align: left;"> <?php echo "$dedeg2"; ?></td>:
            </tr>
          
</table>

<table class="table-bordered center" style="border:1px solid black; margin-top:1px; width: 400px;">
  <th style="text-align:center;" colspan="2">NYSC</th>
            
            <tr>
              <td> NYSC Year</td>
              <td style="text-align: left;"> <?php echo "$nysc1"; ?></td>:
            </tr>

            <tr>
              <td> CERT.  NO</td>
              <td style="text-align: left;"> <?php echo "$nysc2"; ?></td>:
            </tr>    
</table>
<br><br>
<center><button class="btn btn-success"  onClick="printdiv('printable_div_datapage');">PRINT</button></center>

<script>
function printdiv(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.printPreview();
  document.body.innerHTML = old_str;
  return false;
}
</script>

</div>
<div id="printable_div_deg1" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1000px;height: 1200px;margin-left: 400px;'>
  <h4 >Degree Cert: 1</h4>
<img src="../result/<?php  echo $cert1; ?>"  width="75%" height="75%"><br><br>

<center><button class="btn btn-success"  onClick="printdiv('printable_div_deg1');">PRINT</button></center>

<script>
function printdiv(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.print();
  document.body.innerHTML = old_str;
  return false;
}
</script>

</div>
<br>
<div id="printable_div_deg2" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1000px;height: 1200px;margin-left: 400px;'>
<h3>Degree Cert: 2</h3>
<img src="../result/<?php  echo $cert2; ?>" alt="Not Available" class="img-fluid img-thumbnail" width="70%" height="75%" padding-top="5px">
<center><button class="btn btn-success"  onClick="printdiv('printable_div_deg2');">PRINT</button></center>

<script>
function printdiv(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.print();
  document.body.innerHTML = old_str;
  return false;
}
</script>

</div>

<div id="printable_div_olevel1" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1000px;height: 1200px; margin-left: 400px;'>
  <h3>Olevel Result -1:</h3>
<img src="../result/<?php  echo $olevel1; ?>" class="img-fluid " width="70%" height="75%"><br><br>
<center><button class="btn btn-success"  onClick="printdiv('printable_div_olevel1');">PRINT</button></center>

<script>
function printdiv(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.print();
  document.body.innerHTML = old_str;
  return false;
}
</script>

<br>
</div>
<div id="printable_div_olevel2" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1000px;height: 1000px; margin-left: 400px;'>
  <h3>Olevel Result 2:</h3>
<img src="../result/<?php  echo $olevel2; ?>" class="img-fluid " width="70%" height="75%"><br><br>

<center><button class="btn btn-success"  onClick="printdiv('printable_div_olevel2');">PRINT</button></center>

<script>
function printdiv(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.print();
  document.body.innerHTML = old_str;
  return false;
}
</script>

<br>

</div>
<br>

<div id="printable_div_nysc" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1000px;height: 1400px;margin-left: 400px;'>
<h3>NYSC CERT:</h3> <br>
<!--
<img src="images/result/<?php  echo $nysc1; ?>" alt="Not Available" class="img-fluid " width="100" height="80" padding-top="5px"><br>


<img src="images/result/<?php  echo $nysc2; ?>" alt="Not Available" class="img-fluid " width="100" height="80" padding-top="5px"><br>
-->
<img src="../result/<?php  echo $nysc3; ?>" alt="Not Available" class="img-fluid " width="80%" height="80%"  padding-top="5px"><br><br>
<center><button class="btn btn-success"  onClick="printdiv('printable_div_nysc');">PRINT</button></center>

<script>
function printdiv(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.print();
  document.body.innerHTML = old_str;
  return false;
}
</script>
</div>
<br>


<?php
if (isset($_POST['admit_trigger'])) {
?>
<form method="POST" action="admit_student.php">
  <table class="table-bordered" style="width:80px; margin-top:20px;">
    <tr><th colspan="2">Admit Student Form</th></tr>
    <tr><td>Reg No:</td><td><input type="text" name="regno" value="<?php echo $id; ?>" readonly></td></tr>
    <tr><td>Surname:</td><td><input type="text" name="surname" value="<?php echo $name; ?>" readonly></td></tr>
    <tr><td>Other Names:</td><td><input type="text" name="onames" value="<?php echo $last; ?>" readonly></td></tr>
    <tr><td>Sex:</td><td><input type="text" name="sex" value="<?php echo $sex; ?>" readonly></td></tr>
    <tr><td>DOB:</td><td><input type="text" name="dob" value="<?php echo $dob; ?>" readonly></td></tr>
    <tr><td>Faculty:</td><td><input type="text" name="faculty" value="<?php echo $faculty; ?>"></td></tr>
    <tr><td>Dept:</td><td><input type="text" name="dept" value="<?php echo $dept; ?>"></td></tr>
    <tr><td>Programme:</td><td><input type="text" name="programme" value="<?php echo $programme; ?>"></td></tr>
    <tr><td>Title:</td><td><input type="text" name="title" value="<?php echo $title; ?>"></td></tr>
    <!-- Add other fields as needed -->
    <tr><td colspan="2" style="text-align:center;"><button type="submit" name="submit_admission" class="btn btn-primary">Submit Admission</button></td></tr>
  </table>
</form>
<?php } ?>

</div>
<!-- Modal -->
<div class="modal fade" id="admitModal" tabindex="-1" aria-labelledby="admitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form method="POST" action="admit_student.php">
        <div class="modal-header">
          <h5 class="modal-title">Admit Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <!-- Static Fields from basicinfo -->
            <input type="hidden" name="regno" value="<?php echo $id; ?>">
            <?php
              $fields = [
                'surname' => $name, 'onames' => $last, 'sex' => $sex, 'dob' => $dob,
                'maritalstatus' => $maritalstatus, 'nationality' => $nationality,
                'state' => $state, 'lg' => $lg, 'email' => $mail, 'phoneno' => $phoneno,
                'address' => $address, 'passport' => $image, 'noksurname' => $noksurname,
                'nokoname' => $nokoname, 'noktel' => $noktel, 'nokemail' => $nokemail
              ];
              foreach ($fields as $key => $value) {
                echo "<div class='col-md-6'><label>".ucfirst($key)."</label><input type='text' name='$key' class='form-control' value='$value' readonly></div>";
              }
            ?>

            <!-- Dynamic Faculty Dropdown -->
            <div class="col-md-6">
              <label>Faculty (School)</label>
              <select name="faculty" id="faculty" class="form-control" required>
                <option value="">Select Faculty</option>
                <?php
                  $faculties = resultnew("SELECT DISTINCT school FROM course");
                  while ($row = mysqli_fetch_array($faculties)) {
                    echo "<option value='{$row['school']}'>{$row['school']}</option>";
                  }
                ?>
              </select>
            </div>

            <!-- Dynamic Department Dropdown -->
            <div class="col-md-6">
              <label>Department</label>
              <select name="dept" id="dept" class="form-control" required>
                <option value="">Select Department</option>
              </select>
            </div>

            <!-- Programme -->
            <div class="col-md-6">
              <label>Programme</label>
              <select name="programme" class="form-control" required>
                <option>Postgraduate Diploma</option>
                <option>Masters</option>
                <option>Doctorate</option>
                <option>MPhil/PhD</option>
              </select>
            </div>

            <!-- Title -->
            <div class="col-md-6">
              <label>Title</label>
              <select name="title" class="form-control" required>
                <option>PGD</option>
                <option>MSc</option>
                <option>MPH</option>
                <option>PhD</option>
                <option>MPhil</option>
                <option>MPhil/PhD</option>
                <option>DrPH</option>
              </select>
            </div>

            <!-- Batch -->
            <div class="col-md-6">
              <label>Batch</label>
              <select name="batch" class="form-control" required>
                <option>FIRST</option>
                <option>SECOND</option>
                <option>THIRD</option>
                <option>FOURTH</option>
                <option>SUPPL</option>
              </select>
            </div>

            <!-- Dates -->
            <div class="col-md-6"><label>Acceptance Fee Due</label><input type="date" name="accpt_fee_due" class="form-control" required></div>
            <div class="col-md-6"><label>Student Due Date</label><input type="date" name="stud_due_date" class="form-control" required></div>
            <div class="col-md-6"><label>Date Issued</label><input type="date" name="date_issued" class="form-control" required></div>
            <div class="col-md-6"><label>All Payment Due</label><input type="date" name="all_pay_due" class="form-control" required></div>

            <!-- Programme Duration -->
            <div class="col-md-6">
              <label>Programme Duration</label>
              <select name="prog_duration" class="form-control" required>
                <option>Three Academic Session</option>
                <option>Three Academic Semesters</option>
                <option>One Academic Semester</option>
              </select>
            </div>

            <!-- NOK Relationship & Address -->
            <div class="col-md-6"><label>NOK Relationship</label><input type="text" name="nokrel" class="form-control"></div>
            <div class="col-md-6"><label>NOK Address</label><input type="text" name="nokadd" class="form-control"></div>

            <!-- Admission Letter Upload -->
            <div class="col-md-6">
  <label>Session</label>
  <select name="session" class="form-control" required>
    <option value="">Select Session</option>
    <option value="2025/2026">2025/2026</option>
   <!--  <option value="2024/2025">2024/2025</option>
    <option value="2023/2024">2023/2024</option>
    <option value="2022/2023">2022/2023</option> -->
  </select>
</div>

            <!-- Reference Date -->
            <div class="col-md-6"><label>Reference Date</label><input type="date" name="refD" class="form-control"></div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="submit_admission" class="btn btn-primary">Submit Admission</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include_once("footer.php"); ?>

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

</div>
</body>
</html>
