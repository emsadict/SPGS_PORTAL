<?php
	session_start();
	error_reporting(0);
	include_once("fun.inc.php");
	if(!isset($_SESSION['spgs_auth'])){
		header("location: spgslogin.php");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}

$maxsize=300000;
if(isset($_REQUEST["update"])){
	if(searchRecord("spgs_acad_rec","regno",$user)==0 && $_FILES['olevel1']['name']==""){
		$message="O Level result must be uploaded";
	}elseif($_FILES['olevel1']['size'] > $maxsize || $_FILES['olevel2']['size'] > $maxsize || $_FILES['nysc3']['size'] > $maxsize){
		$message="Result file must not exceed 300kb";
	}elseif($_REQUEST["nysc1"]!="" && $_REQUEST["nysc33"]=="" && $_FILES['nysc3']['name']==""){
		$message="NYSC Certificate not uploaded";
	}else{
		if($_FILES['olevel1']['name'] !=""){
			$pix_id1=$user."olevel1";
			$pix_id1 .=".jpg";
			$target1 = "result/";
			$target1 = $target1 . $pix_id1;
			move_uploaded_file($_FILES['olevel1']['tmp_name'], $target1);
		}else{
			$pix_id1=$_REQUEST["olevel11"];
		}

		if($_FILES['olevel2']['name'] !=""){
			$pix_id2=$user."olevel2";

			$pix_id2 .=".jpg";

			$target2 = "result/";

			$target2 = $target2 . $pix_id2;
			move_uploaded_file($_FILES['olevel2']['tmp_name'], $target2);
		}else{
			$pix_id2=$_REQUEST["olevel22"];
		}
		
		if($_FILES['cert1']['name'] !=""){
			$cert1=$user."cert1";

			$cert1 .=".jpg";

			$target4 = "result/";

			$target4 = $target4 . $cert1;
			move_uploaded_file($_FILES['cert1']['tmp_name'], $target4);
		}else{
			$cert1=$_REQUEST["cert11"];
		}
		
		if($_FILES['cert2']['name'] !=""){
			$cert2=$user."cert2";

			$cert2 .=".jpg";

			$target5 = "result/";

			$target5 = $target5 . $cert2;
			move_uploaded_file($_FILES['cert2']['tmp_name'], $target5);
		}else{
			$cert2=$_REQUEST["cert22"];
		}
		
		if($_FILES['nysc3']['name'] !=""){
			$nysc=$user."nysc";

			$nysc .=".jpg";

			$target3 = "result/";

			$target3 = $target3 . $nysc;
			move_uploaded_file($_FILES['nysc3']['tmp_name'], $target3);
		}else{
			$nysc=$_REQUEST["nysc33"];
		}
		$info=array($_REQUEST["reg_no"],$_REQUEST["sname1"],$_REQUEST["sno1"],$_REQUEST["sdate1"],$_REQUEST["stype1"],implode("|",$_REQUEST["sub11"]),implode("|",$_REQUEST["sub12"]),implode("|",$_REQUEST["sub13"]),implode("|",$_REQUEST["sub14"]),implode("|",$_REQUEST["sub15"]),implode("|",$_REQUEST["sub16"]),implode("|",$_REQUEST["sub17"]),implode("|",$_REQUEST["sub18"]),implode("|",$_REQUEST["sub19"]),$_REQUEST["sname2"],$_REQUEST["sno2"],$_REQUEST["sdate2"],$_REQUEST["stype2"],implode("|",$_REQUEST["sub21"]),implode("|",$_REQUEST["sub22"]),implode("|",$_REQUEST["sub23"]),implode("|",$_REQUEST["sub24"]),implode("|",$_REQUEST["sub25"]),implode("|",$_REQUEST["sub26"]),implode("|",$_REQUEST["sub27"]),implode("|",$_REQUEST["sub28"]),implode("|",$_REQUEST["sub29"]),$pix_id1,$pix_id2,$_REQUEST["dedeg1"],$_REQUEST["dedeg2"],$_REQUEST["dedeg3"],$_REQUEST["dedeg4"],$_REQUEST["dedeg5"],$_REQUEST["dedeg6"],$_REQUEST["dedeg7"],$_REQUEST["deal1"],$_REQUEST["deal2"],$_REQUEST["deal3"],$_REQUEST["deal4"],$_REQUEST["deal5"],$_REQUEST["deal6"],$_REQUEST["deal7"],$cert1,$cert2,$_REQUEST["nysc1"],$_REQUEST["nysc2"],$nysc,$_REQUEST["otherinfo"]);

			if(input2($info,"spgs_acad_rec")){
				$message="Record Successfully Submited, [<a href=\"spgs_slip.php\" target=\"_blank\">Print Slip</a>]";
				/*
				if(searchRecord("spgs_acad_rec","regno",$_REQUEST["reg_no"])>=1 && searchRecord("spgs_basicinfo","regno",$_REQUEST["reg_no"])>=1){
					$message.=", [<a href=\"spgs_slip.php\">Print Out Your Slip</a>]";
				}
				*/
			}else{

				$message="Error Updating Information, try again";

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

      <?php require('nav_portal.inc.php'); ?>
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Academic Record Page</h2>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post" role="form" class="php-email-form" name="formcheck" onsubmit="return formCheck(this);">
			<?php
				if(isset($message)){
					echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">
							'.$message.'
						  </div>';
				}
				if(isset($_REQUEST['message'])){
					echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">
							'.$_REQUEST['message'].'
						  </div>';
				}
			?>
			<?php 
				$rec=getRecs("spgs_acad_rec","regno",$user);
				echo '
              <div class="row">
				<div class="form-group" style="text-align: center; font-weight: bold;">
				  <br />
					O\'LEVEL INFORMATION
             	</div>
				
                <div class="col-lg-3 form-group">
					<label for="sname1">FULL NAME.:</label>
					<input type="hidden" name="reg_no" value="'.$user.'" />
                  <input type="text" name="sname1" class="form-control" id="sname1" value="'.$rec["first_name"].'" placeholder="FULL NAME" required>
                </div>
                <div class="col-lg-3 form-group">
					<label for="sno1">EXAM NUMBER.:</label>
                  <input type="text" class="form-control" name="sno1" id="sno1" value="'.$rec["first_no"].'" placeholder="1ST SITTING EXAM NO" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="sname2">FULL NAME.:</label>
                  <input type="text" name="sname2" value="'.$rec["sec_name"].'" class="form-control" id="sname2" placeholder="FULL NAME" >
                </div>
                <div class="col-lg-3 form-group">
					<label for="sno2">EXAM NUMBER.:</label>
                  <input type="text" class="form-control" value="'.$rec["sec_no"].'" name="sno2" id="sno2" placeholder="2ND SITTING EXAM NO" >
                </div>
              </div>
			  <div class="row">
              	<div class="col-lg-3 form-group">
					<label for="sdate1">EXAM DATE.:</label>
                  <input type="text" class="form-control" name="sdate1" value="'.$rec["first_date"].'" id="sdate1" placeholder="1ST SITTING EXAM DATE" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="stype1">EXAM TYPE.:</label>
					<input type="text" value="'.$rec["first_type"].'" class="form-control" name="stype1" id="stype1" placeholder="1ST SITTING EXAM TYPE" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="sdate2">EXAM DATE.:</label>
                  <input type="text" value="'.$rec["sec_date"].'" class="form-control" name="sdate2" id="sdate2" placeholder="2ND SITTING EXAM DATE" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="stype2">EXAM TYPE.:</label>
					<input type="text" value="'.$rec["sec_type"].'" class="form-control" name="stype2" id="stype2" placeholder="2ND SITTING EXAM TYPE" >
                </div>
              </div>';
			?>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjectsb("sub11[]","sub11","English Language"); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub11[]","grd11",subgrd($rec["6"])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub21[]","sub21",subtitle($rec[19])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub21[]","grd21",subgrd($rec[19])); ?>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjectsb("sub12[]","sub12","Mathematics"); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub12[]","grd12",subgrd($rec[7])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub22[]","sub22",subtitle($rec[20])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub22[]","grd22",subgrd($rec[20])); ?>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjectsb("sub13[]","sub13","Biology"); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub13[]","grd13",subgrd($rec[8])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub23[]","sub23",subtitle($rec[21])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub23[]","grd23",subgrd($rec[21])); ?>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjectsb("sub14[]","sub14","Chemistry"); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub14[]","grd14",subgrd($rec[9])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub24[]","sub24",subtitle($rec[22])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub24[]","grd24",subgrd($rec[22])); ?>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjectsb("sub15[]","sub15","Physics"); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub15[]","grd15",subgrd($rec[10])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub25[]","sub25",subtitle($rec[23])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub25[]","grd25",subgrd($rec[23])); ?>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjects("sub16[]","sub16",subtitle($rec[11])); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub16[]","grd16",subgrd($rec[11])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub26[]","sub26",subtitle($rec[24])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub26[]","grd26",subgrd($rec[24])); ?>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjects("sub17[]","sub17",subtitle($rec[12])); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub17[]","grd17",subgrd($rec[12])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub27[]","sub27",subtitle($rec[25])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub27[]","grd27",subgrd($rec[25])); ?>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjects("sub18[]","sub18",subtitle($rec[13])); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub18[]","grd18",subgrd($rec[13])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub28[]","sub28",subtitle($rec[26])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub28[]","grd28",subgrd($rec[26])); ?>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<?php listSubjects("sub19[]","sub19",subtitle($rec[14])); ?>
                </div>
                <div class="col-lg-3 form-group">
					<?php listGrades("sub19[]","grd19",subgrd($rec[14])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listSubjects("sub29[]","sub29",subtitle($rec[27])); ?>
                </div>
				<div class="col-lg-3 form-group">
					<?php listGrades("sub29[]","grd29",subgrd($rec[27])); ?>
                </div>
              </div>
			<?php echo '
			  <div class="row">
              	<div class="col-lg-6 form-group">
					<strong>Upload 1st Sitting Result</strong>
					<input type="file" name="olevel1"  accept="image/jpg" class="form-control" />
					<input type="hidden" name="olevel11" value="'.$rec[28].'"  />
                </div>
				<div class="col-lg-6 form-group">
					<strong>Upload 2nd Sitting Result</strong>
					<input type="file" name="olevel2"  accept="image/jpg" class="form-control" />
					<input type="hidden" name="olevel22" value="'.$rec[29].'"  />
                </div>
              </div>
			  <div class="form-group" style="text-align: center; font-weight: bold;">
				  <br />
				1ST DEGREE CERTIFICATE/INFORMATION
              </div>
			  <div class="row">
              	<div class="col-lg-3 form-group">
					<label for="dedeg1">FULL NAME.:</label>
                  <input type="text" class="form-control" name="dedeg1" id="dedeg1" value="'.$rec["dedeg1"].'" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="dedeg2">QUAL. OBTAINED.:</label>
					<input type="text" class="form-control" name="dedeg2" id="dedeg2" value="'.$rec["dedeg2"].'" placeholder="e.g B.Sc, HND, OND" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="dedeg3">REG/MATRIC NO.:</label>
                  <input type="text" class="form-control" name="dedeg3" id="dedeg3" value="'.$rec["dedeg3"].'" placeholder="e. g CSC/001/001" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="sex">CLASS OF DEGREE.:</label>
					<input type="text" class="form-control" name="dedeg4" id="dedeg4" value="'.$rec["dedeg4"].'" placeholder="e. g First Class, Upper Credit" >
                </div>
              </div>
			  <div class="row">
              	<div class="col-lg-3 form-group">
					<label for="dedeg5">INSTITUTION.:</label>
                  <input type="text" class="form-control" name="dedeg5" id="dedeg5" value="'.$rec["dedeg5"].'" placeholder="e. g UNIMED" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="dedeg6">DURATION.:</label>
					<input type="text" class="form-control" name="dedeg6" id="dedeg6" value="'.$rec["dedeg6"].'" placeholder="e. g 4 Years" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="dedeg3">DISCIPLINE.:</label>
                  <input type="text" class="form-control" name="dedeg7" id="dedeg7" value="'.$rec["dedeg7"].'" placeholder="e. g Computer Science" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="dedeg3">Upload 1st Certificate.:</label>
					<input type="file" name="cert1"  accept="image/jpg" class="form-control"/>
					<input type="hidden" name="cert11" value="'.$rec["cert1"].'"  />
                </div>
              </div>
			  <div class="form-group" style="text-align: center; font-weight: bold;">
				  <br />
				ADDITIONAL CERTIFICATE
              </div>
			  <div class="row">
              	<div class="col-lg-3 form-group">
					<label for="deal1">FULL NAME.:</label>
                  <input type="text" class="form-control" name="deal1" id="deal1" value="'.$rec["deal1"].'" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="deal2">QUAL. OBTAINED.:</label>
					<input type="text" class="form-control" name="deal2" id="deal2" value="'.$rec["deal2"].'" placeholder="e.g B.Sc, HND, OND" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="deal3">REG/MATRIC NO.:</label>
                  <input type="text" class="form-control" name="deal3" id="deal3" value="'.$rec["deal3"].'" placeholder="e. g CSC/001/001" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="deal4">CLASS OF DEGREE.:</label>
					<input type="text" class="form-control" name="deal4" id="deal4" value="'.$rec["deal4"].'" placeholder="e. g First Class, Upper Credit" >
                </div>
              </div>
			  <div class="row">
              	<div class="col-lg-3 form-group">
					<label for="deal5">INSTITUTION.:</label>
                  <input type="text" class="form-control" name="deal5" id="deal5" value="'.$rec["deal5"].'" placeholder="e. g UNIMED" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="deal6">DURATION.:</label>
					<input type="text" class="form-control" name="deal6" id="deal6" value="'.$rec["deal6"].'" placeholder="e. g 4 Years" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="deal7">DISCIPLINE.:</label>
                  <input type="text" class="form-control" name="deal7" id="deal7" value="'.$rec["deal7"].'" placeholder="e. g Computer Science" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="cert2">Upload 2nd Certificate.:</label>
					<input type="file" name="cert2"  accept="image/jpg" class="form-control"/>
					<input type="hidden" name="cert22" value="'.$rec["cert2"].'"  />
                </div>
              </div>
			  <div class="form-group" style="text-align: center; font-weight: bold;">
				  <br />
				NYSC CERTIFICATE (IF APPLICABLE)
              </div>
			  <div class="row">
              	<div class="col-lg-3 form-group">
					<label for="nysc1">NYSC YEAR.:</label>
                  <input type="text" class="form-control" name="nysc1" id="nysc1" value="'.$rec["nysc1"].'" placeholder="NYSC YEAR" >
                </div>
				<div class="col-lg-3 form-group">
					<label for="nysc2">NYSC NO.:</label>
					<input type="text" class="form-control" name="nysc2" id="nysc2" value="'.$rec["nysc2"].'" placeholder="NYSC NO" >
                </div>
				<div class="col-lg-6 form-group">
					<label for="nysc3">Upload NYSC Certificate.:</label>
					<input type="file" name="nysc3"  accept="image/jpg" class="form-control"/>
					<input type="hidden" name="nysc33" value="'.$rec["nysc3"].'"  />
                </div>
              </div>
			  <div class="form-group">
                <textarea class="form-control" name="otherinfo" rows="5" placeholder="Any other Information to support your application" >'.$rec['otherinfo'].'</textarea>
              </div>';
			?>
			
              <div class="text-center"><button type="submit" onclick="return confirm(\'Kindly review your record, Are you sure you want to Submit?\')" name="update">Submit Academic Record</button>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Us Section -->

  </main><!-- End #main -->

  <?php require('footer.inc.php'); ?>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<!--  <script src="assets/vendor/php-email-form/validate.js"></script>-->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>