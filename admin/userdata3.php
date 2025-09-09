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
  $result=resultnew("SELECT * FROM `admitted_2022` WHERE regno='$id' "); 
          
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



</head>
<body id='body-bg'>
<?php include_once("header.php")?>
<?php include_once("sidebar.php")?>
<div class='container text-primary' style='background-color:white; margin-top:80px; margin-bottom: 20px;width: 1000px;height: 50px;margin-left: 400px;'>


<center><button class="btn btn-outline-success" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_datapage');">PRINT DATAPAGE</button></center>
<!--
  <a><button onclick="window.print()" class='btn btn-outline-success' style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'>Print Page</button></a> -->
</div>

  <div id="printable_div_datapage" class='container text-primary' style='background-color:white; margin-top:20px; margin-bottom: 20px;width: 1000px;height: 1800px; margin-left: 400px;'>

<a href='forms-layouts.php'><button class='btn btn-outline-warning' style='float: right;margin-top:20px; padding-right: 10px; margin-left: 5px;'>Back</button></a>
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
<center><button class="btn btn-success">Screened</button></center>

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

<br>


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
