<?php
	session_start();
	error_reporting(0);
	include_once("fun.inc.php");
	if(!isset($_SESSION['spgs_auth'])){
		header("location: spgslogin.php");
	}elseif(searchRecord("spgs_basicinfo","regno",$_SESSION['spgs_auth'][1])==0 || searchRecord("spgs_basicinfo","regno",$_SESSION['spgs_auth'][1])==0){
		header("location: $_SERVER[HTTP_REFERER]");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}
	$brec=getRecs("spgs_basicinfo","regno",$user);
	$arec=getRecs("spgs_acad_rec","regno",$user);
	$programme=$brec['programme'];
	
	//if($srec==0){
		//pUTMESchedule($user,$brec[15]);
	//}
define('IN_CB', true);
if (version_compare(phpversion(), '5.0.0', '>=') !== true) {
    exit('Sorry, but you have to run this script with PHP5... You currently have the version <b>' . phpversion() . '</b>.');
}

/*
if (!function_exists('imagecreate')) {
    exit('Sorry, make sure you have the GD extension installed before running this script.');
}
*/
include_once('include/function.php');

// FileName & Extension
$system_temp_array = explode('/', $_SERVER['PHP_SELF']);
$filename = $system_temp_array[count($system_temp_array) - 1];
$system_temp_array2 = explode('.', $filename);
$availableBarcodes = listBarcodes();
$barcodeName = findValueFromKey($availableBarcodes, $filename);
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
<title>2023/2024 SCHOOL OF POSTGRADUATE STUDIES: <?php echo $user; ?></title>
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
				<span style="font-size:21px;font-weight:bold;">SCHOOL OF POSTGRADUATE STUDIES</span><br /><br />
				<span style="font-size:19px;font-weight:bold;">UNIVERSITY OF MEDICAL SCIENCES</span><br /><br />
				<span style="font-size:17px;font-weight:bold;">ONDO, NIGERIA </span><br /><br />
					<img src="images/logo.jpg" width="100" align="bottom"/><br />
					<br />
						<p style="font-size:14px;font-weight:bold; padding-top:10px;">2024/2025 APPLICATION SLIP</p><br />
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
								<td align="left" width="25%"><b>APPLICATION NO.:</b></td>
								<td align="left" colspan="4" width="75%" style="border-bottom:#000000 dotted 1px; font-size:14px;">'.$user.'</td> 
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>NAME.:</b></td>
								<td align="left" colspan="4" width="75%" style="border-bottom:#000000 dotted 1px; font-size:14px;">'.$brec['surname'].', '.$brec['onames'].'</td> 
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>SEX.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.gender($brec['sex']).'</td> 
								<td width="2%">&nbsp;</td>
								<td align="left" width="24%"><b>MARITAL STATUS.:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['maritalstatus'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>DATE OF BIRTH.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['dob'].'</td> 
								<td width="2%">&nbsp;</td>
								<td align="left" width="24%"><b>AGE.:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$agerec.'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>E-MAIL ADDRESS.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['email'].'</td> 
								<td width="2%">&nbsp;</td>
								<td align="left" width="25%"><b>TELEPHONE.:</b></td>				 
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['phoneno'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>ADDRESS.:</b></td>
								<td align="left" colspan="4" width="75%" style="border-bottom:#000000 dotted 1px;">'.$brec['address'].'</td> 
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>FACULTY.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['faculty'].'</td>';

								echo '<tr>
								<td align="left" width="25%"><b>DEPARTMENT.:</b></td>				 
								<td align="left" colspan="4"width="75%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['dept'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>PROGRAMME.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['programme'].'</td> 
								<td width="2%">&nbsp;</td>
								<td align="left" width="24%"><b>PROGRAMME TYPE.:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['title'].'</td>
							</tr>';
							


							echo '<tr>
								<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>				 
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
							</tr>';
							echo '<tr style="align:center;" align="center" colspan="4">
							<td  width="25%"><b>&nbsp;</b></td>
								<td align="center" width="100%" colspan="2"><b> O\'LEVEL INFORMATION</b></td>				 
							     
							</tr>';

							echo '<tr >
							
								<td align="right" width="25%"><b> &nbsp;FIRST SITTING:</b></td>
							<td  width="25%"><b>&nbsp;</b></td>
								<td align="right" width="24%"><b>SECOND SITTING</b></td>	
									<td align="right" width="25%"><b>&nbsp;</b></td>
								
							</tr>';
							echo '<tr>
								<td align="right" width="25%"><b> &nbsp;EXAM NUMBER:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$arec['first_no'].'</td> 
								<td align="right" width="10%"><b>EXAM NUMBER:</b></td>				 
								<td align="left" width="34%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$arec['sec_no'].'</td>
							</tr>';
							echo '<tr>
								<td align="right" width="25%"><b> &nbsp;EXAM DATE:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$arec['first_date'].'</td> 
								<td align="right" width="10%"><b>EXAM DATE:</b></td>				 
								<td align="left" width="34%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$arec['sec_date'].'</td>
							</tr>';
								echo '<tr>
								<td align="right" width="25%"><b>&nbsp;EXAM TYPE:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['first_type'].'</td> 
								<td align="right" width="24%"><b>EXAM TYPE:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$arec['sec_type'].'</td>
							</tr>';
					
					
						echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub1']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub1']).'</td> 
								<td align="right" width="15%" >'.subtitle($arec['second_sub1']).':</td> 				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub1']).'</td>
							</tr>';
							
							echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub2']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub2']).'</td> 
								<td align="right" width="15%" >'.subtitle($arec['second_sub2']).':</td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub2']).'</td>
							</tr>';
							
							echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub3']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub3']).'</td> 
								<td align="right" width="24%"><b>'.subtitle($arec['second_sub3']).':</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub3']).'</td>
							</tr>';
							
							echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub4']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub4']).'</td> 
								<td align="right" width="24%"><b>'.subtitle($arec['second_sub4']).':</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub4']).'</td>
							</tr>';
							echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub5']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub5']).'</td> 
								<td align="right" width="24%"><b>&nbsp;'.subtitle($arec['second_sub5']).':</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub5']).'</td>
							</tr>';
							echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub6']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub6']).'</td> 
								<td align="right" width="24%"><b>&nbsp;'.subtitle($arec['second_sub6']).':</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub6']).'</td>
							</tr>';
							echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub7']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub7']).'</td> 
								<td align="right" width="24%"><b>&nbsp;'.subtitle($arec['second_sub7']).':</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub7']).'</td>
							</tr>';
					echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub8']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub8']).'</td> 
								<td align="right" width="24%"><b>&nbsp;'.subtitle($arec['second_sub8']).':</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub8']).'</td>
							</tr>';
							echo '<tr>
								<td align="right" width="15%" >'.subtitle($arec['first_sub9']).':</td> 
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.subgrd($arec['first_sub9']).'</td> 
								<td align="right" width="24%"><b>&nbsp;'.subtitle($arec['second_sub9']).':</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.subgrd($arec['second_sub9']).'</td>
							</tr>';
							

