<?php
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
	include_once("fun.inc.php");
//	use PHPMailer\PHPMailer\PHPMailer;
//	use PHPMailer\PHPMailer\SMTP;
//	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	//Create an instance; passing `true` enables exceptions
//	$mail = new PHPMailer(true);

	if(!isset($_SESSION['spgs_auth']))
	{
		header("location: portal_login.php");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}	
	$cal = getCalendarInfo();
	//	$retinv=retInvoiceP($user,"UNIMED SPGS APPLICATION FEE",$cal[1]);
		$rec=getRecs("admitted_2022","regno",$user);
		$student_email_rec=getRecs("student_email","matricno",$user);
		$recscreen=getRecs("Screened_Candidates_2022","regno",$user);
		$sessionscreen=$recscreen['session'];
		$semscreen=$recscreen['semester'];
		$student_email=$student_email_rec['email'];
		$email_password=$student_email_rec['dfpassword'];
	//	echo $email_password;
	//	echo 
		if(searchRecord("admitted_2022","regno",$user)!=0)
		{
			$prog=$rec['programme'];
			$fac=$rec['faculty'];
			$dept=$rec['dept'];
			$title=$rec['title'];
			$admissionLetter=$rec['admissionletter'];
		    $session_start=$rec['session'];
		    $batch=$rec['batch'];
	  	    $accept_fee_due=$rec['accpt_fee_due'];
		    $stud_due_date=$rec['stud_due_date'];
		    $prog_duration=$rec['prog_duration'];
		    $all_pay_due=$rec['all_pay_due'];
		    $date_issued=$rec['date_issued'];
			/*   
			echo "$admissionLetter </br>";

		echo "$session_start</br>";
		echo "$batch</br>";
		echo "$accept_fee_due</br>";
		echo "$stud_due_date</br>";
		echo "$prog_duration</br>";
		echo "$all_pay_due</br>";
	*/		
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
			$cos=array('MPH','MScPH','MSc','MPhil');
			break;
		case "Doctorate":
			$cos=array('PhD','DrPH','DrCH','DrCH','MPhil/PhD');
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
	}
	//elseif(sizeof($_REQUEST["refname"])<2 || sizeof($_REQUEST["refemail"])<2){
	//	$message="Referees are compulsory";
    //	}
	else{
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
		$admissionLetter_id=$user;
		$admissionLetter_id.=".PDF";
		$admissionLetter=$admissionLetter_id;
		//echo "$admissionLetter";
		$batch="FIRST";
		
		$basic=array(
		$regno,
		$_REQUEST['surname'],
		$_REQUEST['onames'],
		$_REQUEST['sex'],
		$_REQUEST['dob'],
		$_REQUEST['maritalstatus'],
		$_REQUEST['nation'],
		$state,
		$lg,
		$_REQUEST["email"],
		$_REQUEST["phone"],
		addslashes($_REQUEST["address"]),
		$pix_id,
		$mpfaculty,
		$dept,
		$_REQUEST['programme'],
		$_REQUEST['title'],
		$_REQUEST["noksurname"],
		$_REQUEST["nokoname"],
		$_REQUEST["noktel"],
		$_REQUEST["nokemail"],
		$_REQUEST["nokrel"],
		$_REQUEST["nokadd"],
		$admissionLetter,
		$session_start,
		$batch,
		$accept_fee_due,
		$stud_due_date,
		$prog_duration,
		$date_issued,
		$all_pay_due);
		//echo $sql;
	//	print_r($basic);
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
		<hr>
<div class="container my-3">
  <div class="row justify-content-center">
    <div class="col-12">
      <ul class="nav nav-pills justify-content-center flex-wrap">
        <li class="nav-item m-1">
          <a class="btn btn-primary" href="#">Orientation</a>
        </li>
        <li class="nav-item m-1">
          <a class="btn btn-primary" href="#">Bursary</a>
        </li>
        <li class="nav-item m-1">
          <a class="btn btn-primary" href="biodata.php">Registry</a>
        </li>
        <li class="nav-item m-1">
          <a class="btn btn-primary" href="courseregistration.php">My Course</a>
        </li>
        <li class="nav-item m-1">
          <a class="btn btn-primary" href="https://elearning.unimed.edu.ng/" target="_blank">My Learning Space</a>
        </li>
        <li class="nav-item m-1">
          <a class="btn btn-primary" href="https://library.unimed.edu.ng" target="_blank">Library</a>
        </li>
		
        <li class="nav-item m-1">
          <a class="btn btn-primary" href="mailto:ict@unimed.edu.ng" target="_blank">Support</a>
        </li>
		<li class="nav-item m-1">
        <?php
		
		if(searchRecord("resulttable","matricno",$_SESSION['spgs_auth'][1])!=0 && searchRecord("resulttable ","matricno",$_SESSION['spgs_auth'][1])!=0){
				echo '<li><a class="btn btn-primary " href="resultChecker.php" target="_blank">Check Result</a></li>';
		}
			?>
		</li>
      </ul>
            </div>
          </div>
        </div>

</div>
<hr>
      <br><br>
      <div class="row justify-content-center">
        
        <!-- Left column (2) -->
        
		 <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="400">
  <div class="php-email-form text-center">

    <!-- Passport Photograph -->
    <div class="mb-3">
      <img src="<?php echo 'pass/'.$rec[13]; ?>" alt="Passport Photograph" class="img-fluid rounded" style="max-width:150px;">
	  
    </div>

    <?php
	$rec2=getRecs("screened_candidates_2022","regno",$user);
    echo '
      <div class="row text-start">
        <div class="col-12 mb-2">
          <b>APPLICATION NO:</b> '.$user.'
          <hr>
        </div>
        <div class="col-12 mb-2">
          <b>SURNAME:</b> '.$rec2['surname'].'
          <hr>
        </div>
        <div class="col-12 mb-2">
          OTHER NAME(S): '.$rec2['onames'].'
          <hr>
        </div>
        <div class="col-12 mb-2">
          GENDER: '.(($rec2[4]=="M" || $rec2[4]=="Male") ? "Male" : "Female").'
          <hr>
        </div>
        <div class="col-12 mb-2">
          FACULTY: '.$rec2['faculty'].'
          <hr>
        </div>
        <div class="col-12 mb-2">
          DEPARTMENT/OPTION: '.$rec2['dept'].'
          <hr>
        </div>
        <div class="col-12 mb-2">
          PROGRAMME: '.$rec2['programme'].'
          <hr>
        </div>
        <div class="col-12 mb-2">
          PROGRAMME TYPE: '.$rec2['title'].'
          <hr>
        </div>
		<div class="col-12 mb-2">
          Session: '.$rec2['session'].'
          <hr>
        </div>
		<div class="col-12 mb-2">
          SEMESTER: '.$rec2['semester'].'
          <hr>
        </div>
      </div>
    ';
    ?>
  </div>
</div>


        <!-- Middle column (6) -->
        <div class="col-lg-7 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="300">
          
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
				
				echo '
              <div class="row">
                <div class="container my-4">
  <h4 class="mb-3">Academic Calendar</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-success">
        <tr>
          <th>S/N</th>
          <th>PERIOD / ACTIVITY</th>
          <th>FROM</th>
          <th>TO</th>
        </tr>
      </thead>
      <tbody>
        <!-- 1ST SEMESTER -->
        <tr><td colspan="4" class="fw-bold text-center bg-light">1ST SEMESTER</td></tr>
        <tr><td>1</td><td>Resumption/Registration</td><td>27th October, 2025</td><td>7th November, 2025</td></tr>
        <tr><td>2</td><td>Lectures Begin</td><td>10th November, 2025</td><td></td></tr>
        <tr><td>3</td><td>Christmas Break</td><td>23rd December, 2025</td><td>5th January, 2026</td></tr>
        <tr><td>4</td><td>Late Registration</td><td>12th January, 2026</td><td>17th January, 2026</td></tr>
        <tr><td>5</td><td>End of Lectures</td><td></td><td>30th January, 2026</td></tr>
        <tr><td>6</td><td>Revision</td><td>2nd February, 2026</td><td>6th February, 2026</td></tr>
        <tr><td>7</td><td>Examinations</td><td>9th February, 2026</td><td>20th February, 2026</td></tr>
        <tr><td>8</td><td>Marking and Processing of Results</td><td>23rd February, 2026</td><td>6th March, 2026</td></tr>
        <tr><td>9</td><td>Consideration of Results by Faculties/Departmental Board</td><td>9th March, 2026</td><td>13th March, 2026</td></tr>
        <tr><td>10</td><td>PG School Discourse</td><td>12th March, 2026</td><td></td></tr>

        <!-- 2ND SEMESTER -->
        <tr><td colspan="4" class="fw-bold text-center bg-light">2ND SEMESTER</td></tr>
        <tr><td>11</td><td>Resumption/Registration</td><td>6th April, 2026</td><td>10th April, 2026</td></tr>
        <tr><td>12</td><td>Lectures</td><td>13th April, 2026</td><td>26th June, 2026</td></tr>
        <tr><td>13</td><td>PG School Colloquium</td><td>20th April, 2026</td><td></td></tr>
        <tr><td>14</td><td>Revision</td><td>29th June, 2026</td><td>3rd July, 2026</td></tr>
        <tr><td>15</td><td>Examinations</td><td>6th July, 2026</td><td>17th July, 2026</td></tr>
        <tr><td>16</td><td>Marking and Processing of Results</td><td>20th July, 2026</td><td>31st July, 2026</td></tr>
        <tr><td>17</td><td>Consideration of Results by Faculties/Departmental Board</td><td>3rd August, 2026</td><td>7th August, 2026</td></tr>
        <tr><td>18</td><td>Constitution of UNIMED PG Alumni</td><td>6th August, 2026</td><td></td></tr>

        <!-- 3RD SEMESTER -->
        <tr><td colspan="4" class="fw-bold text-center bg-light">3RD SEMESTER (For Depts. running three Semesters/year Masters programme)</td></tr>
        <tr><td>19</td><td>Resumption/Registration</td><td>24th August, 2026</td><td>4th September, 2026</td></tr>
        <tr><td>20</td><td>Lectures</td><td>7th September, 2026</td><td>13th November, 2026</td></tr>
        <tr><td>21</td><td>Examinations</td><td>16th November, 2026</td><td>27th November, 2026</td></tr>
        <tr><td>22</td><td>Marking and Processing of Results</td><td>30th November, 2026</td><td>4th December, 2026</td></tr>
        <tr><td>23</td><td>Consideration of Results by Faculties/Departmental Board</td><td>7th December, 2026</td><td>11th December, 2026</td></tr>
      </tbody>
    </table>
  </div>

  <p class="mt-3"><em>Note: For Departments running 18 months Masters programme, their 3rd semester is the 1st semester of 2026/2027 academic session, starting November 2026.</em></p>
</div>

				
				
              </div>';
			?>
            <!--  <div class="text-center"><button type="submit" name="update" onclick="return confirm('Kindly review your record, Are you sure you want to Submit?')">Update Biodata</button>
			</div>  -->
            </form>
          
        </div>

        <!-- Right column (2) -->
<div class="col-lg-2 col-md-4 col-sm-12" data-aos="fade-up" data-aos-delay="200">
          <div class="php-email-form  d-flex flex-column p-3 border rounded shadow-sm">
            <div class="flex-grow-1 d-flex flex-column justify-content-center">
            
			   <div class="btn-toolbar d-flex flex-column gap-2 justify-content-center align-items-center">
<?php
$recscreen = getRecs("Screened_Candidates_2022","regno",$user);
$sessionscreen = $recscreen['session'];
$semscreen = $recscreen['semester'];

//echo $sessionscreen;

if ($sessionscreen == '2025/2026' && $semscreen == 'FIRST') {
echo '<a href="admnletter_controller.php" target="_blank" class="btn btn-primary btn-sm w-100 mb-1">Print Admission Letter</a>';
    echo '<a href="spgs_counselingform.php" target="_blank" class="btn btn-info btn-sm w-100 mb-1">Print Students Counseling Form</a>';
    echo '<a href="spgs_libraryform.php" target="_blank" class="btn btn-primary btn-sm w-100 mb-1">Print Library Form</a>';
    echo '<a href="spgs_clearanceform.php" target="_blank" class="btn btn-info btn-sm w-100 mb-1">Print Students Admission Clearance Form</a>'; 
}
?>


<?php
$rec=getRecs("Screened_Candidates_2022","regno",$user);
$semester=$rec['semester'];
$semester =strtoupper("$semester");
//echo $semester ;
if ($semester=='SECOND' || $semester=='THRID')
echo "<a href='student_forms.php' target='_blank' class='btn btn-primary btn-sm w-100'>Student Form</a>";


?>

<div class="section-title text-center mt-3">
	<hr class="w-75 mx-auto">
  
  <h6 class="text-danger mb-0">
    <?php  
    // Run query
	$rec=getRecs("Screened_Candidates_2022","regno",$user);
	$regno = $recscreen['regno'];
    $result = resultnew("SELECT * FROM student_email WHERE regno='$regno'");
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $student_email  = !empty($row['email']) ? $row['email'] : 'N/A';
        $email_password = !empty($row['dfpassword']) ? $row['dfpassword'] : 'N/A';

        echo "Email is: $student_email <br>";  
        echo "default Password is: $email_password";  
    } else {
        echo "email is: N/A <br>";  
        echo "default Password is: N/A";  
    }
    ?>
  </h6>
  <hr>
  <?php  
    // Run query
    $result1 = resultnew("SELECT * FROM student_internetlogin   WHERE regno='$regno'");
    
    if (mysqli_num_rows($result1) > 0) {
        $row1 = mysqli_fetch_assoc($result1);
        $student_email1  = !empty($row1['username']) ? $row1['username'] : 'N/A';
        $email_password1 = !empty($row1['password']) ? $row1['password'] : 'N/A';

        echo "Your student internet login is: $student_email1 <br>";  
        echo "Your Password is: $email_password1";  
    } else {
        echo "Your student internet login is: N/A <br>";  
        echo "Your Password is: N/A";  
    }
    ?>
</div>

          </div>
        </div>



      </div>
    </div>
  </section><!-- End Contact Us Section -->

</main>
<!-- End #main -->

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