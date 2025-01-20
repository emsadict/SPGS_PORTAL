<?php
	session_start();
	error_reporting(0);
	include_once("fun.inc.php");
	if(!isset($_SESSION['spgs_auth'])){
		header("location: portal_login.php");
	}else{
		$updp=$_SESSION['spgs_auth'];
		$user=$updp[1];
	}
	$rec=getRecs("Screened_Candidates_2022","regno",$user);
	$admrec=getRecs("course_reg","regno",$user);
	$name=$rec[2].', '.$rec[3];
	//}
	$sem=getCalendarInfo();

	$sem[1]=$admrec['session'];
	$sess=$sem[1];
	$sem[2]=$admrec['semester'];
	$level=$admrec['level'];

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

<img width=100px; height=100px; src="<?php echo 'pass/'.$rec[13]; ?>" />

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
if(isset($rec)){
	printForm($user,$name,$admrec['dept'],$level,$sem[1],$sem[2]);
}
?>
</table>
</center>
</body>
</html>