echo '<tr style="align:center;" align="center" colspan="4">
		
							<td  width="25%"><b>&nbsp;</b></td>
								<td align="center" width="100%" colspan="2"><b> FOR &nbsp; '.strtoupper($brec['title']).' &nbsp;APPLICANTS </b></td>				 
							     
							</tr>';
							echo '<tr >
							
								<td align="right" width="25%"><b> &nbsp;FIRST DEGREE INFORMATION:</b></td>
							<td  width="25%"><b>&nbsp;</b></td>
									
								
							</tr>';
							echo '<tr>
								<td align="right" width="25%"><b> &nbsp;FULL NAME:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$arec['dedeg1'].'</td> 
							
							</tr>';
							echo '<tr>
								<td align="right" width="25%"><b> &nbsp;QUAL. OBTAINED</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$arec['dedeg2'].'</td> 
							
							</tr>';
								echo '<tr>
								<td align="right" width="25%"><b>&nbsp;FORMER MATRIC NO:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['dedeg3'].'</td> 
								
							</tr>';
					
					
						echo '<tr>
								<td align="right" width="25%"><b>&nbsp;CLASS OF CERTIFICATE:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['dedeg4'].'</td> 
							
							</tr>';
							
							echo '<tr>
								<td align="right" width="25%"><b>&nbsp;INSTITUTION:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['dedeg5'].'</td> 
							
							</tr>';
							
							echo '<tr>
								<td align="right" width="25%"><b>&nbsp;DURATION:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['dedeg6'].'</td> 
							
							</tr>';
							
							echo '<tr>
								<td align="right" width="25%"><b>&nbsp;DISCIPLINE:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['dedeg7'].'</td> 
							
							</tr>';
						
								echo '<tr style="align:center;" align="center" colspan="4">
		
							<td  width="25%"><b>&nbsp;</b></td>
									</tr>';



								if ($programme=='Doctorate') {
									echo '<tr >
							
								<td align="right" width="25%"><b> &nbsp;SECOND DEGREE INFORMATION:</b></td>
							<td  width="25%"><b>&nbsp;</b></td>
									
								
							</tr>';
							echo '<tr>
								<td align="right" width="25%"><b> &nbsp;FULL NAME:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$arec['deal1'].'</td> 
							
							</tr>';
							echo '<tr>
								<td align="right" width="25%"><b> &nbsp;QUAL. OBTAINED</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$arec['deal2'].'</td> 
							
							</tr>';
								echo '<tr>
								<td align="right" width="25%"><b>&nbsp;FORMER MATRIC NO:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['deal3'].'</td> 
								
							</tr>';
					
					
						echo '<tr>
								<td align="right" width="25%"><b>&nbsp;CLASS OF CERTIFICATE:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['deal4'].'</td> 
							
							</tr>';
							
							echo '<tr>
								<td align="right" width="25%"><b>&nbsp;INSTITUTION:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['deal5'].'</td> 
							
							</tr>';
							
							echo '<tr>
								<td align="right" width="25%"><b>&nbsp;DURATION:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['deal6'].'</td> 
							
							</tr>';
							
							echo '<tr>
								<td align="right" width="25%"><b>&nbsp;DISCIPLINE:</b></td>
								<td align="left" width="15%" style="border-bottom:#000000 dotted 1px;">'.$arec['deal7'].'</td> 
							
							</tr>';
								}
						
						echo '<tr>
								<td align="center" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>				 
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
									<td align="left" width="25%"><b>&nbsp;</b></td>
							</tr>';
							echo '<tr>			 
								<td align="center" width="100%" colspan="5" style="padding:2px 0px; font-weight:bold; font-size:11px;">

								<span style="font-style:italic;">Kindly Submit a copy each of your credentials with this Application Slip ecnclosed in a brown file to The Postgraduate School, Odosida Campus,  University of Medical Sciences, Ondo. <br>Also ensure your official Transcript is sent to The Postgraduate School,  </span></td>
							</tr>';
							echo '<tr>			 
								<td align="center" width="100%" colspan="5" style="padding:2px 0px; font-weight:bold; font-size:11px;">

								<span style="font-style:italic;">Please visit this portal regularly for update on your application </span></td>

							</tr>';

	echo '<tr>';
				echo '<td align="center" colspan="6"><div ><button style="background-color:red; color:white;  border: none;padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; cursor:pointer;" onclick="window.print()">Print Slip</button></div><br /><br /><hr />
				</td>';
			echo '</tr>';
	?>
							<tr>			 
								<td align="center" width="100%" colspan="5" style="padding:8px 0px 2px 0px; font-weight:bold; font-size:11px;">
								<div class="output">
								<section class="output">
									<?php
										$finalRequest = '';
										foreach (getImageKeys() as $key => $value) {
											$finalRequest .= '&' . $key . '=' . urlencode($value);
										}
										if (strlen($finalRequest) > 0) {
											$finalRequest[0] = '?';
										}
									?>
									<div id="imageOutput">
										<?php if ($imageKeys['text'] !== '') { ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php }
										else { ?>Barcode Image.<?php } ?>
									</div>
								</section>
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
