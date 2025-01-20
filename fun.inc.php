<?php



function resultnew($query){

	//PGSchool database connection

//	$conn=mysqli_connect("localhost","spgsportal_spgsaccess","Adult@Learn","spgsportal_pgschooldb");
	$conn=mysqli_connect("localhost","root","","spgsportal_pgschooldb");

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

//	$conn=mysqli_connect("localhost","unimed5_spgs","pay@UN1M3D","unimed5_unimedportaldb");

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

	private $host = "localhost";

	private $user = "root";

	private $password = "";

//	private $database = "unimedportal";

	private $database = "spgsportal_pgschooldb";

//	private $host = "localhost";

//	private $user = "spgsportal_spgsaccess";

//	private $password = "Adult@Learn";

//	private $database = "spgsportal_pgschooldb";

	

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



function addUnit($matricno,$semester,$session){

	

	$sql=resultnew("SELECT * FROM extraunits WHERE matricno='$matricno' AND session='$session' AND semester='$semester' ORDER BY id DESC LIMIT 0,1");

	$no=mysqli_num_rows($sql);

	if($no==0){

		$ret=0;

	}else{

		$rec=mysqli_fetch_array($sql);

		$ret=$rec[4];

		

	}

	return $ret;

}



function semunit($dept,$level,$semester,$matno,$stype){

	

	//current semester courses

	$sql1=resultnew("SELECT * FROM course WHERE semester='$semester' AND level='$level' AND courseCode<>'BIO 120' AND stype='$stype' AND (dept='$dept' || dept='ALL') ORDER BY courseCode ASC");

	$totunit=0;

	while($res=mysqli_fetch_array($sql1)){

		$totunit += $res[3];

	}

	return $totunit;

}



function listPUnits($level,$semester,$matricno,$sess){

	

	$query=resultnew("SELECT course1, course2, course3, course4, course5, course6, course7, course8, course9, course10, course11, course12, course13, course14, course15, course16, course17, course18, course19, course20 FROM course_reg WHERE matricno='$matricno' AND level='$level' AND session='$sess' AND semester<>'$semester' ORDER BY id DESC LIMIT 0,1");

	$no=mysqli_num_rows($query);

	$cunit=0;

	if($no>=1){

		$ret=mysqli_fetch_row($query);

		foreach($ret as $val){

			if($val != "|||"){

				$split=explode("|",$val);

				$cunit += $split[2];

			}

		}

	}

	return $cunit;

}



function extraUnit($dept,$level,$semester,$matno,$sess,$un,$stype="REGULAR"){

	$funit=semunit($dept,$level,"FIRST",$matno,$stype);

	$sunit=semunit($dept,$level,"SECOND",$matno,$stype);

	$cunit=semunit($dept,$level,$semester,$matno,$stype);

	$sessu=$funit+$sunit+12;

	$punit=listPUnits($level,$semester,$matno,$sess);

	//$bal=12-($punit-$funit);

	if($un<=addUnit($matno,$semester,$sess)){

		$ret=1;

	}elseif($level>=200 && ($dept=="Nursing Science" || $dept=="Physiotherapy" || $dept=="Medical Laboratory Science")){

		if($un<=$cunit && ($dept=="Physiotherapy" || $dept=="Medical Laboratory Science")){

			$ret=1;

		}elseif($dept=="Nursing Science"){

			if($semester=="FIRST" && $un<=($funit+12)){

				$ret=1;

			}elseif($semester=="SECOND" && $un<=($sessu-$punit)){

				$ret=1;

			}else{

				$ret=0;

			}

		}else{

			$ret=0;

		}

	}else{

		$ret=0;

	}

	/*elseif($level==300 && $dept=="Physics(Electronics Physics)"){

		if($semester=="FIRST" && $un<=28){

			$ret=1;

		}elseif($semester=="SECOND" && $un<=26){

			$ret=1;

		}else{

			$ret=0;

		}

	}*/

	return $ret;

}



function checkIfExist($matricno,$semester,$level,$session){



	$sql=resultnew("SELECT * FROM course_reg WHERE matricno='$matricno' AND semester='$semester' AND level=$level AND session='$session' ORDER BY id DESC LIMIT 0,1");



	$no=mysqli_num_rows($sql);



		if($no>=1){



			return $no;



		}else{



			return 0;



		}



}



function listPCourses($level,$semester,$matricno){



	$query=resultnew("SELECT course1, course2, course3, course4, course5, course6, course7, course8, course9, course10, course11, course12, course13, course14, course15, course16, course17, course18, course19, course20 FROM course_reg WHERE matricno='$matricno' AND semester='$semester' AND level<$level ORDER BY id DESC");



	$no=mysqli_num_rows($query);



	$cos=array();



	if($no>=1){



		while($ret=mysqli_fetch_array($query)){



			foreach($ret as $val){



				if($val != "|||"){



					$split=explode("|",$val);



					$cos[]=$split[0];



				}



			}	



		}



	}



	return array_filter($cos);



}



function listCoursesNew($dept,$level,$semester,$matno,$utyp=1,$stype="REGULAR"){



//	$level2=$level-100; // to get previous session registration
	$level2=$level-100;


//	$pcos=listPCourses($level,$semester,$matno);
	$pcos=listPCourses($level,$semester,$matno);



	//to get previous carry over courses



	//$rpt=resultnew("SELECT oc FROM resulttable WHERE matricno='$matno' ORDER BY session DESC, level DESC, sem DESC LIMIT 0,1");

	$rpt=resultnew("SELECT oc FROM resulttable WHERE matricno='$matno' ORDER BY resultid DESC LIMIT 0,1");



	list($oc)=mysqli_fetch_array($rpt); 



	$n=0;



	$name='cos[]';



	if($oc!=""){



		$exp=explode("|",$oc);

        $exdept=array("Medicine and Surgery","Dentistry");

		foreach($exp as $k){



			if($stype=="REGULAR"){

				$sql=resultnew("SELECT courseTitle,credit,cat FROM course WHERE courseCode='$k' AND semester='$semester' AND (dept='$dept' || dept='ALL') AND stype='REGULAR'");

			}elseif($stype=="DIPLOMA"){

				$sql=resultnew("SELECT courseTitle,credit,cat FROM course WHERE courseCode='$k' AND semester='$semester' AND dept='$dept' AND stype='DIPLOMA'");

			}



			$c=mysqli_num_rows($sql);



			if($c==1){



				list($title,$unit,$cat)=mysqli_fetch_array($sql);



				$n=$n+1;

                echo '<tr style="padding:5px; background-color:white;">

			 <td align="center" style="padding:5px;">['.$n.']</td>	

				<td align="center" style="padding:5px;">';



					if($utyp==2 || (in_array($dept,$exdept) && $level>100)){



						echo '<input type="checkbox" name="'.$name.'" value="'.$k.'|'.$title.'|'.$unit.'|CO"';



						echo ' />';



					}else{



					echo '<input type="hidden" name="'.$name.'" value="'.$k.'|'.$title.'|'.$unit.'|CO" />



					<input type="checkbox" name="'.$name.'" value="'.$k.'|'.$title.'|'.$unit.'|CO" checked disabled="disabled" />';



					}



					echo $k.'

                </td>

                <td align="center" style="padding:5px;">'.$title.'</td>

                <td align="center" style="padding:5px;">'.$unit.'</td>

                <td align="center" style="padding:5px;">'.$cat.'</td>

			</tr>';



			}



		}



	}

	

	if($stype=="REGULAR"){

		$sql1=resultnew("SELECT * FROM course WHERE semester='$semester' AND level<=$level AND (dept='$dept' || dept='ALL') AND stype='REGULAR' ORDER BY level DESC, courseCode ASC");

	}elseif($stype=="DIPLOMA"){

		$sql1=resultnew("SELECT * FROM course WHERE semester='$semester' AND level<=$level AND dept='$dept' AND stype='DIPLOMA' ORDER BY level DESC, courseCode ASC");

	}



	while($res=mysqli_fetch_array($sql1)){



		if(in_array($res[1],$pcos)==false){



		$n=$n+1;

        echo '<tr style="padding:5px; background-color:white;">

			 <td align="center" style="padding:5px;">['.$n.']</td>	

				<td align="left" style="padding:5px;">';



				echo '<input type="checkbox" name="'.$name.'" value="'.$res[1].'|'.$res[2].'|'.$res[3].'|'.$res[8].'" />'.$res[1];



            echo '</td>

                <td align="left" style="padding:5px;">'.$res[2].'</td>

                <td align="center" style="padding:5px;">'.$res[3].'</td>

                <td align="center" style="padding:5px;">'.$res[8].'</td>

			</tr>';



		}



	}



}



function listCoursesNewUp($dept,$level,$semester,$matricno,$session,$utyp,$stype="REGULAR"){



	//CHECK FOR CURRENT REGISTRATION



	$query=resultnew("SELECT course1, course2, course3, course4, course5, course6, course7, course8, course9, course10, course11, course12, course13, course14, course15, course16, course17, course18, course19, course20, app, rem FROM course_reg WHERE matricno='$matricno' AND semester='$semester' AND level=$level AND session='$session' ORDER BY id DESC LIMIT 0,1");



	$ret=mysqli_fetch_row($query);



	$cos=array();



	$c=0;



	foreach($ret as $val){



		$c+=1;



		if($c<21 && $val != "|||"){



			$split=explode("|",$val);



			$cos[]=$split[0];



		}



	}



	//checking for remark/comments



	if($ret[21]!=""){

		echo '<tr style="padding:5px; background-color:white; font-style:italic;">	



				<td colspan="5" align="center" style="padding:5px;">'; 



		$rem=explode("|",$ret[21]);



		foreach($rem as $r){



			$rexp=explode("+",$r);



			echo '<span style="color:#005BAA;">'.$rexp[0].':</span> '.$rexp[1].'<br />';



		}



		echo '</td>



			</tr>';



	}



	//CHECK FOR PREVIOUSLY REGISTERED COURSES



	$level2=$level-100;



	$pcos=listPCourses($level,$semester,$matricno);



	



	//CHECK FOR CARRY OVER COURSES



	$rpt=resultnew("SELECT oc FROM resulttable WHERE matricno='$matricno' ORDER BY id DESC LIMIT 0,1");



	list($oc)=mysqli_fetch_array($rpt);



	$n=0;



	$name='cos[]';



	if($oc!=""){



		$exp=explode("|",$oc);



		foreach($exp as $k){



			if($stype=="REGULAR"){

				$sql=resultnew("SELECT courseTitle,credit,cat FROM course WHERE courseCode='$k' AND semester='$semester' AND (dept='$dept' || dept='ALL') AND stype='REGULAR' ORDER BY id DESC LIMIT 0,1");

			}elseif($stype=="DIPLOMA"){

				$sql=resultnew("SELECT courseTitle,credit,cat FROM course WHERE courseCode='$k' AND semester='$semester' AND dept='$dept' AND stype='DIPLOMA' ORDER BY id DESC LIMIT 0,1");

			}



			$c=mysqli_num_rows($sql);



			if($c==1){



				list($title,$unit,$cat)=mysqli_fetch_array($sql);



				$n=$n+1;

                echo '<tr style="padding:5px; background-color:white;">

			 <td align="center" style="padding:5px;">['.$n.']</td>	

				<td align="left" style="padding:5px;">';

					$exdept=array("Medicine and Surgery","Dentistry");

					if($utyp==2 || (in_array($dept,$exdept) && $level>100)){

						echo '<input type="checkbox" name="'.$name.'" value="'.$k.'|'.$title.'|'.$unit.'|CO"';

						if(in_array($k,$cos)){ echo " checked"; }

						echo ' />';

					}else{

						echo '<input type="hidden" name="'.$name.'" value="'.$k.'|'.$title.'|'.$unit.'|CO" />';

						echo '<input type="checkbox" value="'.$k.'|'.$title.'|'.$unit.'|CO" checked disabled="disabled" />';



					}

					echo $k.'</td>

                <td align="left" style="padding:5px;">'.$title.'</td>

                <td align="center" style="padding:5px;">'.$unit.'</td>

                <td align="center" style="padding:5px;">'.$cat.'</td>

			</tr>';



			}



		}



	}



	if($stype=="REGULAR"){

		$sql1=resultnew("SELECT * FROM course WHERE semester='$semester' AND level<=$level AND (dept='$dept' || dept='ALL') AND stype='REGULAR' ORDER BY level DESC, courseCode ASC");

	}elseif($stype=="DIPLOMA"){

		$sql1=resultnew("SELECT * FROM course WHERE semester='$semester' AND level<=$level AND dept='$dept' AND stype='DIPLOMA' ORDER BY level DESC, courseCode ASC");

	}



	while($res=mysqli_fetch_array($sql1)){



		if(in_array($res[1],$pcos)==false && in_array($res[1],$exp)==false){



		$n=$n+1;

        echo '<tr style="padding:5px; background-color:white;">

			 <td align="center" style="padding:5px;">['.$n.']</td>	

				<td align="left" style="padding:5px;">';



			if($level==100){



				echo '<input type="hidden" name="'.$name.'" value="'.$res[1].'|'.$res[2].'|'.$res[3].'|'.$res[8].'" />';



				echo '<input type="checkbox" value="'.$res[1].'|'.$res[2].'|'.$res[3].'|'.$res[8].'" checked disabled="disabled" />'.$res[1];



			}else{



				echo '<input type="checkbox" name="'.$name.'" value="'.$res[1].'|'.$res[2].'|'.$res[3].'|'.$res[8].'"';



				if(in_array($res[1],$cos)){ echo " checked"; }



				echo ' />'.$res[1];



			}



            echo '</td>

                <td align="left" style="padding:5px;">'.$res[2].'</td>

                <td align="center" style="padding:5px;">'.$res[3].'</td>

                <td align="center" style="padding:5px;">'.$res[8].'</td>

			</tr>';

		}



	}//$ret[19]!=100 && 



	if($ret[20]!="APPROVED" || $utyp==2){



		echo '<tr style="padding:5px; background-color:white;">



				<td colspan="5" align="center" style="padding:5px;">';



				echo '<textarea class="form-control" id="remb" name="remb" style="width: 500px; height: 70px;" cols="15" rows="1" placeholder="Comment/Note/Remark"></textarea>';



				echo '<input type="hidden" name="rema" value="'.$ret[21].'" />';



				echo '</td>



			</tr>';



		if($utyp==2 && $ret[20]!="APPROVED"){



			echo '<tr style="padding:5px; background-color:white;">



					<td colspan="5" align="center" style="padding:5px;">



						<input type="hidden" name="session" value="'.$session.'" />



						<input type="hidden" name="semester" value="'.$semester.'" />



						<input type="checkbox" name="approved" value="APPROVED" />



						<strong>Check Here and Click Update to Approve this registration if satisfied</strong>



					</td>



				</tr>';



		}



		echo '<tr style="padding:5px; background-color:white;">



				<td colspan="5" align="center"><input type="reset" class="btn btn-warning" name="reset"  value="&nbsp;Clear&nbsp;"/>&nbsp;&nbsp;



				<input type="submit" class="btn btn-success" name="update" onclick="return confirm(\'Kindly review your record, Are you sure you want to Submit?\')"  value="&nbsp;Update Course Form!&nbsp;"  class="button" />				</td>



			</tr>';



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



function grade($cos,$grd){ //merge courses and corresponding scores



	$coses=explode("|",$cos);



	$scores=explode("|",$grd);



	$rec=array_combine($coses,$scores);



	return $rec;



}



function rGrade($score){

	if($score>=70){

		$grade="A";

	}elseif($score>=60){

		$grade="B";

	}elseif($score>=50){

		$grade="C";

	}elseif($score>=45){

		$grade="D";

	}else{

		$grade="F";

	}

	return $grade;

}





function studreg($matricno,$level,$sem,$sess){

	$checkQuery="select * from registration where matricno='$matricno' and session='$sess' and level=$level and sem='$sem' ORDER BY id DESC LIMIT 0,1";

	$checkResult=resultnew($checkQuery);

	$no=mysqli_num_rows($checkResult);

	if($no==0){

		$returnedRows=0;

	}else{

		$returnedRows=mysqli_fetch_array($checkResult);

	}

	return $returnedRows;

}





function studres($matricno,$level,$sem,$sess){

	$checkQuery="select * from resulttable where matricno='$matricno' and session='$sess' and level=$level and sem='$sem' AND rdate<>'NO' ORDER BY id DESC LIMIT 0,1";

	$checkResult=resultnew($checkQuery);

	$no=mysqli_num_rows($checkResult);

	if($no==0){

		$returnedRows=0;

	}else{

		$returnedRows=mysqli_fetch_array($checkResult);	

	}

	return $returnedRows;

}



function remexp($rem){



	switch($rem){



		case "C":



		$exp="Caution";



		break;



		case "P":



		$exp="Probation";



		break;



		case "EP":



		$exp="Extended Probation";



		break;



		case "AW":



		$exp="Academic Withdrawal";



		break;



		case "GS":



		$exp="Good Standing";



		break;



		default:



		$exp="Unknown";



		break;



	}



	return $exp;



}



function studentresult($matricno,$name,$faculty,$dept,$level,$sem,$sess){

	$ret=studres($matricno,$level,$sem,$sess);



	$regd=studreg($matricno,$level,$sem,$sess);



	$cos=explode("|",$regd[2]);



	$tt=grade($regd[2],$regd[5]); //array of total score



	$un=grade($regd[2],$regd[6]); //array of total score



			echo "<tr>";



				echo '<td colspan="6" align="left">';



					echo '<table align="center" width="100%" style="line-height:2.5em;">';



						echo "<tr>";



							echo '<td align="left" width="20%">&nbsp;<b>NAME:</b></td>';



							echo '<td align="left" width="80%" colspan="3" style="border-bottom:#000000 dotted 1px;">&nbsp;'.$name.'</td>'; 



						echo '</tr>';



						echo '<tr>



								<td align="left" width="15%">&nbsp;<b>MATRIC/REG. NO.:</b></b></td>



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;">&nbsp;'.$matricno.'</td> 



								<td align="left" width="15%"><b>SESSION:</b></td>				 



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$sess.'</td>



							</tr>';



							echo '<tr>



								<td align="left" width="15%">&nbsp;<b>PROGRAMME.:</b></td>



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;">&nbsp;'.$regd['dept'].'</td> 



								<td align="left" width="15%"><b>DEPARTMENT:</b></td>				 



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$regd['dept'].'</td>



							</tr>';



							echo '<tr>



								<td align="left" width="15%">&nbsp;<b>FACULTY.:</b></td>



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;">&nbsp;'.$regd['faculty'].'</td> 



								<td align="left" width="15%"><b>LEVEL:</b></td>				 



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$level.'</td>



							</tr>';



							echo '<tr>



								<td align="center" width="100%" colspan="4"><br /><strong>'.$sem.' SEMESTER RESULT</strong></td>



							</tr>';



					echo '</table>';



				echo '</td>';



			echo '</tr>';



			echo "<tr>";



				echo '<td align="left" colspan="6"><hr /></td>';



			echo '</tr>';



			echo "<tr>";



			echo '<td align="center" colspan="6" style="padding:10px 0px;">



				<table style="background-color:#666; line-height:2.5em; text-align:center;" width="100%">'; 



				$n=0;



				echo '<tr style="background-color:#fff; font-weight:bold;"><td align="right">COURSE CODE:-&nbsp;</td>';



				foreach($cos as $v){



					$n+=1;



					echo '<td>'.$v.'</td>';



				}



				echo '



				</tr>';



				echo '<tr style="background-color:#fff; font-weight:bold;"><td align="right">COURSE UNIT:-&nbsp;</td>';



				foreach($un as $k){



					echo '<td>'.$k.'</td>';



				}



				echo '



				</tr>';



				echo '<tr style="background-color:#fff; font-weight:bold;"><td align="right">SCORE:-&nbsp;</td>';



				foreach($tt as $i){



					echo '<td>'.$i.'('.rGrade($i).')</td>';



				}

				//present avg

				$eca=explode("|",$ret[21]);

				

				//previous avg

				if($ret[20]==""){

				    $cca1="0.00";

				}else{

				    $cca=explode("|",$ret[20]);

				    $cca1=sprintf('%0.2f',round(($cca[0]/$cca[1]),2));

				}

				

				

				//cummulative avg

				$tca=explode("|",$ret[22]);



				echo '



				</tr>



				<tr style="background-color:#fff;">



				<td colspan="'.($n+1).'">&nbsp;</td>



				</tr>';



				echo '<tr style="background-color:#fff;">



				<td>&nbsp;</td><td colspan="'.$n.'">



				<table width="100%">



				<tr>



				<td colspan="3" align="center"><strong>PREVIOUS</strong></td><td colspan="3" align="center"><strong>PRESENT</strong></td><td colspan="3" align="center"><strong>CUMMULATIVE</strong></td>



				</tr>



				<tr style="background-color:#fff;">



				<td align="center">TLU</td><td align="center">TCP</td><td align="center">AVG</td><td align="center">TLU</td><td align="center">TCP</td><td align="center">AVG</td><td align="center">CLU</td><td align="center">CCP</td><td align="center">CAVG</td>



				</tr>



				<tr style="background-color:#fff;">



				<td align="center">'.$ret[2].'</td><td align="center">'.$ret[3].'</td><td align="center">'.$cca1.'</td><td align="center">'.$ret[5].'</td><td align="center">'.$ret[6].'</td><td align="center">'.sprintf('%0.2f',round(($eca[0]/$eca[1]),2)).'</td><td align="center">'.$ret[8].'</td><td align="center">'.$ret[9].'</td><td align="center">'.sprintf('%0.2f',round(($tca[0]/$tca[1]),2)).'</td>



				</tr>



				</table>



				</td>



				</tr>';



				echo '<tr style="background-color:#fff;">



				<td colspan="'.($n+1).'">



				<table width="100%">



				<tr>



				<td width="25%">OUTSTANDING:-&nbsp;</td><td width="25%">'; 



					if($ret[12]!=""){



						echo implode(",",explode("|",$ret[12]));



					}else{



						echo "";



					}



				echo '</td><td width="25%"></td><td width="25%"></td>



				</tr>



				</table>



				</td>



				</tr>



				</table>



				</td>';



			echo '</tr>';



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

function credit($val){



	$rec=explode("|",$val);



	return $rec[2];



}



function type($val){



	$rec=explode("|",$val);



	return $rec[3];



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



function getSumPaid($matricno,$feetype,$session){

	$checkQuery="SELECT SUM(amount) FROM paymentinvoice WHERE matricno='$matricno' AND feetype='$feetype' AND session='$session' AND feestatus='PAID'";

	$checkResult=payconnect($checkQuery);

	$rows=mysqli_num_rows($checkResult);

	$recs=mysqli_fetch_array($checkResult);

	if($rows>=1){

		return $recs[0];

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

// to print course reg form

function printForm($matricno,$name,$faculty,$dept,$level,$session,$semester){



	



	$sql=resultnew("select course1, course2, course3, course4, course5, course6, course7, course8, course9, course10, course11, course12, course13, course14, course15, course16, course17, course18, course19, course20 from course_reg where matricno='$matricno' AND semester='$semester' AND session='$session' ORDER BY id DESC LIMIT 0,1");



	$retData=mysqli_fetch_row($sql);



			echo "<tr>";



				echo '<td colspan="6" align="left">';



					echo '<table align="center" width="100%">';



						echo "<tr>";



							echo '<td align="left" width="15%">&nbsp;<b>NAME:</b></td>';



							echo '<td align="left" width="35%"  style="border-bottom:#000000 dotted 1px;">&nbsp;'.$name.'</td>'; 

							

							echo	'<td align="left" width="15%">&nbsp;<b>MATRIC/REG. NO.:</b></b></td>';



							echo	'<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;">&nbsp;'.$matricno.'</td>'; 



						echo '</tr>';



						echo '<tr>



									<td align="left" width="15%">&nbsp;<b>FACULTY.:</b></td>



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;">&nbsp;'.$faculty.'</td>  



								<td align="left" width="15%">&nbsp;<b>SESSION:</b></td>				 



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$session.'</td>



							</tr>';



							echo '<tr>



								<td align="left" width="15%">&nbsp;<b>DEPARTMENT:</b></td>				 



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$dept.'</td>

								<td align="left" width="15%">&nbsp;<b>LEVEL:</b></td>				 



								<td align="left" width="35%" style="border-bottom:#000000 dotted 1px;" >&nbsp;'.$level.'</td>



							</tr>';



							echo '<tr>



							



								



							</tr>';



							echo '<tr>



								<td align="center" width="100%" colspan="4"><br /><br />'.$semester.' SEMESTER</td>



							</tr>';



					echo '</table>';



				echo '</td>';



			echo '</tr>';



			echo "<tr>";



				echo '<td align="left" colspan="6"><hr /></td>';



			echo '</tr>';



			echo '<tr>



				<td align="left" width="5%" style="border-bottom:#000000 solid 1px;"><b>S/N</b></td>



				<td align="left" width="10%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;"><b>Course Code</b></td>



				<td align="left" width="55%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;"><b>Course Title</b></td> 				 



				<td align="left" width="10%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;"><b>Unit</b></td>



				<td align="left" width="5%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;"><b>Status</b></td>



				



			</tr>';



			$sn=0;



			$tu=0;



			echo '<div style="line-height:1.8em;">';



	foreach($retData as $val){



		if($val != "|||"){



			$sn+=1;



			$split=explode("|",$val);



			$tu+=$split[2];



		

			echo "<tr>";



				echo '<td align="left" width="5%" style="border-bottom:#000000 solid 1px;">&nbsp;['.$sn.']</b></td>';



				echo '<td align="left" width="10%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.$split[0].'</td>'; 



				echo '<td align="left" width="55%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.$split[1].'</td>'; 				 



				echo '<td align="left" width="10%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.$split[2].'</td>';



				echo '<td align="left" width="5%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;'.$split[3].'</td>';



			//	echo '<td align="left" width="15%" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">'; 



				//	if($signature!=""){



				//		echo '<img src="../signatures/'.$signature.'" width=70px; height=25px; />';



			//		}



		//	echo '</td>';



		//	echo '</tr>';



		}



	}



	echo '</div>';



			echo "<tr>";



				echo '<td align="right" colspan="3" style="border-bottom:#000000 solid 1px;"><b>Total Number of Units</b></td>';



				echo '<td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;"><b>'.$tu.'</b></td>



				<td align="left" style="border-bottom:#000000 solid 1px;border-left:#000000 solid 1px;">&nbsp;</td>



				



				';



			echo '</tr>';



			echo "<tr>";



				echo '<td align="center" colspan="6" style="padding:10px 0px;">&nbsp;</td>';



			echo '</tr>';



			echo "<tr>";



				echo '<td align="center" colspan="6">



				<table width="100%">';

                echo "<tr>";



				echo '<td align="center"  style="border-bottom:#000000 dotted 1px;" valign="bottom">

                    '.strtoupper($name).'</td>

                        <td width="5%">&nbsp;</td>';



				echo '<td align="center"  style="border-bottom:#000000 dotted 1px;" valign="bottom">';

                   // $advisersign=adviserSign($dept,$level,$semester,$session);

                  //  if(!empty($advisersign)){

                   //     if($advisersign[1]!=""){

                        //    echo '<img src="../signatures/'.$advisersign[1].'" width=70px; height=25px; /><br />';

                      //  }

                     //   echo strtoupper($advisersign[0]);

                   // }

                    

                    '</td>';



			echo '</tr>';

    



			echo "<tr>";



				echo '<td align="center"><b>Student\'s Name/Sign./Date</b></td><td width="5%">&nbsp;</td>';



				echo '<td align="center"><b>Course Adviser\'s Name/Sign./Date</b></td>';



			echo '</tr>';



			echo "<tr>";



				echo '<td align="center" colspan="3" style="padding:10px 0px;">&nbsp;</td>';



			echo '</tr>';

			echo "<tr>";



				if($dept=="Nursing Science"){



					echo '<td align="center">&nbsp;</td><td width="5%">&nbsp;</td>';



				}else{



					echo '<td align="center"   style="border-bottom:#000000 dotted 1px;" valign="bottom">';

                   // $hodSignature=hodDeanSign($dept,1);

                  //  if(!empty($hodSignature)){

                    //    if($hodSignature[2]!=""){

                    //        echo '<img src="../signatures/'.$hodSignature[2].'" width=70px; height=25px; /><br />';

                    //    }

                     //   echo strtoupper($hodSignature[0]);

                     //   echo '<span style="font-style: italic; font-size: 8px;">('.$hodSignature[1].')</span>';

                 //   }

              //      echo '</td><td width="5%">&nbsp;</td>';



				}



                echo '</td>';

               



			echo '</tr>';

    

            echo "<tr>";



				if($dept=="Nursing Science"){



					echo '<td align="center">&nbsp;</td><td width="5%">&nbsp;</td>';



				}else{



					echo '<td align="center"><b>HOD\'S Name/Sign./Date</b></td><td width="5%">&nbsp;</td>';



				}



				echo '<td align="center" style="border-top:#000000 dotted 1px;" valign="bottom"><b>Dean\'s Name/Sign./Date</b></td>';



			echo '</tr>';



			echo "<tr>";



				echo '<td align="center" colspan="3" style="padding:5px 0px;">&nbsp;</td>';



			echo '</tr>';





			echo '</table>



				</td>';



			echo '</tr>';



}

// end of function to print course reg form

?>