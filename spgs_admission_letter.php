<?php
	session_start();
	error_reporting(0);
	include_once("fun.inc.php");
	if(!isset($_SESSION['spgs_auth'])){
		header("location: spgslogin.php");
	}elseif(searchRecord("admitted_2022_2023","regno",$_SESSION['spgs_auth'][1])==0 || searchRecord("admitted_2022","regno",$_SESSION['spgs_auth'][1])==0){
		header("location: $_SERVER[HTTP_REFERER]");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}
	$brec=getRecs("admitted_2022_2023","regno",$user);
	$arec=getRecs("portal_spgs_acad_rec","regno",$user);
	$arec1=getRecs("other_info","regno",$user);
	
	
	//if($srec==0){
		//pUTMESchedule($user,$brec[15]);
	//}
define('IN_CB', true);
if (version_compare(phpversion(), '5.0.0', '>=') !== true) {
    exit('Sorry, but you have to run this script with PHP5... You currently have the version <b>' . phpversion() . '</b>.');
}

if (!function_exists('imagecreate')) {
    exit('Sorry, make sure you have the GD extension installed before running this script.');
}

include_once('include/function.php');

// FileName & Extension
$system_temp_array = explode('/', $_SERVER['PHP_SELF']);
$filename = $system_temp_array[count($system_temp_array) - 1];
$system_temp_array2 = explode('.', $filename);
$availableBarcodes = listBarcodes();
$code = $system_temp_array2[0];

// Check if the code is valid
if (file_exists('config' . DIRECTORY_SEPARATOR . $code . '.php')) {
    include_once('config' . DIRECTORY_SEPARATOR . $code . '.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
	body{
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
		width:1000px;
		align:;
		padding-left:10px;
		padding-right:10px;
		
	}
	
	#waterMark{
	position:absolute;
	z-index:-10;
	top:25%;
	left:25%;
	width:405px;
	height:562px;
	
	
	
}
#letter{
	    position:absolute;
	z-index:-10;
	top:25%;
	left:25%;
	width:405px;
	height:562px;
	}
</style>
<title>2021/2022 SCHOOL OF POSTGRADUATE SCHOOL ADMISSION LETTER: <?php echo $user; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="include/style.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <script src="include/jquery-1.7.2.min.js"></script>
        <script src="include/barcode.js"></script>
</head>

<body bgcolor="#ffffff" class="<?php echo $code; ?>">
<?php


// Text in form is different than text sent to the image
$text = convertText($text);
?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    
<?php
//define('IN_CB', true);
//include('include/header.php');

$default_value['checksum'] = '';
$checksum = isset($_POST['checksum']) ? $_POST['checksum'] : $default_value['checksum'];
registerImageKey('checksum', $checksum);
registerImageKey('code', 'BCGcode39');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '-', '.', '&nbsp;', '$', '/', '+', '%');
?>

<?php
//include('include/footer.php');
?>
<?php
if (!defined('IN_CB')) { die('You are not allowed to access to this page.'); }
?>

<div id="waterMark"><img src="images/bglogo.jpg" width="400" height="553"></div>

<div style="position:absolute; overflow:hidden; left:82%; top:100px; z-index:18; border: 1px solid #000000;">



</div>

<center>
<table width="95%" >
	<?php
	echo
	'<tr>
			<td align="center" colspan="6">
				<span style="font-size:21px;font-weight:bold;"> UNIVERSITY OF MEDICAL SCIENCES, ONDO CITY, ONDO STATE</span><br /><br />
				<span style="font-size:19px;font-weight:bold;">POSTGRADUATE SCHOOL</span><br /><br />
			
			
					<img src="images/logo.jpg" width="50" align="bottom"/><br />
					<br />
					<hr>
			
		</tr>';
	
			echo "<tr>";
				echo '<td colspan="6" align="left"> <div style="line-height:1.8em;">';
				echo '<tr style="align:center;" align="center" colspan="4">
		
		
							<td  width="25%"><b>&nbsp;</b></td>
								<td align="center" width="100%" colspan="2"><b> OFFER OF PROVISIONAL ADMISSION INTO THE &nbsp'.$brec['title'].' PROGRAMME (2022/2023 ACADEMIC SESSION)</b></td>				 
							     </br>
							</tr>';
					echo '<table align="center" width="100%">';
					
						
		echo '<tr>
<div id="letter">
		<td align="left" width="80%" style="border-solid:#000000 dotted 1px;">
<With reference to your application for admission into the <b>'.$brec['programme'].'</b> Programme in the 
		University of Medical Sciences, Ondo, it is my pleasure to inform you that you have 
		been offered provisional admission to pursue an academic programme leading to the 
		award of <b>'.$brec['programme'].' in '.$brec['dept'].' </b>with effect from the 2022/2023 Academic Session.</br></br>

<p>Please take note of the following conditions, which are related to your admission and registration:</br>
(1)	This offer of admission is strictly provisional and may be revoked if: </br>
(a) you fail to formally accept this offer by paying the acceptance fee of eighty thousand naira 	(N80,000.00) only, on or before the 19th October, 2022.</br>
(b) school fee of two hundred and eighty-two thousand naira only 	(N282,000.00) and       	other charges before the deadline for payment. All payments MUST be 	made online through 	www.unimed.edu.ng 
(c) you are unable to satisfy the necessary requirements for admission and registration. 
(d) you cannot produce at the time of registration, the original copies of your O’ level certificate and 	other academic credentials. 
(e) First semester commences on 12th October, 2022 
(2) The programme is on Full-Time basis. The duration of your course is three (3) semesters and other conditions relating to it, are as contained in the Postgraduate School’s prospectus.
(3) If you accept this offer, please comply with the following procedure for registration: 
(a) 	Payment of all fees must be made before 30th October, 2022 for payment as provisional offer of admission will lapse thereafter. 
(b)	It is mandatory that you appear physically for clearance at the Admissions Office of The Postgraduate School.  If within four (4) weeks from the date on this letter, you have neither completed and returned the printed acceptance forms nor submitted the originals of your credentials for clearance, this offer will be revoked and your slot given to someone else.
PLEASE NOTE THAT IF IT IS DISCOVERED AT ANY POINT THAT YOU DO NOT POSSESS ANY OF THE QUALIFICATIONS WHICH YOU CLAIM TO HAVE OBTAINED, OR YOU REFUSE TO SUBMIT THE TRANSCRIPT OF YOUR FIRST DEGREE, THE ADMISSION WILL BE WITHDRAWN IMMEDIATELY. 
Please accept my congratulations on behalf of the University. </td> </div>
							
								
							</tr>';
							
						
					
						

		
						
	?>
								
							</div>
						</form>
								
								</td>
							</tr>
					</table></div>
				</td>
			</tr>
			

</table>
</center>

</body>
</html>
