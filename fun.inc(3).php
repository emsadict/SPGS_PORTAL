<?php

function resultnew($query){
	//PGSchool database connection
	$conn=mysqli_connect("localhost","spgsportal_spgsaccess","Adult@Learn","spgsportal_pgschooldb");
	if (mysqli_connect_errno()){
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	if(!$result=mysqli_query($conn,$query)){
	   $message=mysqli_error($conn);
		return $message;	
	}else{
		return $result;
	}
}

function payconnect($query){
	//Access to paymentinvoice table on centraldb
	$conn=mysqli_connect("localhost","unimed5_spgs","pay@UN1M3D","unimed5_unimedportaldb");
	if (mysqli_connect_errno()){
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	if(!$result=mysqli_query($conn,$query)){
	   $message=mysqli_error($conn);
		return $message;	
	}else{
		return $result;
	}
}

function accLogin1($user,$pass,$table){
	$user=trim($user);
	$pass=trim(md5($pass));
	$loginQuery="select * from $table where username='$user' AND password='$pass'";
	$loginResult=resultnew($loginQuery);
	$recordCount=mysqli_num_rows($loginResult);
	if($recordCount>=1){
		$c_row=mysqli_fetch_array($loginResult);
		return $c_row;
	}else{
		return 0;
	}
}

function searchRecord($table,$field,$code){

	$query="SELECT * FROM $table WHERE $field='$code'";

	$queryResult=resultnew($query);

	$s_row=mysqli_num_rows($queryResult);

	return $s_row;

}

class DBController {
//	private $host = "localhost";
//	private $user = "root";
//	private $password = "";
//	private $database = "unimedportal";
	private $host = "localhost";
	private $user = "spgsportal_spgsaccess";
	private $password = "Adult@Learn";
	private $database = "spgsportal_pgschooldb";
	
	function __construct() {
		$conn = $this->connectDB();
	}
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database) or die("Connection failed". mysqli_connect_error());
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->connectDB(),$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		

		if(!empty($resultset)){
			return $resultset;	
		}
	}

	function numRows($query) {
		$result  = mysqli_query($query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function getStateID($state){
		$query="SELECT state FROM state2 WHERE state_id='$state'";
		$queryResult=mysqli_query($query);
		list($id)=mysqli_fetch_array($queryResult);
		return $id;
	}

	function getFacultyID($faculty){
		$query="SELECT faculty FROM faculties_dept_spgs WHERE faculty_id='$faculty'";
		$queryResult=mysqli_query($query);
		list($id)=mysqli_fetch_array($queryResult);
		return $id;
	}
}

function getFacultyID($state){
	$query="SELECT faculty_id FROM faculties_dept_spgs WHERE faculty='$state'";
	$queryResult=resultnew($query);

	list($id)=mysqli_fetch_array($queryResult);

	return $id;

}

function getFacultyName($state){
	$query="SELECT faculty FROM faculties_dept_spgs WHERE faculty_id='$state' LIMIT 0,1";
	$queryResult=resultnew($query);
	list($id)=mysqli_fetch_array($queryResult);
	return $id;

}

function selectLG($state,$lg1){

	$query=resultnew("SELECT lg FROM state2 WHERE state='$state'");

	while($lg=mysqli_fetch_array($query)){

		echo '<option value="'.$lg[0].'"'; if($lg[0]==$lg1){echo 'selected="selected"';}; echo '>'.$lg[0].'</option>';

	}

}

function selectDept($faculty,$dept1,$prog){

	$query=resultnew("SELECT dept FROM faculties_dept_spgs WHERE faculty='$faculty' AND progtype='$prog'");

	while($dept=mysqli_fetch_array($query)){

		echo '<option value="'.$dept[0].'"'; if($dept[0]==$dept1){echo 'selected="selected"';}; echo '>'.$dept[0].'</option>';

	}

}

function gender($sex){
	switch($sex){
		case "F":
			$gen="Female";
			break;
		case "M":
			$gen="Male";
			break;
		default:
			$gen=$sex;
			break;
	}
	return $gen;
}

function getRecs($table,$field,$id){
	$checkQuery="SELECT * FROM $table WHERE $field='$id' ORDER BY id DESC LIMIT 0,1";

	$checkResult=resultnew($checkQuery);

	$rows=mysqli_num_rows($checkResult);

	$recs=mysqli_fetch_array($checkResult);

	if($rows>=1){
		return $recs;
	}else{
		return 0;
	}

}

function getRecs2($table,$vars,$limit1=0,$limit2=0){
	$checkQuery="SELECT * FROM $table WHERE ";
	$vars_no=sizeof($vars);
	$iteration=0;
	foreach($vars as $key=>$val){
		$checkQuery.="$key='$val'";
		$iteration+=1;
		if($iteration<$vars_no){
			$checkQuery.=" AND ";
		}
	}
	$checkQuery.=" ORDER BY id DESC";
	if($limit2!=0){
		$checkQuery.=" LIMIT $limit1, $limit2";
	}
	$checkResult=resultnew($checkQuery);
	$rows=mysqli_num_rows($checkResult);
	$recs=mysqli_fetch_array($checkResult);
	if($rows>=1){
		return $recs;
	}else{
		return 0;
	}
//return $checkQuery;
}


function listSubjectsb($name,$hid="",$val){

		echo '<select name="'.$name.'" class="form-control">

				<option value="">--Select Subject--</option>';

			echo '

				<option value="'.$val.'" selected="selected">'.$val.'</option>';	

		echo '</select>';

}



function listSubjectsjb($hid,$val,$no){

		echo '<select name="'.$hid.'" id="'.$hid.'" class="form-control">';

			echo '<option value="">--Select Subject '.$no.'--</option>

				<option '; if($val=="Mathematics"){ echo 'selected="selected"'; } echo '>Mathematics</option>

				<option '; if($val=="Biology"){ echo 'selected="selected"'; } echo '>Biology</option>

				';		

		echo '</select>';

}


function listSubjects($name,$hid="",$val=""){

		echo '<select name="'.$name.'" id="'.$hid.'" class="form-control">

				<option value="">--Select Subject--</option>';

			echo '

				<option '; if($val=="English Language"){ echo 'selected="selected"'; } echo '>English Language</option>

				<option '; if($val=="Mathematics"){ echo 'selected="selected"'; } echo '>Mathematics</option>

				<option '; if($val=="Further Mathematics"){ echo 'selected="selected"'; } echo '>Further Mathematics</option>

				<option '; if($val=="Biology"){ echo 'selected="selected"'; } echo '>Biology</option>

				<option '; if($val=="Chemistry"){ echo 'selected="selected"'; } echo '>Chemistry</option>

				<option '; if($val=="Physics"){ echo 'selected="selected"'; } echo '>Physics</option>

				<option '; if($val=="Agricultural Science"){ echo 'selected="selected"'; } echo '>Agricultural Science</option>

				<option '; if($val=="Economics"){ echo 'selected="selected"'; } echo '>Economics</option>

				<option '; if($val=="Geography"){ echo 'selected="selected"'; } echo '>Geography</option>

				<option '; if($val=="Civic Education"){ echo 'selected="selected"'; } echo '>Civic Education</option>

				<option '; if($val=="Computer Studies"){ echo 'selected="selected"'; } echo '>Computer Studies</option>

				<option '; if($val=="Food and Nutrition"){ echo 'selected="selected"'; } echo '>Food and Nutrition</option>

				<option '; if($val=="Wood Work"){ echo 'selected="selected"'; } echo '>Wood Work</option>

				<option '; if($val=="Technical Drawing"){ echo 'selected="selected"'; } echo '>Technical Drawing</option>

				<option '; if($val=="Tourism"){ echo 'selected="selected"'; } echo '>Tourism</option>

				<option '; if($val=="Igbo Language"){ echo 'selected="selected"'; } echo '>Igbo Language</option>

				<option '; if($val=="Yoruba Language"){ echo 'selected="selected"'; } echo '>Yoruba Language</option>

				<option '; if($val=="Christian Religious Knowledge"){ echo 'selected="selected"'; } echo '>Christian Religious Knowledge</option>

				';		

		echo '</select>';

}

function listGrades($name,$hid,$val=""){

		echo '<select name="'.$name.'" id="'.$hid.'" class="form-control">

						<option value="">--Select Grade--</option>';

						echo '<option value="AR" '; if($val=="AR"){ echo 'selected="selected"'; } echo '>AR</option>

						<option value="A1" '; if($val=="A1"){ echo 'selected="selected"'; } echo '>A1</option>

						<option value="B2" '; if($val=="B2"){ echo 'selected="selected"'; } echo '>B2</option>

						<option value="B3" '; if($val=="B3"){ echo 'selected="selected"'; } echo '>B3</option>

						<option value="C4" '; if($val=="C4"){ echo 'selected="selected"'; } echo '>C4</option>

						<option value="C5" '; if($val=="C5"){ echo 'selected="selected"'; } echo '>C5</option>

						<option value="C6" '; if($val=="C6"){ echo 'selected="selected"'; } echo '>C6</option>

						<option value="D7" '; if($val=="D7"){ echo 'selected="selected"'; } echo '>D7</option>

						<option value="E8" '; if($val=="E8"){ echo 'selected="selected"'; } echo '>E8</option>

						<option value="F9" '; if($val=="F9"){ echo 'selected="selected"'; } echo '>F9</option>';		

		echo '</select>';

}


function subtitle($val){

	$rec=explode("|",$val);

	return $rec[0];

}

function subgrd($val){

	$rec=explode("|",$val);

	return $rec[1];

}

function getCalendarInfo(){

	$calendarQuery="SELECT * FROM calendarsetup ORDER BY id DESC LIMIT 0,1";

	$calendarResult=resultnew($calendarQuery);

	$calendarRows=mysqli_fetch_array($calendarResult);

	return $calendarRows;	

}


function retInvoiceP($matricno,$paytype,$session){
	$checkQuery="SELECT * FROM paymentinvoice WHERE matricno='$matricno' AND feetype='$paytype' AND session='$session' AND feestatus='PAID' ORDER BY id DESC LIMIT 0,1";
	$checkResult=payconnect($checkQuery);
	$num=mysqli_num_rows($checkResult);
	if($num>=1){
		$returnedRows=mysqli_fetch_array($checkResult);
		return $returnedRows;
	}else{
		return 0;
	}
	
}

function input2($values, $table){
	$values[]=date("Y-m-d");
	$n=sizeof($values);//GET THE NUMBER OF PARAMETERS
	$reg_query="REPLACE INTO $table Values (id,";
//BUILD UP QUERY DEPENDING ON THE NUMBER OF VALUES SENT....
	for($x=0; $x<$n; $x++){
	 $reg_query .="'".$values[$x]."',";
	} 
	$rev_query=strrev($reg_query);//reverse the query....
	$irev_query=substr($rev_query,1,strlen($reg_query));//strip the last comma....
	$auth_query=strrev($irev_query);//reverse the stripped query...
	$auth_query .=")";//add the closing bracket to the formatted query....
	$reg_result=resultnew($auth_query);
	return $reg_result;
	//return $auth_query
}

function input($values, $table){
	$values[]=date("Y-m-d");
	$n=sizeof($values);//GET THE NUMBER OF PARAMETERS
	$reg_query="INSERT INTO $table Values (id,";
//BUILD UP QUERY DEPENDING ON THE NUMBER OF VALUES SENT....
	for($x=0; $x<$n; $x++){
	 $reg_query .="'".$values[$x]."',";
	} 
	$rev_query=strrev($reg_query);//reverse the query....
	$irev_query=substr($rev_query,1,strlen($reg_query));//strip the last comma....
	$auth_query=strrev($irev_query);//reverse the stripped query...
	$auth_query .=")";//add the closing bracket to the formatted query....
	$reg_result=resultnew($auth_query);
	return $reg_result;
	//return $auth_query
}

function getStateID($state){
	$query="SELECT state_id FROM state2 WHERE state='$state'";

	$queryResult=resultnew($query);

	list($id)=mysqli_fetch_array($queryResult);

	return $id;

}

function getStateName($state){
	$query="SELECT state FROM state2 WHERE state_id='$state' LIMIT 0,1";

	$queryResult=resultnew($query);

	list($id)=mysqli_fetch_array($queryResult);

	return $id;

}

?>