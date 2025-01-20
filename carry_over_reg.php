<?php

	session_start();

	error_reporting(0);

     include_once("fun.inc.php");

	if(!isset($_SESSION['spgs_auth'])){

		header("location: portal_login.php");

		

	}elseif(searchRecord("Screened_Candidates_2022","regno",$_SESSION['spgs_auth'][1])==0 || searchRecord("Screened_Candidates_2022","regno",$_SESSION['spgs_auth'][1])==0){

	    echo ("<script LANGUAGE='JavaScript'>

    window.alert('You have to complete your screening');

    window.location.href='basicInfo_admitted.php';

    </script>");

		header("location: portal_login.php");

		

	//	header("location: $_SERVER[HTTP_REFERER]");

	}else{

		$spgs_auth=$_SESSION['spgs_auth'];

		$user=$spgs_auth[1];

  //      $user="SPGS86121";

	}



	$ret=getRecs("Screened_Candidates_2022","regno",$user);

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

	

//	echo "$dept";

//	echo "$level";

//	echo "$semester";

//	echo "$user";

//	echo "$session";

//	echo "";

//	$session="2021/2022";

//  $semester="SECOND";



//Load Composer's autoloader

    require 'vendor/autoload.php';

    $brec=getRecs("admitted_2022","regno",$user);

    $image=$brec['passport'];

	$dob=$brec['dob'];

    $admissionLetter=$brec['admissionletter'];

    $surname=$brec['onames'];



//    echo"Welcome:$dob";

    // echo"</br>";

     

      

     //echo "$image";

    // echo "<img src='pass/$image' height='100px' width='100px'>";

//echo "$admissionLetter";

if(isset($_REQUEST["submit"])){

	$info=array($user,$brec['faculty'],$brec['dept'],$level,$semester,$session);

    

	$cos=$_REQUEST["cos"];

	$tu=0;

	for($i=0;$i<20;$i++){

		if(array_key_exists($i,$cos)){

			$info[]=$cos[$i];

			$split=explode("|",$cos[$i]);

			$tu+=$split[2];

		}else{

			$info[]="|||";

		}

	}

    $info[]="APPROVED";



	$info[]="";

//    print_r($info);

//    exit();

	if($tu>24 && extraUnit($brec['dept'],$level,$semester,$user,$session,$tu,"REGULAR")==0){

		$message="Maximum number of Unit is exceeded";

	}elseif($user!="" && input($info,"carry_course_reg")){

		if($level==100){

			$message="Courses Successfully Submited, Continue to Print[<a href=\"spgs_coursereg_slip.php\">Out Your Course Form</a>]";

		}else{

			$message="Courses Successfully Submited, Continue to Print[<a href=\"spgs_coursereg_slip.php\">Out Your Course Form</a>]";

		}

	}else{

		$message="Error Submitting Courses, try again";

	}

}



if(isset($_REQUEST["update"])){

	$rec=array($user,$brec['faculty'],$brec['dept'],$level,$semester,$session);

	$cos=$_REQUEST["cos"];

	$tu=0;

	for($i=0;$i<20;$i++){

		if(array_key_exists($i,$cos)){

			$rec[]=$cos[$i];

			$split=explode("|",$cos[$i]);

			$tu+=$split[2];

		}else{

			$rec[]="|||";

		}

	}

	$rema=$_REQUEST["rema"];

	$remb=$_REQUEST["remb"];

	if($rema !="" && $remb!=""){

		$rem=$rema.'|'.$user.'+'.$remb;

	}elseif($remb !=""){

		$rem=$user.'+'.$remb;

	}else{

		$rem=$rema;

	}

		$app="APPROVED";



	$rem=addslashes($rem);

	$sql="UPDATE carry_course_reg SET course1='$rec[6]', course2='$rec[7]', course3='$rec[8]', course4='$rec[9]', course5='$rec[10]', course6='$rec[11]', course7='$rec[12]', course8='$rec[13]', course9='$rec[14]', course10='$rec[15]', course11='$rec[16]', course12='$rec[17]', course13='$rec[18]', course14='$rec[19]', course15='$rec[20]', course16='$rec[21]', course17='$rec[22]', course18='$rec[23]', course19='$rec[24]', course20='$rec[25]', app='$app', rem='$rem' WHERE matricno='$user' AND level='$level' AND semester='$semester' AND session='$session'";

    

	if($tu>24 && extraUnit($brec['dept'],$level,$semester,$user,$session,$tu)==0){

		$message="Maximum number of Unit is exceeded";

	}elseif(isset($sql)){

		resultnew($sql); 

		$message="Course Update Successful, Continue to [<a href=\"course_reg_Reg.php\">Print Out Your Course Form</a>]";

		resultnew("COMMIT");

	}else{ 

		resultnew("ROLLBACK");

		$message="Course Update failed, try again";	

	}

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">



  <title>COURSE REGISTRATION PAGE- SCHOOL OF POSTGRADUATE::University of Medical Sciences, Ondo</title>

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

<!-- ======= Contact Us Section 

    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">



        <div class="section-title">

          <h2>Course Registration Page</h2>

        </div>

        ======= -->

        <!--



<div class="text-center"><button type="submit" name="update">Print Admission Letter</button></div>

-->

   

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

			<?php

				//UPDPmenu($user);

			?>

            <tr style="background-color:#063958; color:#fff;">	

				<td colspan="12" align="center" style="padding:5px;"><strong>POSTGRADUATE STUDENTS COURSE REGISTRATION PAGE</strong>

                </td>

			</tr>

            <?php

				//studPrinting($user,$sess,$sem[2],5);

			?>

			

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

				if(checkIfExist($user,$semester,$level,$session)==0){

					//if($ret[22]=="RPT" && ($ret[21]=="Nursing Science" || $ret[21]=="Physiotherapy")){

		  	listCoursesNew($dept,$level,$semester,$user,1,"REGULAR");

					//}else{

					//	listCourses($ret[21],$ret[19],$sem[2]);

					//}

					echo '

					<tr style="background-color:#FFFFFF;">

				<td colspan="5" align="center"><input type="reset" class="btn btn-warning" name="reset"  value="&nbsp;Clear&nbsp;"/>&nbsp;&nbsp;

                

				<input type="submit" class="btn btn-success" name="update" onclick="return confirm(\'Kindly review your record, Are you sure you want to Submit?\')"  value="&nbsp;Submit Course Form!&nbsp;"  class="button" />				</td>

			</tr>

					';

				}else{

					listCoursesNewUp($dept,$level,$semester,$user,$session,1,"REGULAR");

				}

            ?>

			

            </form>

             

            </table>

            <div>

            <?php

            include_once("footer.inc.php");

            ?></div>

                 </td>

			</tr>

           

	</table>

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







