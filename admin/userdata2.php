<?php
include("includes/header.php");
include("includes/config.php");
session_start();
include("includes/functions.php");
$msg=$msg1=$msg2=$msg3=$msg4=$msg5=$msg6=$msg11=$msg7=$msg11=$msg8=$msg9=$msg10=$firstname=$lastname=$email=$mail=$date=$password=$c_password=$image=$name='';
 $id=$_GET['user'];

if (isset($id)) {
  $result=mysqli_query($con, " SELECT * FROM applicants WHERE regno='$id' "); 
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
          $first_no=$retrieve['first_no'];
          $first_date=$retrieve['first_date'];
          $first_type=$retrieve['first_type'];
          $first_sub1=$retrieve['first_sub1'];
          $first_sub2=$retrieve['first_sub2'];
          $first_sub3=$retrieve['first_sub3'];
          $first_sub4=$retrieve['first_sub4'];
          $first_sub5=$retrieve['first_sub5'];
          $first_sub6=$retrieve['first_sub6'];
          $first_sub7=$retrieve['first_sub7'];
          $first_sub8=$retrieve['first_sub8'];
          $first_sub9=$retrieve['first_sub9'];
          $sec_no=$retrieve['sec_no'];
          $sec_date=$retrieve['sec_date'];
          $sec_type=$retrieve['sec_type'];
          $second_sub1=$retrieve['second_sub1'];
          $second_sub2=$retrieve['second_sub2'];
          $second_sub3=$retrieve['second_sub3'];
          $second_sub4=$retrieve['second_sub4'];
          $second_sub5=$retrieve['second_sub5'];
          $second_sub6=$retrieve['second_sub6'];
          $second_sub7=$retrieve['second_sub7'];
          $second_sub8=$retrieve['second_sub8'];
          $second_sub9=$retrieve['second_sub9'];
          $olevel1=$retrieve['olevel1'];
          $olevel2=$retrieve['olevel2'];
          $dedeg2=$retrieve['dedeg2'];
          $dedeg3=$retrieve['dedeg3'];
          $dedeg4=$retrieve['dedeg4'];
          $dedeg5=$retrieve['dedeg5'];
          $dedeg7=$retrieve['dedeg7'];
          $cert1=$retrieve['cert1'];
          $cert2=$retrieve['cert2'];
          $nysc1=$retrieve['nysc1'];
          $nysc2=$retrieve['nysc2'];
          $nysc3=$retrieve['nysc3'];
          
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
  border-collapse: collapse;
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

<div class='container text-primary' style='background-color:white; margin-top:20px; margin-bottom: 20px;width: 1200px;height: 50px;'>

  <center><button class="btn btn-outline-info" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_olevel1');">PRINT O'LEVEL 1</button></center>
  <center><button class="btn btn-outline-warning" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_olevel2');">PRINT O'LEVEL 2 </button></center>

  <center><button class="btn btn-outline-success" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_deg1');">PRINT FIRST CERT</button></center>

  <center><button class="btn btn-outline-primary" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_deg2');">PRINT SECOND CERT</button></center>
  <center><button class="btn btn-outline-secondary" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_nysc');">PRINT NYSC</button></center>
  <center><button class="btn btn-outline-success" style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_datapage');">PRINT DATAPAGE</button></center>
<!--
  <a><button onclick="window.print()" class='btn btn-outline-success' style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'>Print Page</button></a> -->
</div>

  <div id="printable_div_datapage" class='container text-primary' style='background-color:white; margin-top:20px; margin-bottom: 20px;width: 1200px;height: 1800px;'>

<a href='masters.php'><button class='btn btn-outline-warning' style='float: right;margin-top:20px; padding-right: 10px; margin-left: 5px;'>Back</button></a>
    <a href="logout.php"><button class='btn btn-outline-danger' style='float: right;margin-top:20px;margin-left: 10px;'>Logout</button></a>
 <center><h2 style="margin-left: 140px;"><?php  echo ucfirst($name. " ". $last); ?></h2></center> 
<center><img src="images/pass/<?php  echo $image; ?>" class="img-fluid img-thumbnail" width="100" height="80"></center>
<center>
<h5><?php echo "$faculty"; ?></h5>
<h5><?php echo "$dept"; ?></h5>
<h5><?php echo "$programme"; ?></h5>
<h5><?php echo "$title"; ?></h5>
</center>
<table>
  
    
    
  <table class="center" style="border:1px solid black; margin-top:1px; width: 800px;   ">
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
<table style="width: 400px;">
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

<table style="width: 400px;">
  <th style="text-align:center;" colspan="2">Qualifcation</th>
            
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

<table style="width: 400px;">
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
<div id="printable_div_deg1" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1200px;height: 1200px;'>
  <h4 >Degree Cert: 1</h4>
<img src="images/result/<?php  echo $cert1; ?>"  width="900" height="1100"><br><br>

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
<div id="printable_div_deg2" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1200px;height: 1200px;'>
<h3>Degree Cert: 2</h3>
<img src="images/result/<?php  echo $cert2; ?>" alt="Not Available" class="img-fluid img-thumbnail" width="70%" height="75%" padding-top="5px">
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

<div id="printable_div_olevel1" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1200px;height: 1200px;'>
  <h3>Olevel Result -1:</h3>
<img src="images/result/<?php  echo $olevel1; ?>" class="img-fluid " width="70%" height="75%"><br><br>
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
<div id="printable_div_olevel2" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1200px;height: 1200px;'>
  <h3>Olevel Result 2:</h3>
<img src="images/result/<?php  echo $olevel2; ?>" class="img-fluid " width="70%" height="75%"><br><br>

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

<div id="printable_div_nysc" class='container text-success' style='background-color:white; margin-top:50px; margin-bottom: 20px;width: 1200px;height: 900px;'>
<h3>NYSC CERT:</h3> <br>
<!--
<img src="images/result/<?php  echo $nysc1; ?>" alt="Not Available" class="img-fluid " width="100" height="80" padding-top="5px"><br>


<img src="images/result/<?php  echo $nysc2; ?>" alt="Not Available" class="img-fluid " width="100" height="80" padding-top="5px"><br>
-->
<img src="images/result/<?php  echo $nysc3; ?>" alt="Not Available" class="img-fluid " width="900" height="500"  padding-top="5px"><br><br>
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
</body>
</html>
