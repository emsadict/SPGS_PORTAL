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
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
        $brec=getRecs("admitted_2022","regno",$user);
    $image=$brec['passport'];
	$dob=$brec['dob'];
    $admissionLetter=$brec['admissionletter'];
    $surname=$brec['surname'];
    $onames=$brec['onames'];
    $session=$brec['session'];
    $programme=$brec['programme'];
    $dept=$brec['dept'];
	
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
$code = $system_temp_array2[0];

// Check if the code is valid
if (file_exists('config' . DIRECTORY_SEPARATOR . $code . '.php')) {
    include_once('config' . DIRECTORY_SEPARATOR . $code . '.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=Generator content="Microsoft Word 15 (filtered)">
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
<!--
 /* Font Definitions */
 @font-face
	{font-family:SimSun;
	panose-1:2 1 6 0 3 1 1 1 1 1;}
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
@font-face
	{font-family:"\@SimSun";
	panose-1:2 1 6 0 3 1 1 1 1 1;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0.5in;
	margin-bottom:10.0pt;
	margin-left:0.5in;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;}
a:link, span.MsoHyperlink
	{font-family:"Calibri",sans-serif;
	color:blue;
	text-decoration:underline;}
.MsoChpDefault
	{font-size:10.0pt;
	font-family:"Calibri",sans-serif;}
@page WordSection1
	{size:8.5in 11.0in;
	margin:1.0in 1.0in 1.0in 1.0in;}
div.WordSection1
	{page:WordSection1;}
-->
</style>

<title>2023/2024 POSTGRADUATE SCHOOL: <?php echo $user; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="include/style.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <script src="include/jquery-1.7.2.min.js"></script>
        <script src="include/barcode.js"></script>
</head>
<body lang=EN-US link=blue vlink="#954F72" style='word-wrap:break-word'>
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

</div>
<div class=WordSection1>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><b><span
style='font-size:14.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>UNIVERSITY
OF MEDICAL SCIENCES, ONDO CITY, ONDO STATE</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>POSTGRADUATE
SCHOOL</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
line-height:normal'><span style='font-size:10.0pt;font-family:"Tahoma",sans-serif'><img src="images/logo.jpg" width="80" align="bottom"/><br /></span></p>
<br />
<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>DEAN:</span></b><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>  Prof. M. C. Asuzu
MBBS(Ib); FMCPH</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Telephone: 08033467670</b></span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;text-indent:.5in;line-height:normal'><span style='font-size:
10.0pt;font-family:"Tahoma",sans-serif'></span></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
style='font-size:6.0pt;font-family:"Tahoma",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>SECRETARY:</span></b><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>    Mrs H.B. Atunwa </span><i><span
style='font-size:9.0pt;font-family:"Tahoma",sans-serif'>MIPMN, MNIM, FIPMD</span></i><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>     <b>e-mail:</b></span><a
href="mailto:pgschool@unimed.edu.ng"><span style='font-size:10.0pt;font-family:
"Tahoma",sans-serif'>pgschool@unimed.edu.ng</span></a></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'> B.A.,
MPA (Ile-Ife)</span></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
style='position:absolute;z-index:251657216;margin-left:13px;margin-top:20px;
width:793px;height:1px'><img width=793 height=1
src="MASTER%20PHYSIOTHERAPY%20EXERCISE_files/image002.png"></span><span
style='position:absolute;z-index:251658240;margin-left:-84px;margin-top:22px;
width:796px;height:1px'><img width=796 height=1
src="MASTER%20PHYSIOTHERAPY%20EXERCISE_files/image003.png"></span><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>                                                                                    </span></p>

<p class=MsoNormal style='margin-bottom:0in'><span style='font-size:10.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>                                                                                                </span></p>
<hr />
<p class=MsoNormal style='margin-bottom:0in'><b><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>UNIMED/PGS/ADM/23/10                                  Date:
11th December, 2023</span></b></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
style='font-size:12.0pt'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>Dear, &nbsp;<?php echo $surname .' '.$onames; ?></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>(<?php echo $user; ?>)</span></b></p>

<p class=MsoNormal style='margin-bottom:0in'><b><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>OFFER
OF PROVISIONAL ADMISSION INTO THE <?php echo strtoupper(($programme)); ?> PROGRAMME </span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>(<?php echo "$session" ; ?>&nbsp;
ACADEMIC SESSION)</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify;line-height:
normal'><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>With
reference to your application for admission into the Masters Programme in the
University of Medical Sciences, Ondo, it is my pleasure to inform you that you
have been offered provisional admission to pursue an academic programme leading
to the award of <b>M.Sc in  <?php echo "$dept" ; ?></b>with
effect from the <b><?php echo "$session" ; ?>  </b>Academic Session.</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:115%;font-family:
"Tahoma",sans-serif'>Please take note of the following conditions, which are
related to your admission and registration:</span></p>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:115%;font-family:
"Tahoma",sans-serif'>(1)     This offer of admission is strictly provisional
and may be revoked if: </span></p>

<p class=MsoNormal style='margin-left:.75in;text-indent:-.25in'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>(a)
you fail to formally accept this offer by paying the acceptance fee of <b>eighty
thousand naira (<s>N</s>80,000.00) only, on or before the 24th November, 2023</b></span></p>

<p class=MsoNormal style='margin-left:.5in'><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>(b) school fee of<b> two
hundred and eighty-two thousand naira only  (<s>N</s>282,000.00)</b> and other
charges before the deadline for payment. All payments MUST be made
online through </span><a href="http://www.unimed.edu.ng"><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>www.unimed.edu.ng</span></a></p>

<p class=MsoNormal style='margin-left:.75in;text-indent:-.25in'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>(c) you
are unable to satisfy the necessary requirements for admission and
registration. </span></p>

<p class=MsoNormal style='margin-left:.75in;text-indent:-.25in'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>(d)
you cannot produce at the time of registration, the original copies of your O’   level
certificate and other academic credentials. </span></p>

<p class=MsoNormal style='margin-left:.5in'><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>(e) First semester commences
on 20th October, 2023 </span></p>

<p class=MsoNormal style='margin-left:1.0in;text-align:justify;text-indent:
-.5in'><span style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(2) The programme is on <b>Full-Time basis</b>. The duration of your course is <b>three
(3) semesters</b> and other conditions relating to it, are as contained in the
Postgraduate School’s prospectus.</span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>(3) If you accept this offer,
please comply with the following procedure for registration: </span></p>

<p class=MsoNormal style='margin-left:1.0in;text-align:justify;text-indent:
-.5in'><span style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>(a)
    Payment of all fees must be made before 24th November, 2023 as provisional
offer of admission will lapse thereafter. </span></p>

<p class=MsoNormal style='margin-left:1.0in;text-align:justify;text-indent:
-.5in'><span style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>(b)     It
is <b>mandatory</b> that you appear physically for clearance at the Admissions
office of the postgraduate school.  If within four (4) weeks from the date on
this letter, you have neither completed and returned the printed acceptance
forms nor submitted the originals of your credentials for clearance, this offer
will be revoked and your slot will be given to someone else.</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>PLEASE
NOTE THAT IF IT IS DISCOVERED AT ANY POINT THAT YOU DO NOT POSSESS ANY OF THE
QUALIFICATIONS WHICH YOU CLAIM TO HAVE OBTAINED OR YOU REFUSE TO SUBMIT THE
TRANSCRIPT OF YOUR UNIVERSITY DEGREES, THE ADMISSION WILL BE WITHDRAWN
IMMEDIATELY. </span></b></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>Please
accept my congratulations on behalf of the University. </span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>Yours
sincerely,</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><img border=0
width=157 height=84 id="Picture 1"
src="MASTER%20PHYSIOTHERAPY%20EXERCISE_files/image004.png"></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>Mrs.
H.B. Atunwa</span></b></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify;line-height:
normal'><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>Deputy
Registrar &amp; Secretary, Postgraduate School</span></p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

</div>

</body>

</html>