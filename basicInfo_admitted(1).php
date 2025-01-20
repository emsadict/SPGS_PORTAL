<?php
	session_start();
//	ini_set('display_errors', 1);
//	ini_set('display_startup_errors', 1);
	error_reporting(0);
	include_once("fun.inc.php");
//	use PHPMailer\PHPMailer\PHPMailer;
//	use PHPMailer\PHPMailer\SMTP;
//	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	//Create an instance; passing `true` enables exceptions
//	$mail = new PHPMailer(true);

	if(!isset($_SESSION['spgs_auth'])){
		header("location: portal_login.php");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}	$cal = getCalendarInfo();
		$retinv=retInvoiceP($user,"UNIMED SPGS APPLICATION FEE",$cal[1]);
		$rec=getRecs("admitted_2022","regno",$user);
		$student_email=getRecs("student_email", "matricno",$user);
		$schomail=$student_email['email'];
		$mailPassword=$student_email['dfpassword'];
		if(searchRecord("admitted_2022","regno",$user)!=0){
			$prog=$rec['programme'];
			$fac=$rec['faculty'];
			$dept=$rec['dept'];
			
		}else{
			$prog=$retinv[9];
			$fac=$retinv[5];
			$dept=$retinv[6];
		}
		$sch=$retinv[9];
		switch($sch){
		case "Postgraduate Diploma":
			$cos=array('PGDPH','PGDEHSM','PGDHS');
			break;
		case "Masters":
			$cos=array('MPH','MScPH','MSc','MPhil','MPhil.PhD','MPhil/PhD');
			break;
		case "Doctorate":
			$cos=array('PhD','DrPH','DrCH','DrCH');
			break;
		default:
			$cos=array('');
			break;
		}
	
	$db_handle = new DBController();
	$query ="SELECT distinct(state), state_id FROM state2";
	$results = $db_handle->runQuery($query);
	$query2 ="SELECT distinct(faculty), faculty_id FROM faculties_dept_spgs WHERE progtype='$retinv[9]'";
	$results2 = $db_handle->runQuery($query2);
	$maxsize=30000;
	$sem=getCalendarInfo();
	$sess=$sem[3]."/".$sem[4];

if(isset($_REQUEST['update'])){
	if(isset($_FILES['passport']['name']) && $_FILES['passport']['size'] > $maxsize){
		$message="Passport Size Must not exceed 30kb";
	}elseif($_REQUEST["passport2"]=="" && $_FILES['passport']['name']==""){
		$message="There is no Passport file";
	}elseif(sizeof($_REQUEST["refname"])<2 || sizeof($_REQUEST["refemail"])<2){
		$message="Referees are compulsory";
	}else{
		$lg=$_REQUEST["state"];
		$state=getStateName($_REQUEST["country"]);
		$mpfaculty=getFacultyName($_REQUEST['faculty']);
		if($_FILES['passport']['name'] !=""){
			$pix_id=$user;
			$pix_id .=".jpg";
			$target = "pass/";
			$target = $target . $pix_id;
			move_uploaded_file($_FILES['passport']['tmp_name'], $target);
		}else{
			$pix_id=$_REQUEST["passport2"];
		}
		$regno=$_REQUEST['regno'];
		$basic=array($regno,$_REQUEST['surname'],$_REQUEST['onames'],$_REQUEST['sex'],$_REQUEST['dob'],$_REQUEST['maritalstatus'],$_REQUEST['nation'],$state,$lg,$_REQUEST["email"],$_REQUEST["phone"],addslashes($_REQUEST["address"]),$pix_id,$mpfaculty,$_REQUEST['dept'],$_REQUEST['programme'],$_REQUEST['title'],$_REQUEST["noksurname"],$_REQUEST["nokoname"],$_REQUEST["noktel"],$_REQUEST["nokemail"],$_REQUEST["nokrel"],$_REQUEST["nokadd"],$_REQUEST["admissionletter"]);
		//echo $sql;
		
			if(input2($basic,"admitted_2022")){
				$message="Record Successfully Submited, Continue with [<a href=\"portal_academicInfo.php\">Academic Record update</a>]";
			}
		
	}
	
}
elseif(isset($_REQUEST['update'])){
	$message="Asteriks (*) Fields are Compulsory";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BIODATA - SCHOOL OF POSTGRADUATE::University of Medical Sciences, Ondo</title>
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
<script language="javascript">
var xmlHttp
var dStr;

function showHint(str) {
  var xhttp;
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "jamb.php?q="+str, true);
  xhttp.send();
}

