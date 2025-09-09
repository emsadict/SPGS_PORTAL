<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
    include_once("../fun.inc.php");
$msg=$name=$sex=$dob=$maritalstatus=$nationality=$state=$lg=$mail=$phoneno=$address=$image=$faculty=$dept=$programme=$title=$noksurname=$nokoname=$nokemail=$first_no=$first_date=$first_type=$first_sub1=$last=$first_sub2=$first_sub3=$first_sub4=$first_sub5=$first_sub6=$first_sub7=$first_sub8=$first_sub9=$sec_no=$sec_date=$sec_type=$second_sub1=$second_sub2=$second_sub3=$second_sub4=$second_sub5=$second_sub6=$second_sub7=$second_sub8=$second_sub9=$olevel1=$olevel2=$dedeg2=$dedeg3=$dedeg4=$dedeg5=$dedeg7=$cert1=$cert2=$nysc1=$nysc2=$nysc3
='';
$result=mysqli_query($con, " SELECT * FROM applicants ORDER BY regno DESC  "); 
$row = mysqli_fetch_array($result);
$line = mysqli_num_rows($result);
echo "</head>";
  echo "<body>";
  echo "<meta name='viewport' content='width=device-width,initial-scale=1.0'>";
  echo "<div class='col-md-12 container-fluid  '>";
  echo "<div class='box container-fluid' style='border:1px solid grey; margin-top:40px;  padding:10px; border-radius: 5px; box-shadow: 3px 3px 3px gray; background-color:; float: center;'>";
  echo "<div class='text-primary'><center><h2>Welcome to Admin Panel</h2></center>";
  echo "<hr>";
  echo "Total Registered Users:".$line;
  echo "<th><a href='usersdata.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>View Users</button></th>";
  echo "<th><a href='admin-panel.php'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>Masters</button></th>";
  echo "<th><a href='pgd.php'  target='_blank'><button class='btn btn-primary' style='float:right; margin-right:40px; padding:4px;'>PGD</button></th>";
  echo "<a href='admin-logout.php'><button class='btn btn-outline-warning' style='float:right; margin-right:40px; padding:4px;'>Logout</button></a>";
  
  echo "<hr>";
while($row = mysqli_fetch_array($result))
  {         
            
        
        echo "<hr>";
           // echo '<li><a href="show.php?regno='.$row['regno'].'">'.$row['regno'].'</a></li>';
              echo '<li><a href="viewall.php?regno='.$row['regno'].'">'.$row['regno'].'</a></li>';
        
            echo "<hr>";     
                    
        }

  ?>
         
