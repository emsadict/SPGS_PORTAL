<?php
	session_start();
	error_reporting(E_ALL);
	include_once("fun.inc.php");
	if(!isset($_SESSION['spgs_auth'])){
		header("location: portal_login.php");
	}else{
		$cusDetails=$_SESSION['spgs_auth'];
		$user=$cusDetails[1];
	}
	$rec=getRecs("Screened_Candidates_2022","regno",$user);
	$name=$rec[2].', '.$rec[3];
	
	if(isset($_REQUEST['checkresult']) && $_REQUEST['session'] !="" && $_REQUEST['level'] !="" && $_REQUEST['semester'] !="" ){
		$semester=$_REQUEST['semester'];
		$session=$_REQUEST['session'];
		$level=$_REQUEST['level'];
		if(studres($user,$level,$semester,$session)==0){
			header("location: resultChecker.php?message=Result is not available for the given parameter(s)");
		}
	}elseif(isset($_REQUEST['checkresult'])){
		header("location: resultChecker.php");
	}
	//$aa=studres($user,$level,$semester,$session);
	//print_r($aa);


//function that display result


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
<title>RESULT SLIP FOR: <?php echo $user; ?></title>

</head>

<body bgcolor="#ffffff">

<div id="waterMark"><img src="../images/bglogo.jpg" width="400" height="553"></div>

<center>
<table width="95%">
	<?php
	echo
	'<tr>
			<td align="center" colspan="6">
				<span style="font-size:17px;font-weight:bold;">UNIVERSITY OF MEDICAL SCIENCES, ONDO<br>ONDO STATE</span><br /><br />
					<img src="../images/logo.jpg" width="70" align="bottom"/><br />
					<br />
						<span style="font-size:14px;font-weight:bold;">NOTIFICATION OF RESULT</span>
			</td>
		</tr>';
if(isset($rec)){
	studentResult($user,$name,$rec['faculty'],$rec['dept'],$level,$semester,$session);
}
	
	echo '<tr>';
				echo '<td align="center" colspan="6"><div class="btn btn-primary"><button  onclick="window.print()">Print Result</button></div><br /><br /><hr />
				<span style="font-size:10px; font-style:italic;">Powered by: UNIMED ICT CENTRE</span></td>';
			echo '</tr>';
?>

</table>
</center>
</body>
</html>
