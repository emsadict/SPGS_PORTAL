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
    $title=$brec['title'];
    $date=$brec['refDate'];
	


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
</style>


<div id="waterMark"><img src="images/bglogo.jpg" width="400" height="553"></div>
<div style="position:absolute; overflow:hidden; left:82%; top:100px; z-index:18; border: 1px solid #000000;">
</div>
<div class=WordSection1>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><b><span
style='font-size:14.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
UNIVERSITY OF MEDICAL SCIENCES, ONDO CITY, ONDO STATE</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>POSTGRADUATE SCHOOL</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
line-height:normal'><span style='font-size:10.0pt;font-family:"Tahoma",sans-serif'><img src="images/logo.jpg" width="80" align="bottom"/><br /></span></p>
<br />
<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>DEAN:</span></b><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>  Prof. W. O. Adebimpe
 Ph.D, FWACP</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Telephone: 08033712662</b></span>
 <a href="mailto:pgschool@unimed.edu.ng"><span style='font-size:10.0pt;font-family:
"Tahoma",sans-serif'><b>email:</b>pgschool@unimed.edu.ng</span></a></p>
 </p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;text-indent:.5in;line-height:normal'><span style='font-size:
10.0pt;font-family:"Tahoma",sans-serif'></span></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
style='font-size:6.0pt;font-family:"Tahoma",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>SECRETARY:</span></b><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>    Mrs. Folasade R. Awopeju B.Sc(Ado), MSc(JABU)</span><i><span
style='font-size:9.0pt;font-family:"Tahoma",sans-serif'></span></i><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>     <b>e-mail: fawopeju@unimed.edu.ng</b></span>
</p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>MNIM, MANUPA</span></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span style='position:absolute;z-index:251657216;margin-left:13px;margin-top:20px;
width:793px;height:1px'><img width=793 height=1
src="MASTER%20PHYSIOTHERAPY%20EXERCISE_files/image002.png"></span><span
style='position:absolute;z-index:251658240;margin-left:-84px;margin-top:22px;
width:796px;height:1px'><img width=796 height=1
src="MASTER%20PHYSIOTHERAPY%20EXERCISE_files/image003.png"></span><span
style='font-size:10.0pt;font-family:"Tahoma",sans-serif'>                 </span></p>

<p class=MsoNormal style='margin-bottom:0in'><span style='font-size:10.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>                          </span></p>
<hr />
<p class=MsoNormal style='margin-bottom:0in'><b><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>UNIMED/PGS/ADM/25/10                                  Date:
<?php echo "$date"; ?></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
style='font-size:12.0pt'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>Dear, &nbsp;<?php echo $surname .' '.$onames; ?></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>(<?php echo $user; ?>)</span></b></p>

<p class=MsoNormal style='margin-bottom:0in'><b><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
OFFER OF PROVISIONAL ADMISSION INTO THE <?php echo strtoupper(($programme)); ?> PROGRAMME </span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(<?php echo "$session" ; ?>&nbsp;ACADEMIC SESSION)</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify;line-height: normal'><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>
With reference to your application for admission into the <?php echo ucfirst(($programme)); ?> Programme in the
University of Medical Sciences, Ondo, it is my pleasure to inform you that you
have been offered provisional admission to pursue an academic programme leading
to the award of <b><?php echo "$title" ; ?> in  <?php
if ($dept == 'MPH-Epidemiology and Biostatistics') {
    echo 'MPH in Epidemiology and Biostatistics';
} elseif ($dept == 'MPH-Population, Family and Reproductive Health') {
    echo 'Population, Family and Reproductive Health';
} elseif ($dept == 'MPH-Environmental & Occupational Health') {
    echo 'Environmental & Occupational Health';
} elseif ($dept == 'MPH-Health Promotion and Behavioural Sciences') {
    echo 'Health Promotion and Behavioural Sciences';
} elseif ($dept == 'MPH-Health Policy and Management') {
    echo 'Health Policy and Management';
} else {
    echo $dept;
}
?>
</b>with
effect from the <b><?php echo "$session" ; ?>  </b>Academic Session.</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:115%;font-family:
"Tahoma",sans-serif'>
Please take note of the following conditions, which are related to your admission and registration:</span></p>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:115%;font-family:
"Tahoma",sans-serif'>
(1)This offer of admission is strictly provisional and may be revoked if: </span></p>

<p class=MsoNormal style='margin-left:.75in;text-indent:-.25in'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(a) you fail to formally accept this offer by paying the non-refundable acceptance fee of <b>eighty
thousand naira (<s>N</s>80,000.00) only, on or before the 17th October, 2025</b></span></p>

<p class=MsoNormal style='margin-left:.5in'><span style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(b) <b>You are unable to pay</b> School fee of<b> two
hundred and eighty-two thousand naira only  (<s>N</s>282,000.00)</b> and other
charges before the deadline for payment. 
All payments MUST be made online through </span><a href="http://www.unimed.edu.ng"><span style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>www.unimed.edu.ng</span></a></p>

<p class=MsoNormal style='margin-left:.75in;text-indent:-.25in'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(c) You are unable to satisfy the necessary requirements for admission and registration. </span></p>

<p class=MsoNormal style='margin-left:.75in;text-indent:-.25in'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(d) You cannot produce at the time of registration, the original copies of your O’level
certificate and other academic credentials. </span></p>
<p class=MsoNormal style='margin-left:.75in;text-indent:-.25in'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(e) First Semester commences on 27th, October, 2025, </span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>
(2) The programme is on <b>Full-Time basis</b>. The duration of your course is <b>
	three(3) Academic Semesters</b> and other conditions relating to it, are as contained in the
Postgraduate School’s prospectus.</span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
line-height:115%;font-family:"Tahoma",sans-serif'>
(3) If you accept this offer, please comply with the following procedure for registration: </span></p>

<p class=MsoNormal style='margin-left:1.0in;text-align:justify;text-indent:
-.5in'><span style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(a) Payment of all fees must be made before <b>23rd January, 2026</b> for payment as provisional offer of admission will lapse thereafter. </span></p>

<p class=MsoNormal style='margin-left:1.0in;text-align:justify;text-indent:
-.5in'><span style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
(b)It is <b>mandatory</b> that you appear physically for clearance at the Admissions
office of the postgraduate school. If within six (2) weeks from the date on
this letter, you have neither completed and returned the printed acceptance
forms nor submitted the originals of your credentials for clearance, this offer
will be revoked and your slot will be given to someone else.</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>PLEASE
NOTE THAT IF IT IS DISCOVERED AT ANY POINT THAT YOU DO NOT POSSESS ANY OF THE
QUALIFICATIONS WHICH YOU CLAIM TO HAVE OBTAINED, OR YOU REFUSE TO SUBMIT THE
TRANSCRIPT OF YOUR UNIVERSITY DEGREES, THE ADMISSION WILL BE WITHDRAWN IMMEDIATELY. </span></b></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>Please
accept my congratulations on behalf of the University. </span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>
Yours sincerely,</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><span
style='font-size:12.0pt;line-height:115%;font-family:"Tahoma",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify'><img border=0
width=157 height=84 id="Picture 1" src="<?php echo'images/DR_SIGN2.jpg' ?>"></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>Mrs. Folasade R. Awopeju</span></b></p>

<p class=MsoNormal style='margin-bottom:0in;text-align:justify;line-height: normal'>
<span style='font-size:12.0pt;font-family:"Tahoma",sans-serif'>
PAR/Secretary, Postgraduate School</span></p>

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