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
	
	$brec=getRecs("course_reg","matricno",$user);
	$brec1=getRecs("Screened_Candidates_2022","regno",$user);
	$arec=getRecs("course_reg","matricno",$user);
	$name=$brec1[2].', '.$brec1[3];
	
   $sem=getCalendarInfo();
   $session=$brec1['session'];
   $semester=$brec1['semester'];
   $level=$brec1['level'];
   $faculty=$brec1['faculty'];
   $programme=$brec1['programme'];
   $dept=$brec1['dept'];
   


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
<title>2024/2025 SCHOOL OF POSTGRADUATE STUDIES: <?php echo $user; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="include/style.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <script src="include/jquery-1.7.2.min.js"></script>
        <script src="include/barcode.js"></script>
</head>

<body bgcolor="#ffffff" class="<?php echo $code; ?>">

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    


<?php
//include('include/footer.php');
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
						<span style="font-size:14px;font-weight:bold;">COURSE REGISTRATION FORM <br /><br />PROGRAMME:&nbsp;'. $programme.', '.$brec1['title'].' </span></br></br>
			</td>
			<tdalign="center" colspan="6"> 
			  </br></br>
			</td>
		</tr>';
		
				if(isset($brec)){
	printForm($user,$name,$brec1['faculty'],$brec1['dept'],$brec1['level'],$session,$semester);
//	          $user,$name,$rec['faculty'],$rec['dept'],$level,$semester,$session
//	$matricno,$name,$faculty,$dept,$level,$session,$semester
}		
	?>		
				

  
 
		

					
		
	
</table>
</center>
</body>
</html>
