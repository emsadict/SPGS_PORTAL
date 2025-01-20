<?php
	session_start();
	error_reporting(E_ALL);
	include_once("fun.inc.php");
	if(!isset($_SESSION['spgs_auth'])){
		header("location: portal_login.php");
	}elseif(searchRecord("course_reg","matricno",$_SESSION['spgs_auth'][1])==0 || searchRecord("course_reg","matricno",$_SESSION['spgs_auth'][1])==0){
		header("location: $_SERVER[HTTP_REFERER]");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}
	$brec1=getRecs("Screened_Candidates_2022","regno",$user);
	$brec=getRecs("course_reg","matricno",$user);
//	$brec1=getRecs("course_reg","matricno",$user);

	$arec=getRecs("course_reg","matricno",$user);
//	$dept=$brec['dept'];
 //   $session=$brec['session'];
  //  $semester=$brec['semester'];
 //   $level=$brec['level'];
 //   $faculty=$brec['faculty'];
 //   $dept=$brec['dept'];
   // $search_query=resultnew("select * from course_reg where matricno='$user' AND session='$session' AND semester='$semester' AND level='$level' AND faculty='$faculty' AND dept='$dept' ");
   // $queryResult=resultnew($search_query);
  //  $s_row=mysqli_num_rows($search_query);
    
	//if($srec==0){
		//pUTMESchedule($user,$brec[15]);
	//}
	//echo "$session";
//	echo "$semester";
//	echo "$level";
//	echo "$user";
//	echo "$session";
//	echo "$session";
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
<title>2022/2023 SCHOOL OF POSTGRADUATE STUDIES: <?php echo $user; ?></title>
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

<img width=120px; height=120px; src="<?php echo 'pass/'.$brec1[13]; ?>" />

</div>

<center>
<table width="95%" >
	<?php
	echo
	'<tr>
			<td align="center" colspan="6">
				<span style="font-size:21px;font-weight:bold;"> POSTGRADUATE SCHOOL</span><br /><br />
				<span style="font-size:19px;font-weight:bold;">UNIVERSITY OF MEDICAL SCIENCES</span><br /><br />
				<span style="font-size:17px;font-weight:bold;">ONDO, NIGERIA </span><br /><br />
					<img src="images/logo.jpg" width="100" align="bottom"/><br />
					<br />
						<p style="font-size:14px;font-weight:bold; padding-top:10px;">'.$brec['session'].' '.$brec1['semester'].' SEMESTER COURSE REGISTRATION SLIP</p><br />
			</td>
		</tr>';
	/*$date=date('Y-m-d');
	if(substr($date, 5, 2)>=substr($brec[5], 5, 2) && substr($date, 8, 2)>substr($brec[5], 8, 2)){
		$agerec=$date-$brec[5];
	}else{
		$agerec=$date-$brec[5]-1;
	}*/
//	 $dob=$brec['dob'];
   // $agerec = (date('Y') - date('Y',strtotime($dob)));
	//$_age = floor((time() - strtotime('1986-09-16')) / 31556926);
	// $agerec = intval(date('Y', time() - strtotime($dob))) - 1970;
    //echo $diff;
			echo "<tr>";
				echo '<td colspan="6" align="left"> <div style="line-height:1.8em;">';
					echo '<table align="center" width="100%">';
						echo '<tr> 
						<td align="left" width="25%"><b>NAMES.:</b></td>
						<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec1['surname'].'&nbsp;'.$brec1['onames'].'</td> 
						
						</tr>';
						
						echo '<tr>
						        
								<td align="left" width="25%"><b>MATRIC NO.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['matricno'].'</td> 
								<td width="2%">&nbsp;</td>
								<td align="left" width="24%"><b>SEX.:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.gender($brec1['sex']).'</td> 
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>LEVEL.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec['level'].'</td> 
								<td width="2%">&nbsp;</td>
							<td align="left" width="24%"><b>ACADEMIC SESSION.:</b></td>
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;">'.$brec['session'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>SEMESTER.:</b></td>				 
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec['semester'].'</td> 
								<td width="2%">&nbsp;</td>
								<td align="left" width="24%"><b>FACULTY.:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$brec1['faculty'].'</td>
							</tr>';
							echo '<tr>
								<td align="left" width="25%"><b>DEPARTMENT.:</b></td>
								<td align="left" width="25%" style="border-bottom:#000000 dotted 1px;">'.$brec1['dept'].'</td> 
								<td width="2%">&nbsp;</td>
								<td align="left" width="24%"><b>PROGRAMME.:</b></td>				 
								<td align="left" width="24%" style="border-bottom:#000000 dotted 1px;" >'.$brec1['programme'].', '.$brec1['title'].'</td>
							</tr>';
							
					
			
  
 echo '<table align="center"; style="padding:20px">
  <tr>
    <th style="padding:10px">Course Code</th>
    <th style="padding:10px">Course Title</th>
    <th style="padding:10px">Course Unit</th>
    <th style="padding:10px">Course Type</th>
  </tr>
  <tr>
    <td align="center" style="border-bottom:#000000 solid 1px; border-left:#000000 solid 1px; border-top:#000000 solid 1px">&nbsp;'.subtitle($brec['course1']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-top:#000000 solid 1px">&nbsp'.subgrd($brec['course1']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-top:#000000 solid 1px">&nbsp'.credit($brec['course1']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-top:#000000 solid 1px;border-right:#000000 solid 1px">&nbsp'.type($brec['course1']).'</td>
  </tr>
  <tr>
<td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course2']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course2']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course2']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course2']).'</td>
  </tr>
  <tr>
 <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course3']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course3']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course3']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course3']).'</td>
  </tr>
  <tr>
<td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course4']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course4']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course4']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course4']).'</td>
  </tr>
 <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course5']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course5']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course5']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course5']).'</td>
  </tr>
  
  <tr>
<td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course6']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course6']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course6']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course6']).'</td>
  </tr>
 <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course7']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course7']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course7']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course7']).'</td>
  </tr>
  
   <tr>
<td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course8']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course8']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course8']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course8']).'</td>
  </tr>
 <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course9']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course9']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course9']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course9']).'</td>
  </tr>
  <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course10']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course10']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course10']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course10']).'</td>
  </tr>
  <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.subtitle($brec['course11']).'</td>
    <td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.subgrd($brec['course11']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'.credit($brec['course11']).'</td>
    <td align="center" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;border-right:#000000 solid 1px">'.type($brec['course11']).'</td>
  </tr>

</table>';

		
							
						
							
								echo '<tr>
								
								<td align="left" width="48%" colspan="2" style="border-bottom:#000000 dotted 1px;"><b>Student\'s Name/Sign./Date</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td width="2%">&nbsp;</td>
								<td align="left" width="48%" colspan="2" style="border-bottom:#000000 dotted 1px;">&nbsp;<b>Course Adviser\'s Name/Sign./Date</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>';
								
								
								echo '<tr>
								
								<td align="left" width="48%" colspan="2" style="border-bottom:#000000 dotted 1px; padding-top:20px;"><b><b>HOD\'S Name/Sign./Date</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td width="2%">&nbsp;</td>
								<td align="left" width="48%" colspan="2" style="border-bottom:#000000 dotted 1px;">&nbsp;<b>Dean\'s Name/Sign./Date</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>';
	?>
							<tr>			 
								<td align="center" width="100%" colspan="5" style="padding:8px 0px 2px 0px; font-weight:bold; font-size:11px;">
								<div class="output">
							
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
