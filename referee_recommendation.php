<?php
	error_reporting(0);
	include_once("fun.inc.php");
	$rec1=getRecs("spgs_basicinfo","regno",$_REQUEST['regid']);
if(isset($_REQUEST['recommend'])){
		$basic=array($_REQUEST['regid'],$_REQUEST['period'],$_REQUEST['relationship'],$_REQUEST['intel'],$_REQUEST['istudy'],$_REQUEST['leadership'],$_REQUEST['english'],$_REQUEST["otherinfo"],$_REQUEST["remail"]);
		//echo $sql;
		
			if(input2($basic,"spgs_recommendation")){
				$message="Recommendation Successfully Submited";
				resultnew("COMMIT");
			}else{ 
				resultnew("ROLLBACK");
				$message="Record Update failed, try again";
			}
		
}elseif(isset($_REQUEST['recommend'])){
	$message="Asteriks (*) Fields are Compulsory";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>REFEREE'S RECOMMENDATION - SCHOOL OF POSTGRADUATE::University of Medical Sciences, Ondo</title>
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
	$.ajax({
	type: "POST",
	url: "get_dept_spgs.php",
	data:'faculty_id='+val,
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

      <?php require('nav.inc.php'); ?>
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Referee Recommendation Page</h2>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <form action="<?php echo $_SERVER['PHP_SELF']."?regid=".$_REQUEST['regid']."&id=".$_REQUEST['id']; ?>" enctype="multipart/form-data" method="post" name="formcheck" onsubmit="return formCheck(this);" role="form" class="php-email-form">
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
				$token=$_REQUEST['regid'].$_REQUEST['id'];
				$token=md5($token);
				$refdata=getRecs("spgs_referees","vtoken",$token);
				$current_date=date('Y-m-d');
				$refrecommend=getRecs2("spgs_recommendation",array('regno'=>$_REQUEST['regid'],'email'=>$refdata['email']),0,1);
				$rec=getRecs("spgs_basicinfo","regno",$_REQUEST['regid']);
				if($refdata==0){
					echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">
							Referee\'s Verification/Identification failed, try again please.
						  </div>';
				}elseif($refrecommend!=0){
					echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">
							Thank you for Submitting your Recommendation in respect of the candidate - '.$rec['surname'].' '.$rec['onames'].'.
						  </div>';
				}elseif($rec==0){
					echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">Record does not exist for the given parameter(s)
						  </div>';
				}elseif($refdata!=0 && $current_date > $refdata['duedate']){
					echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">The recommendation validity period has elapsed. Thank you!
						  </div>';
				}else{
				echo '
              <div class="row">
                <div class="col-lg-3 form-group">
					<label for="regno">APPLICATION NO.:</label>
                  <input type="text" name="regno"  value="'.$rec['regno'].'" class="form-control" id="regno" placeholder="APPLICATION NO" readonly required>
				  <input type="hidden" name="remail" value="'.$refdata['email'].'" />
                </div>
                <div class="col-lg-3 form-group">
					<label for="surname">SURNAME.:</label>
                  <input type="text" class="form-control" name="surname" id="surname" value="'.$rec['surname'].'" placeholder="CANDIDATE SURNAME" readonly required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="onames">OTHER NAME(S).:</label>
                  <input type="text" class="form-control" value="'.$rec['onames'].'" name="onames" id="onames" placeholder="CANDIDATE OTHER NAME(S)" readonly required>
                </div>
				<div class="col-lg-3 form-group">
					<label for="title">PROGRAMME TYPE.:</label>
                  <input type="text" class="form-control" value="'.$rec['title'].'" name="title" id="title" placeholder="PROGRAMME TYPE" readonly required>
                </div>
              </div>';
			?>
			  <div class="row">
                <div class="col-lg-6 form-group">
					<label for="period">HOW LONG HAVE YOU KNOWN THE CANDIDATE.:</label>
					<select name="period" class="form-control" id="period" required>
				  	<option>1-5 Years</option>
					<option>5-10 Years</option>
					<option>More than 10 Years</option>
				  </select>
                </div>
				<div class="col-lg-6 form-group">
					<label for="relationship">IN WHAT CAPACITY.:</label>
                  <select name="relationship" class="form-control" id="relationship" required>
				  	<option>Supervisor</option>
					<option>Lecturer/Teacher</option>
					<option>Co-Staff</option>
					<option>Others</option>
				  </select>
                </div>
              </div>
			  <div class="form-group" style="text-align: center; font-weight: bold;">
				  <br />
				RATE THE CANDIDATE ON THE FOLLOWING:
              </div>
			  <div class="row">
                <div class="col-lg-6 form-group">
					<label for="intel">INTELLIGENCE.:</label>
					<select name="intel" class="form-control" id="intel" required>
						<option value="">--SELECT--</option>
						<option>High</option>
						<option>Medium</option>
						<option>Low</option>
				  </select>
                </div>
				<div class="col-lg-6 form-group">
					<label for="istudy">ABILITY TO CARRY OUT INDEPENDENT STUDY.:</label>
					<select name="istudy" class="form-control" id="istudy" required>
						<option value="">--SELECT--</option>
						<option>High</option>
						<option>Medium</option>
						<option>Low</option>
				  </select>
                </div>
              </div>
			  <div class="row">
                <div class="col-lg-6 form-group">
					<label for="leadership">LEADERSHIP ABILITY.:</label>
					<select name="leadership" class="form-control" id="leadership" required>
						<option value="">--SELECT--</option>
						<option>High</option>
						<option>Medium</option>
						<option>Low</option>
				  </select>
                </div>
				<div class="col-lg-6 form-group">
					<label for="english">ORAL / WRITTEN ENGLISH.:</label>
					<select name="english" class="form-control" id="english" required>
						<option value="">--SELECT--</option>
						<option>High</option>
						<option>Medium</option>
						<option>Low</option>
				  </select>
                </div>
              </div>
			  <div class="form-group">
                <textarea class="form-control" name="otherinfo" rows="5" placeholder="Freely comment on this candidate (maximum of 75 words)" ></textarea>
              </div>
              <div class="text-center"><button type="submit" name="recommend" onclick="return confirm('Kindly review the Information, Are you sure you want to Submit?')">Submit Recommendation</button></div>
			<?php
				}
			?>
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