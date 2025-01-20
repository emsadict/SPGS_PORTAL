<?php
  session_start();
  error_reporting(0);

error_reporting(0);
  include_once("fun.inc.php");
  if(!isset($_SESSION['spgs_auth'])){
    header("location: spgslogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CARRY-OVER COURSE REGISTRATION PORTAL::University of Medical Sciences, Ondo</title>
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
  url: "get_dept.php",
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
      <?php require('adm_nav_portal.inc.php'); ?>
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>CARRY-OVER COURSE REGISTRATION PORTAL</h2>
        </div>
        <div class="row" align="center" style="text-align: center;">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300" align="center">



<form action="carry_over_reg.php" target="_BLANK" method="post" name="formcheck" onsubmit="return formCheck(this);" role="form" class="php-email-form">
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
              <div class="row text-center">
                <div class="col-lg-12 form-group">
					<label for="session">Session</label>
                  <select class="form-control" required name="session" id="session">
                      <option value="">--SELECT--</option>
                      <option value="2021/2022">2021/2022</option>
                      <option value="2022/2023">2022/2023</option>
                      
                 <!--     <option selected>'.$prog.'</option> -->
                  </select>
                </div>
              </div>
              <!-- 
			  <div class="row text-center">
                <div class="col-lg-12 form-group">
					<label for="level">Level/Programme</label>
                  <select class="form-control" required name="level" id="level">
                      <option value="">--SELECT--</option>
                      <option value="700">700</option>
                      <option value="800">800</option>
                      <option value="Mphil">Mphil</option>
                      <option value="Mphil/PhD">Mphil/PhD</option>
                      <option value="900">900</option>
              <!--       <option selected>'.$prog.'</option> 
            </select>
                </div>
              </div>
-->
         <div class="col-lg-12 form-group">
          <label for="semester">Semester</label>
          <select class="form-control" required name="semester" id="semester">
            <option value="">--SELECT--</option>
            <option value="FIRST">FIRST</option>
            <option value="SECOND">SECOND</option>
    <!--        <option selected>'.$prog.'</option>  -->
          </select>

</br>
              <div class="text-center"><button type="submit" name="checkresult" onclick="return confirm('Kindly review your record, Are you sure you want to Submit?')">SUBMIT</button></div>
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