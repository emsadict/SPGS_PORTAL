<?php

	session_start();
	error_reporting(0);
	include_once("fun.inc.php");
	
	if(!isset($_SESSION['spgs_auth'])){
		header("location: portal_login.php");
	}elseif(searchRecord("admitted_2022","regno",$_SESSION['spgs_auth'][1])==0 || searchRecord("admitted_2022","regno",$_SESSION['spgs_auth'][1])==0){
		header("location: $_SERVER[HTTP_REFERER]");
	}else{
		$spgs_auth=$_SESSION['spgs_auth'];
		$user=$spgs_auth[1];

//$brec=getRecs("","regno",$user);
$brec=getRecs("admitted_2022","regno",$user);
//	$arec=getRecs("spgs_acad_rec","regno",$user);
    $image=$brec['passport'];
	$dob=$brec['dob'];
    $admissionLetter=$brec['admissionletter'];
    $surname=$brec['onames'];

    // echo"Welcome:$user";
    // echo"</br>";
     
      echo"</br>";
     //echo "$image";
    // echo "<img src='pass/$image' height='100px' width='100px'>";
//echo "$admissionLetter";

}

?>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body {background-color: powderblue;}
h1   {color: blue;}
p    {color: red;}
.fcc-btn {
  background-color: #199319;
  color: white;
  
}
.fcc-btn:hover {
  background-color: #223094;
}
</style>
</head>
<body>
    <div class="alert alert-success" align="center" margin-left="40px" margin-right="40px">
  <strong>Welcome: <?php echo"$surname  "."$user";?></strong> 
</div>
<div class="btn-toolbar" style="align:center;">
<center><img width=120px; height=120px; src="<?php echo 'pass/'.$image; ?>" class="img-fluid img-thumbnail" width="100" height="80"/></center>
</div>
</br></br>
<center><a href="admision_letter/<?php echo $admissionLetter;?>" type="button" class="btn btn-success">Download Admission Letter</a></center>
</br></br>
<center><a href="https://www.spgs.unimed.edu.ng/basicInfo_admitted.php" type="button" class="btn btn-warning">Back</a></center>

</body>
</html>