function showCustomer(str)
{ 
dStr=str;
//alert(dStr);
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="gradescore.php";
var realStr=str.value;
url=url+"?id="+realStr;
//alert(url);
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function getIt(str)
	{ 
	dStr=str;
	var dsTitle=dStr.value;
	//alert(dsTitle);
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	
	var url="areaList2.php";
	url=url+"?state="+dsTitle;
	//alert(url);
	xmlHttp.onreadystatechange=stateChanged1;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	}

function stateChanged1() 
{ 
	if (xmlHttp.readyState==0 || xmlHttp.readyState==1 || xmlHttp.readyState==2 || xmlHttp.readyState==3)
	{ 
	//alert(dStr);
		document.getElementById('aCont').disabled=true;
		document.getElementById('aCont').innerHTML="...loading";
	}
	
	if (xmlHttp.readyState==4)
	{  
		var retVals=xmlHttp.responseText;
		//alert(retVals);
		document.getElementById('aCont').innerHTML=retVals;
		document.getElementById('aCont').disabled=false;
	}
}

function stateChanged() 
{ 

if (xmlHttp.readyState==0)
{ 
//alert(dStr);
	var strId= dStr.id;
	var strnId=strId.substring(4,5);
	var refCode="title"+strnId;
	//alert(strnId); 
	document.getElementById(refCode).value="loading...";
	alert(refCode);
}
if (xmlHttp.readyState==1)
{ 
//alert(dStr);
	var strId= dStr.id;
	var strnId=strId.substring(4,5);
	var refCode="title"+strnId; 
	document.getElementById(refCode).value="loading...";
}
if (xmlHttp.readyState==2)
{ 
//alert(dStr);
	var strId= dStr.id;
	var strnId=strId.substring(4,5);
	var refCode="title"+strnId; 
	document.getElementById(refCode).value="loading...";
}
if (xmlHttp.readyState==3)
{ 
//alert(dStr);
	var strId= dStr.id;
	var strnId=strId.substring(4,5);
	var refCode="title"+strnId; 
	document.getElementById(refCode).value="loading...";
}
if (xmlHttp.readyState==4)
{ 
//alert(dStr);
	var strId= dStr.id;
	var strnId=strId.substring(4,5);
	var refCode="title"+strnId; 
	document.getElementById(refCode).value=xmlHttp.responseText;
}

}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
</script>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="jquery-1.11.0.min.js"></script>
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "get_state.php",
	data:'country_id='+val,
	success: function(data){
		$("#state-list").html(data);
	}
	});
}

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
<script>
function getDept(val) {
	var progtype="<?php echo $retinv[9]; ?>";
	$.ajax({
	type: "POST",
	url: "get_dept_spgs.php",
	data:'faculty_id='+val+'&progtype='+progtype,
	success: function(data){
		$("#dept-list").html(data);
	}
	});
}

