<?php
	session_start();
//	ini_set('display_errors', 1);
//	ini_set('display_startup_errors', 1);
	error_reporting(0);
	include_once("fun.inc.php");
 // use PHPMailer\PHPMailer\PHPMailer;
//	use PHPMailer\PHPMailer\SMTP;
//	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	//Create an instance; passing `true` enables exceptions
//	$mail = new PHPMailer(true);

	if(!isset($_SESSION['spgs_auth'])){
		header("location: spgslogin.php");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}	$cal = getCalendarInfo();
		$retinv=retInvoiceP($user,"UNIMED SPGS APPLICATION FEE",$cal[1]);
		$rec1=getRecs("other_info","regno",$user);
		if(searchRecord("admitted_2022","regno",$user)!=0){
			$prog=$rec1['programme'];
			$fac=$rec1['faculty'];
			$dept=$rec1['dept'];
			$other=$rec1['other_info'];
		}else{
			$prog=$retinv[9];
			$fac=$retinv[5];
			$dept=$retinv[6];
		}
	//	$sch=$retinv[9];
	//	switch($sch){
	//	case "Postgraduate Diploma":
	//		$cos=array('PGDPH','PGDEHSM','PGDHS');
	//		break;
	//	case "Masters":
	//		$cos=array('MPH','MScPH','MSc','MPhil');
//			break;
	//	case "Doctorate":
	//		$cos=array('PhD','DrPH','DrCH','DrCH');
	//		break;
	//	default:
	//		$cos=array('');
	//		break;
	//	}
	$db_handle = new DBController();
	$query ="SELECT distinct(state), state_id FROM state2";
	$results = $db_handle->runQuery($query);
	$query2 ="SELECT distinct(faculty), faculty_id FROM faculties_dept_spgs WHERE progtype='$retinv[9]'";
	$results2 = $db_handle->runQuery($query2);
	$maxsize=30000;
	$sem=getCalendarInfo();
	$sess=$sem[3]."/".$sem[4];

