<?php
	session_start();
	error_reporting(0);
	include_once("fun.inc.php");
	if(!isset($_SESSION['spgs_auth'])){
		header("location: portal_login.php");
	}elseif(searchRecord("course_reg","matricno",$_SESSION['spgs_auth'][1])==0 || searchRecord("course_reg","matricno",$_SESSION['spgs_auth'][1])==0){
		header("location: $_SERVER[HTTP_REFERER]");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];
	}
	$rec=getRecs("course_reg","matricno",$user);
	$brec1=getRecs("Screened_Candidates_2022","regno",$user);
	$name=$brec1[2].', '.$brec1[3];
	//}
	$sem=getCalendarInfo();

	//$sem[1]=$admrec['session'];
	$sem[1]=$brec1['session'];
	$sess=$sem[1];
	$sem[2]=$admrec['semester'];
	$level=$admrec['level'];
if(isset($_REQUEST['semester'])){
	$sem[2]=$_REQUEST['semester'];
	}
	$session=$sem[3].'/'.$sem[4];
	$semester=$sem[2];
//	if(courseCheck2($user,$sem[1],$sem[2])==0){
//		header("location: updp_basic_info.php?message=Your form is awaiting approval by your Course Adviser");
//	}
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Course Registration Form: <?php echo $user; ?></title>

</head>

<body bgcolor="#ffffff">

<div id="waterMark"><img src="../images/bglogo.jpg" width="400" height="553"></div>

<div style="position:absolute; overflow:hidden; left:82%; top:60px; z-index:18; border: 1px solid #000000;">

<img width=100px; height=100px; src="<?php echo 'pass/'.$brec1[13]; ?>" />

</div>

<center>
<table width="95%" >
	<?php
	echo
	'<tr>
			<td align="center" colspan="6">
				<span style="font-size:17px;font-weight:bold;">UNIVERSITY OF MEDICAL SCIENCES ONDO,<br>ONDO STATE</span><br /><br />
					<img src="../images/logo.jpg" width="70" align="bottom"/><br />
					<br />
						<span style="font-size:14px;font-weight:bold;">COURSE REGISTRATION FORM</span>
			</td>
		</tr>';
if(isset($brec1)){
	printForm($user,$name,$brec1['faculty'],$brec1['dept'],$brec1['level'],$session,$semester);

	//$user,$name,$rec[5],$brec[7],$rec[9],$session,$semester
}
?>
</table>
</center>
</body>
</html>