function selectFaculty(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
<script>
function getPreferredd(val) {
	$.ajax({
	type: "POST",
	url: "get_preferredsup.php",
	data:'preferredf_id='+val,
	success: function(data){
		$("#preferredd-list").html(data);
	}
	});
}

function selectPreferredf(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
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

  <main id="main">

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 >Student Biodata Information Page</h2>
          <p style="color:#FF0000;"><?php   echo "Your student email is: $schomail";   ?></p>
          <p style="color:#FF0000;"><?php   echo "Your default password is: $mailPassword";   ?></p>
        </div>
        <!--
<div class="text-center"><button type="submit" name="update">Print Admission Letter</button></div>
-->
   <div class="btn-toolbar" align"center">

<center><a href='admnletter_controller.php'target="_blank"><button class='btn btn-primary btn-sm' style='float:center; '>Print Admission Letter</button></a></center>
<center><a href='spgs_counselingform.php 'target="_blank"><button class='btn btn-info btn-sm' style='float:center; '>Print Student's Counseling Form</button></a></center>
<center><a href='spgs_libraryform.php'target="_blank"><button class='btn btn-success btn-sm' style='float:center; '>Print Library Form</button></a></center>
<center><a href='spgs_clearanceform.php 'target="_blank"><button class='btn btn-warning btn-sm' style='float:center; '>Print Student's Admission Clearnace Form</button></a></center>
<!--
<form action="resultForm_pg.php" method="post" target="_blank" enctype="multipart/form-data">
            <input type="submit" name="" class='btn btn-danger btn-sm' Value="Check Result"  size="25">
        </form>
-->
<center><a href='Forms_pg.php' target="_blank"><button  class='btn btn-danger btn-sm' style='float:center; '>Download Forms</button></a></center>

</div></br></br>
        <div class="row">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post" name="formcheck" onsubmit="return formCheck(this);" role="form" class="php-email-form">
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
				$rec=getRecs("admitted_2022","regno",$user);
				
				$ref1=getRecs2("spgs_referees",array('regno'=>$user,'refno'=>1),0,1);
				$ref2=getRecs2("spgs_referees",array('regno'=>$user,'refno'=>2),0,1);
				echo '
              <div class="row">
                <div class="col-lg-3 form-group">
					<label for="regno">APPLICATION NO.:</label>
                  <input type="text" name="regno" name="regno" value="'.$user.'" class="form-control" id="regno" placeholder="APPLICATION NO" readonly>
                </div>
                <div class="col-lg-3 form-group">
					<label for="surname">SURNAME.:</label>
                  <input type="text" class="form-control" name="surname" id="surname" value="'.$rec['surname'].'" placeholder="YOUR SURNAME" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="onames">OTHER NAME(S).:</label>
                  <input type="text" class="form-control" value="'.$rec['onames'].'" name="onames" id="onames" placeholder="OTHER NAME(S)" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="sex">GENDER.:</label>
					<select class="form-control" required name="sex" id="sex">
					<option "">--SELECT--</option>
					<option value="Male" '; if($rec[4]=="M" || $rec[4]=="Male"){ echo 'selected="selected"';} echo '>Male</option>
                    <option value="Female" '; if($rec[4]=="F" || $rec[4]=="Female"){ echo 'selected="selected"';} echo '>Female</option>
					</select>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<label for="sname">DATE OF BIRTH.:</label>
                  <input type="date" name="dob" class="form-control" id="dob" value="'.$rec['dob'].'" placeholder="Date of Birth" >
                </div>
                <div class="col-lg-3 form-group">
					<label for="nation">NATIONALITY.:</label>
                  	<select class="form-control" required name="nation" id="nation">
					<option "">--SELECT--</option>
					<option '; if($rec[7]=="NIGERIAN"){ echo 'selected="selected"';} echo '>NIGERIAN</option>
                    <option '; if($rec[7]=="OTHERS"){ echo 'selected="selected"';} echo '>OTHERS</option>
					</select>
                </div>
				<div class="col-lg-3 form-group">
					<label for="country">STATE OF ORIGIN.:</label>
                  	<select name="country" id="country-list" class="form-control demoInputBox" onChange="getState(this.value);">
						<option></option>';
				?>
						<?php
						if($rec[8]!=""){
						 echo '<option selected="selected" value="'.getStateID($rec[8]).'">'.$rec[8].'</option>';	
						}
						foreach($results as $country) {
						?>
						<option value="<?php echo $country["state_id"]; ?>"><?php echo $country["state"]; ?></option>
						<?php
						}
						?>
				<?php echo '</select>
                </div>
				<div class="col-lg-3 form-group">
					<label for="state">LOCAL GOVT.:</label>
                  	<select name="state" id="state-list" class="form-control demoInputBox">
						<option></option>';
						selectLG($rec[8],$rec[9]);
					echo '</select>
                </div>
              </div>
			  <div class="row">
				<div class="col-lg-3 form-group">
					<label for="maritalstatus">MARITAL STATUS.:</label>
                  	<select class="form-control" required name="maritalstatus" id="maritalstatus">
					<option "">--SELECT--</option>
					<option '; if($rec['maritalstatus']=="Single"){ echo 'selected="selected"';} echo '>Single</option>
                    <option '; if($rec['maritalstatus']=="Married"){ echo 'selected="selected"';} echo '>Married</option>
                    <option '; if($rec['maritalstatus']=="Divorce"){ echo 'selected="selected"';} echo '>Divorce</option>
					</select>
                </div>
                <div class="col-lg-3 form-group">
					<label for="email">EMAIL.:</label>
                  <input type="email" name="email" class="form-control" id="email" value="'.$rec['email'].'" placeholder="E-MAIL" required>
                </div>
                
				<div class="col-lg-3 form-group">
					<label for="phone">PHONE NO.:</label>
                  	<input type="text" class="form-control" name="phone" id="phone" value="'.$rec['phoneno'].'" placeholder="PHONE NO.:" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="passport">PASSPORT.:</label>
					<input type="hidden" name="passport2" value="'.$rec['passport'].'"  />
					<input type="file" name="passport" class="form-control" accept="image/jpg" id="passport" />
                </div>
              </div>
              <div class="form-group">
				<label for="address">CURRENT ADDRESS.:</label>
                <input type="text" class="form-control" name="address" id="address" value="'.$rec['address'].'" placeholder="ADDRESS" required>
              </div>
			  <div class="row">
				<div class="col-lg-3 form-group">
					<label for="faculty">FACULTY.:</label>
                  	<select name="faculty" id="faculty-list" class="form-control demoInputBox" onChange="getDept(this.value);" >
                <option></option>';
				
				if($fac!=""){
				 echo '<option selected="selected" value="'.getFacultyID($fac).'">'.$fac.'</option>';	
				}
                foreach($results2 as $faculties) {
                	echo '<option value="'.$faculties["faculty_id"].'">'.$faculties["faculty"].'</option>';  
                }
                 echo '</select>
                </div>
                <div class="col-lg-3 form-group">
					<label for="faculty">DEPARTMENT/OPTION.:</label>
                  	<select name="dept" id="dept-list" class=" form-control demoInputBox">
					<option>'.$rec['dept'].'</option>';
						
					echo '</select>
                </div>
                
				<div class="col-lg-3 form-group">
					<label for="programme">PROGRAMME.:</label>
                  	<select class="form-control" required name="programme" id="programme">
						<option value="">--SELECT--</option>
						<option selected>'.$prog.'</option>
					</select>
                </div>
				<div class="col-lg-3 form-group">
					<label for="title">PROGRAMME TYPE.:</label>
                  	<select class="form-control" required name="title" id="title">
						<option "">--SELECT--</option>';
						foreach($cos as $kos){
							echo '<option'; if($kos==$rec['title']){ echo ' selected="selected" '; } echo '>'.$kos.'</option>';
						}
					echo '</select>
                </div>
			  <div class="form-group" style="text-align: center; font-weight: bold;">
				  <br />
				NEXT OF KIN INFORMATION
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<label for="noks">SURNAME.:</label>
                  <input type="text" name="noksurname" class="form-control" id="noksurname" value="'.$rec['noksurname'].'" placeholder="NOK SURNAME" required>
                </div>
                
				<div class="col-lg-3 form-group">
					<label for="nokoname">OTHER NAME(S).:</label>
                  	<input type="text" class="form-control" name="nokoname" id="nokoname" value="'.$rec['nokoname'].'" placeholder="NOK OTHER NAME(S).:" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="noktel">PHONE NO.:</label>
                  	<input type="text" class="form-control" value="'.$rec['noktel'].'" name="noktel" placeholder="NOK PHONE NO.:" id="noktel" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="nokemail">EMAIL.:</label>
                  	<input type="email" class="form-control" value="'.$rec['nokemail'].'" name="nokemail" id="nokemail" placeholder="NOK EMAIL" required>
                </div>
                
                
            
              </div>
			  <div class="form-group" style="text-align: center; font-weight: bold;">
				  <br />
				REFEREES
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<label for="ref11">1. REFEREE FULLNAME.:</label>
                  <input type="text" name="refname[]" id="ref11" class="form-control" value="'.$ref1['name'].'" placeholder="REFEREE FULLNAME" readonly>
                </div>
				<div class="col-lg-3 form-group">
					<label for="ref12">PHONE NO.:</label>
                  	<input type="text" class="form-control" value="'.$ref1['phoneno'].'" name="refphone[]" placeholder="REFEREE PHONE NO.:" id="ref12" readonly>
                </div>
				<div class="col-lg-3 form-group">
					<label for="ref13">EMAIL.:</label>
                  	<input type="email" class="form-control" value="'.$ref1['email'].'" name="refemail[]" id="ref13" placeholder="REFEREE EMAIL" readonly>
                </div>
				<div class="col-lg-3 form-group">
					<label for="ref14">AFFILIATION.:</label>
                  	<input type="text" class="form-control" id="ref14" name="refaffiliation[]" value="'.$ref1['affiliation'].'" placeholder="AFFILIATION.:" readonly>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<label for="ref21">2. REFEREE FULLNAME.:</label>
                  <input type="text" name="refname[]" id="ref21" class="form-control" value="'.$ref2['name'].'" placeholder="REFEREE FULLNAME" readonly>
                </div>
				<div class="col-lg-3 form-group">
					<label for="ref22">PHONE NO.:</label>
                  	<input type="text" class="form-control" value="'.$ref2['phoneno'].'" name="refphone[]" placeholder="REFEREE PHONE NO.:" id="ref22" readonly>
                </div>
				<div class="col-lg-3 form-group">
					<label for="ref23">EMAIL.:</label>
                  	<input type="email" class="form-control" value="'.$ref2['email'].'" name="refemail[]" id="ref23" placeholder="REFEREE EMAIL" readonly>
                </div>
				<div class="col-lg-3 form-group">
					<label for="ref24">AFFILIATION.:</label>
                  	<input type="text" class="form-control" name="refaffiliation[]" id="ref24" value="'.$ref2['affiliation'].'" placeholder="AFFILIATION.:" readonly>
                </div>
              </div>
              ';
			?>
              <div class="text-center"><button type="submit" name="update" onclick="return confirm('Kindly review your record, Are you sure you want to Submit?')">Update Biodata</button></div>
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