if(isset($_REQUEST['update'])){
//	if(isset($_FILES['passport']['name']) && $_FILES['passport']['size'] > $maxsize){
//		$message="Passport Size Must not exceed 30kb";
//	}elseif($_REQUEST["passport2"]=="" && $_FILES['passport']['name']==""){
//		$message="There is no Passport file";
//	}elseif(sizeof($_REQUEST["refname"])<2 || sizeof($_REQUEST["refemail"])<2){
//		$message="Referees are compulsory";
//	}else{
//		$lg=$_REQUEST["state"];
//		$state=getStateName($_REQUEST["country"]);
//		$mpfaculty=getFacultyName($_REQUEST['faculty']);
//		if($_FILES['passport']['name'] !=""){
//			$pix_id=$user;
//			$pix_id .=".jpg";
//			$target = "pass/";
//			$target = $target . $pix_id;
//			move_uploaded_file($_FILES['passport']['tmp_name'], $target);
//		}else{
//			$pix_id=$_REQUEST["passport2"];
//		}
		$regno=$_REQUEST['regno'];
		$basic=array($regno,$_REQUEST['surname'],$_REQUEST['onames'],$_REQUEST['compL'],$_REQUEST['owncomp'],$_REQUEST['socialmd'],$_REQUEST['socialmdplat'],$_REQUEST["sporting"],$_REQUEST["sportchoice"],$_REQUEST['healthchl'],$_REQUEST['hclans'],$_REQUEST['diability'],$_REQUEST["disans"],$_REQUEST["others"]);
		//echo $sql;
		
			if(input2($basic,"other_info")){
				$message="Record Successfully Submited, Continue with >Admissiomn Record Printing</a>]";
				$refno=0;
				
		
	}
}elseif(isset($_REQUEST['update'])){
	$message="Asteriks (*) Fields are Compulsory";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OTHER - SCHOOL OF POSTGRADUATE::University of Medical Sciences, Ondo</title>
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
          <h2>Other Information Page</h2>
        </div>
        <!--
<div class="text-center"><button type="submit" name="update">Print Admission Letter</button></div>
-->
   <div class="btn-toolbar">

<center><a href='adminletter.php'target="_blank"><button class='btn btn-primary btn-sm' style='float:center; '>Print Admission Letter</button></a></center>

<center><a href='spgs_counselingform.php 'target="_blank"><button class='btn btn-info btn-sm' style='float:center; '>Print Student's Counseling Form</button></a></center>
<center><a href='spgs_libraryform.php'target="_blank"><button class='btn btn-success btn-sm' style='float:center; '>Print Library Form</button></a></center>
<center><a href='spgs_clearanceform.php 'target="_blank"><button class='btn btn-warning btn-sm' style='float:center; '>Print Student's Admission Clearnace Form</button></a></center>
<center><a href='#'target="_blank"><button class='btn btn-danger btn-sm' style='float:center; '>Print Student's Health Centre Form</button></a></center>
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
				$rec=getRecs("spgs_basicinfo","regno",$user);
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
                  <input type="text" class="form-control" name="surname" id="surname" value="'.$rec['surname'].'" placeholder="YOUR SURNAME" readonly>
                </div>
				<div class="col-lg-3 form-group">
					<label for="onames">OTHER NAME(S).:</label>
                  <input type="text" class="form-control" value="'.$rec['onames'].'" name="onames" id="onames" placeholder="YES/NO" readonly>
                </div>
				<div class="col-lg-3 form-group">
					<label for="compL"> ARE YOU A COMPUTER LITERATE.:</label>
                  <input type="text" class="form-control" value="'.$rec1['compL'].'" name="compL" id="compL" placeholder="YES/NO" required>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-3 form-group">
					<label for="owncomp">DO YOU OWN A COMPUTER.:</label>
                  <input type="text" name="owncomp" class="form-control" id="dob" value="'.$rec1['owncomp'].'" placeholder="YES/NO" required>
                </div>
                
				<div class="col-lg-3 form-group">
					<label for="socialmd"> DO YOU USE SOCIAL MEDIA.:</label>
                  <input type="text" class="form-control" value="'.$rec1['socialmd'].'" name="socialmd" id="onames" placeholder="YES/NO" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="socialmdplat">IF YES, STATE HERE:</label>
                  <input type="text" class="form-control" value="'.$rec1['socialmdplat'].'" name="socialmdplat" id="onames" placeholder="STATE YOUR SOCIAL MEDIA" required>
                </div>
             
			  <div class="col-lg-3 form-group">
					<label for="sporting"> ARE YOU SKILLED IN ANY SPORTING EVENT?:.:</label>
                  <input type="text" class="form-control" value="'.$rec1['sporting'].'" name="sporting" id="onames" placeholder="YES/NO" required>
                </div>
                <div class="col-lg-3 form-group">
					<label for="sportchoice"> IF YES STATE HERE?:.:</label>
                  <input type="text" class="form-control" value="'.$rec1['sportchoice'].'" name="sportchoice" id="onames" placeholder="YES/NO" required>
                </div>
                <div class="col-lg-3 form-group">
					<label for="healthchl"> DO YOU HAVE ANY HEALTH CHALLENGE?:</label>
                  <input type="text" name="healthchl" class="form-control" id="email" value="'.$rec1['healthchl'].'" placeholder="YES/NO" required>
                </div>
                
				<div class="col-lg-3 form-group">
					<label for="hcans">IF YES, STATE HERE:</label>
                  	<input type="text" class="form-control" name="hclans" id="phone" value="'.$rec1['hclans'].'" placeholder="State Here:" required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="diability"> DO YOU HAVE ANY DISABILITY:</label>
                  <input type="text" class="form-control" value="'.$rec1['diability'].'" name="diability" id="onames" placeholder="YES/NO" required>
                </div>
            <div class="col-lg-3 form-group">
					<label for="disans">IF YES, STATE HERE:</label>
                  <input type="text" class="form-control" value="'.$rec1['disans'].'"  name="disans" id="onames" placeholder="" required>
                </div>
              <div class="form-group">
				<label for="others">ANY OTHER INFORMATION YOU THINK WOULD BE USEFUL FOR THE UNIVER SITY TO KNOW ABOUT YOU:</label>
                <input type="text" class="form-control" name="others" id="address" value="'.$rec1['others'].'" placeholder="OTHER INFORMATION" required>
              </div>
              
			  <div class="row">
				<div class="col-lg-3 form-group">
		
                </div>
    
              ';
			?>
              <div class="text-center"><button type="submit" name="update" onclick="return confirm('Kindly review your record, Are you sure you want to Submit?')">Submit Other Information</button></div>
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