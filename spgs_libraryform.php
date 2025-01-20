<?php
	session_start();
	error_reporting(0);
	include_once("fun.inc.php");
	if(!isset($_SESSION['spgs_auth'])){
		header("location: spgslogin.php");
	}elseif(searchRecord("admitted_2022","regno",$_SESSION['spgs_auth'][1])==0 || searchRecord("admitted_2022","regno",$_SESSION['spgs_auth'][1])==0){
		header("location: $_SERVER[HTTP_REFERER]");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}
	$brec=getRecs("admitted_2022","regno",$user);
	$date=getRecs("spgs_basicinfo" ,"regno",$user);
	$arec=getRecs("spgs_acad_rec","regno",$user);
	
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
	}
	
	#waterMark{
	position:absolute;
	z-index:-10;
	top:25%;
	left:25%;
	width:405px;
	height:562px;
	
}

</style>
<title>2021/2022 SCHOOL OF POSTGRADUATE STUDIES: <?php echo $user; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="include/style.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <script src="include/jquery-1.7.2.min.js"></script>
        <script src="include/barcode.js"></script>
</head>

<body bgcolor="#ffffff" class="<?php echo $code; ?>">
<?php
$default_value = array();
$default_value['filetype'] = 'PNG';
$default_value['dpi'] = 300;
$default_value['scale'] = isset($defaultScale) ? $defaultScale : 1;
$default_value['rotation'] = 0;
$default_value['font_family'] = 'Arial.ttf';
$default_value['font_size'] = 10;
$default_value['text'] = strtoupper($brec[1]);
$default_value['a1'] = '';
$default_value['a2'] = '';
$default_value['a3'] = '';

$filetype = $default_value['filetype'];
$dpi = $default_value['dpi'];
$scale = $default_value['scale'];
$rotation = $default_value['rotation'];
$font_family = $default_value['font_family'];
$font_size = $default_value['font_size'];
$text = isset($_POST['text']) ? $_POST['text'] : $default_value['text'];

registerImageKey('filetype', $filetype);
registerImageKey('dpi', $dpi);
registerImageKey('scale', $scale);
registerImageKey('rotation', $rotation);
registerImageKey('font_family', $font_family);
registerImageKey('font_size', $font_size);
registerImageKey('text', stripslashes($text));

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

<img width=120px; height=120px; src="<?php echo 'pass/'.$brec[13]; ?>" />

</div>

<center>
<table width="95%" >
	<?php
	echo
	'<tr>
			<td align="center" colspan="6">
				<span style="font-size:21px;font-weight:bold;">UNIVERSITY LIBRARY</span><br /><br />
				<span style="font-size:19px;font-weight:bold;">UNIVERSITY OF MEDICAL SCIENCES</span><br /><br />
				<span style="font-size:17px;font-weight:bold;">ONDO, NIGERIA </span><br /><br />
					<img src="images/logo.jpg" width="100" align="bottom"/><br />
					<br />
						<p style="font-size:14px;font-weight:bold; padding-top:2px;">STUDENT\'S REGISTRATION FORM '.$brec['session'].' ACADEMIC SESSION</p><br />
			</td>
		</tr>';
	/*$date=date('Y-m-d');
	if(substr($date, 5, 2)>=substr($brec[5], 5, 2) && substr($date, 8, 2)>substr($brec[5], 8, 2)){
		$agerec=$date-$brec[5];
	}else{
		$agerec=$date-$brec[5]-1;
	}*/
	 $dob=$brec['dob'];
   // $agerec = (date('Y') - date('Y',strtotime($dob)));
	//$_age = floor((time() - strtotime('1986-09-16')) / 31556926);
	 $agerec = intval(date('Y', time() - strtotime($dob))) - 1970;
    //echo $diff;
   
			echo "<tr>";
				echo '<td colspan="6" align="left"> <div style="line-height:1.8em;">';
					echo '<table align="center" width="100%">';
						echo '<tr>
						
						<td align="left" width="25%"><b>1 &nbsp;APPLICATION NO.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['regno'].'</td> 
								<td align="left" width="24%"><b>&nbsp;</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>2 &nbsp;Surname:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['surname'].'</td> 
								<td align="left" width="24%"><b>Other Name(s).:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['onames'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>3 &nbsp;SEX.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.gender($brec['sex']).'</td>
								<td align="left" width="24%"><b>&nbsp;</b></td>				 
								<td align="left" width="24%">&nbsp;</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>4 &nbsp;DATE OF BIRTH.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$date['dob'].'</td> 
								
							</tr>';
							echo '<tr>
								
								<td align="left" width="25%"><b>5 &nbsp;PERMANENT ADDRESS.:</b></td>
								<td align="left" colspan="4" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['address'].'</td> 
							</tr>';
							
							echo '<tr>
								<td align="left" width="25%"><b>6 &nbsp;MARITAL STATUS:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.gender($brec['maritalstatus']).'</td> 
								<td align="left" width="24%"><b>TELEPHONE NUMBER.:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['phoneno'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>7 &nbsp;E-MAIL ADDRESS.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['email'].'</td> 
								<td align="left" width="24%"><b>NATIONALITY:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['nationality'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>8 &nbsp;STATE OF ORIGIN:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['state'].'</td> 
								<td align="left" width="25%"><b>LOCAL GOVT.:</b></td>				 
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['lg'].'</td>
							</tr>';
							
							echo '<tr>
								<td align="left" width="25%"><b>9 &nbsp;COURSE OF STUDY:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['dept'].'</td> 
								<td align="left" width="24%"><b>DEGREE IN VIEW:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['programme'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>10 &nbsp;SCHOOL:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['faculty'].'</td> 
								<td align="left" width="24%"><b>PROGRAMME:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['title'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>11 &nbsp;NEXT OF KIN:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['noksurname'].'</td> 
								<td align="left" width="25%"><b>NEXT OF KIN OTHER NAMES.:</b></td>				 
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['nokoname'].'</td>
							</tr>';
							
							echo '<tr>
							<td align="left" width="25%"><b>12 &nbsp;NOK TELEPHONE:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['noktel'].'</td> 
								<td align="left" width="25%"><b>NOK EMAIL.:</b></td>				 
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['nokemail'].'</td>
							</tr>';
						
							echo '<tr>
								<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>				 
									<td align="left" width="25%"><b>&nbsp;</b></td>
							</tr>';
							
					
							echo '<tr>			 
								<td align="left" width="100%" colspan="5" style="padding:2px 0px;">&nbsp;</td>
							</tr>';
							echo '<tr>
								<td style="text-align:justify;" colspan="6" width="100%">Kindly admit me as a user of the University Library. I shall abide by all the rules and regulations governing the use of the University Library</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>				 
									<td align="left" width="25%"><b>&nbsp;</b></td>
							</tr>';
							echo '<tr>
								
								<td align="left" width="48%" colspan="2" style="border-bottom:#000000 dotted 1px;"><b>SIGNED.:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td width="2%">&nbsp;</td>
								<td align="left" width="48%" colspan="2" style="border-bottom:#000000 dotted 1px;">&nbsp;<b>DATE.:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
