<?php

  session_start();

 include_once("fun.inc.php");
 $user=$matricno="PUH/21/3457";
 $dept="MSCPH";
 $level="800";
 $semester="FIRST";
 
 $utyp=1;
 $stype="REGULAR";
 $school_semester="SECOND";
 $school_session="2022/2023";
 $student_session="2021/2022";
 $sch_sem_stu_session="THIRD";
 $carryover_session="2021/2022";

	if(!isset($_SESSION['spgs_auth'])){

		header("location: portal_login.php");

		

	}


 if(searchRecord("Screened_Candidates_2022","regno",$_SESSION['spgs_auth'][1])==0 || searchRecord("Screened_Candidates_2022","regno",$_SESSION['spgs_auth'][1])==0){

	    echo ("<script LANGUAGE='JavaScript'>

    window.alert('You have to complete your screening');

    window.location.href='basicInfo_admitted.php';

    </script>");

		header("location: portal_login.php");

	}

	else{

		$spgs_auth=$_SESSION['spgs_auth'];

		$user=$spgs_auth[1];

		$admrecS=getRecs("Screened_Candidates_2022","regno",$user);

		$sessionRec=$admrecS['session'];

	}



	$cal=getCalendarInfo();

//	$ret=getRecs("Screened_Candidates_2022","regno",$user);

	$admrec=getRecs("Screened_Candidates_2022","regno",$user);

    $admrec=getRecs("Screened_Candidates_2022","regno",$user);

	$sem=getCalendarInfo();

	$sem[1]=$admrec['session'];

	$sess=$sem[1];

	$sem[2]=$admrec['semester'];

	$level=$admrec['level'];

	$dept=$admrec['dept'];

	$session=$admrec['session'];

    $semester=$admrec['semester'];

//	$amounPaid2=$amounPaid['amount'];

	$programme=$admrec['programme'];

//	echo "$dept";

//	echo "$level";

//	echo "$semester";

//	echo "$user";

//	echo "$session";

//	$session="2021/2022";

//  $semester="SECOND";

// $carryover_semester=$semester;

// check if complete paymnt for student_session

//check carryover_session trying to register for

// Check the carry_over semester trying to register

//if carry over_semester = 'second' and $school_session NOT $student_session ... REG NOT ALLOWED ...  pay 50% of school fee of $school_session

//if carry over_semester = 'THIRD' and $school_session !=school_session  ... REG NOT ALLOWED ...  pay 100% of school fee of $school_session

// check if payment exists for school_session 

//check if school_semester not equal student_carryover_semster ....would not be allowed to register

// if carryover_Semester=FIRST and  $sch_sem_stu_session=third and carryover_session=student_session  ...CARRY OVER REG TO BE ALLOWED
   
// 


 //

 //

// total carry over units add student semester unit to carryover units
echo $semester;
 function carryover($user,$dept,$level,$semester,$matricno,$utyp,$stype,$school_semester) {
 $cat=$unit=$title="";
 $carriedcourses= listPCourses($level,$semester,$matricno);
 $pcos=listPCourses($level,$semester,$matricno);

	$rpt=resultnew("SELECT oc FROM resulttable WHERE matricno='$matricno'  ORDER BY resultid DESC LIMIT 0,1");
	list($oc)=mysqli_fetch_array($rpt); 
$n=0;

	$name='cos[]';


	if($oc!=""){

		$exp=explode("|",$oc);
		foreach($exp as $k){
			$sql=resultnew("SELECT courseTitle,credit,cat FROM course WHERE courseCode='$k' AND semester='$semester' AND dept='$dept' AND stype='REGULAR'");


              $c=mysqli_num_rows($sql);
          
			if($c==1){

				list($title,$unit,$cat)=mysqli_fetch_array($sql);


				$n=$n+1;

                echo '<tr style="padding:5px; background-color:white;">

			 <td align="center" style="padding:5px;">['.$n.']</td>	

				<td align="center" style="padding:5px;">';



					echo '<input type="hidden" name="'.$name.'" value="'.$k.'|'.$title.'|'.$unit.'|CO" />


					<input type="checkbox" name="'.$name.'" value="'.$k.'|'.$title.'|'.$unit.'|CO" checked disabled="disabled" />';


					}


					echo $k.'

                </td>

                <td align="center" style="padding:5px;">'.$title.'</td>

                <td align="center" style="padding:5px;">'.$unit.'</td>

                <td align="center" style="padding:5px;">'.$cat.'</td>

               <!--  <td align="center" style="padding:5px;">CO</td> -->

			</tr>';



			}



		}

		}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ACADEMIC RECORD - SCHOOL OF POSTGRADUATE::University of Medical Sciences, Ondo</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mamba - v4.7.0
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="index.php"><img src="assets/img/unimed_banner_pgschool.png" /></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <?php require('adm_nav_portal.inc.php'); ?>
    </div>
  </header><!-- End Header -->
<body>

  <main id="main">
		<table class="table table-bordered" id="tstyle" align="center" style="background-color:#AAD4FF;" width="850">

			<tr>

				<td colspan="3" align="center" height="18" width="100%" style="background-color:#ffffff; color:#021221;">

                <div id="errorMessage">

					<?php

                        if(isset($message)){

                            echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">

                            '.$message.'

                            </div>';

                        }

                    ?>

				</div>

                </td>

			</tr>

			<tr style="background-color:#0099FF; color:#ffffff;">

				<td colspan="3" align="center" valign="bottom"><strong><br /><br /><marquee behavior="alternate" truespeed="truespeed">[ Welcome to UNIMED Students' Portal]</marquee></strong></td>

			</tr>

           
          	<tr style="background-color:#FFFFFF;color:#000000;"> 

                  <td align="center" colspan="3" style="padding:10px;" valign="top" align="center">

                <table id="tstyle2" align="center" style="background-color:#AAD4FF;" width="850">		

            <tr style="background-color:#063958; color:#fff;">	

				<td colspan="12" align="center" style="padding:5px;"><strong>POSTGRADUATE STUDENTS CARRY OVER COURSE REGISTRATION PAGE</strong>

                </td>

			</tr>

<form action=""  method="post" name="formcheck" onsubmit="return formCheck(this);">
<tr style="background-color:#FFF; color:#F00; font-style:italic;">	

				<td colspan="5" align="center" style="padding:5px;">Please Note that all Courses are Compulsory, tick appropriately and submit<!--[&nbsp;<a href="courseregistration.php?delreg=0" style="color: #00F; font-weight: bold; font-style: normal;">Reset Courses</a>&nbsp;]--></td>

			</tr>   

            <tr style="background-color:#063958;color:White;">

			 <td align="center" style="padding:5px;"><strong>SN</strong></td>	

				<td align="center" style="padding:5px;"><strong>Course Code</strong></td>

                <td align="center" style="padding:5px;"><strong>Course Title</strong></td>

                <td align="center" style="padding:5px;"><strong>Unit</strong></td>

                <td align="center" style="padding:5px;"><strong>Type</strong></td>

			</tr>

<?php 

carryover($user,$dept,$level,$semester,$matricno,$utyp,$stype,$school_semester);


echo '<tr style="padding:5px; background-color:white;">


				<td colspan="5" align="center">&nbsp;&nbsp;



				<input type="submit" class="btn btn-success" name="update" onclick="return confirm(\'Kindly review your record, Are you sure you want to Submit?\')"  value="&nbsp;Update Course Form!&nbsp;"  class="button" />				</td>



			</tr>';

?>
</form>
</table>
  	</main>
 <div>

            <?php

            include_once("footer.inc.php");

            ?></div>

                 </td>

			</tr>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
 <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



</body>

</html>
