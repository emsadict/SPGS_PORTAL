<nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          
            <li class="dropdown"><a href="#"><span>Student Data</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a class="nav-link scrollto" href="basicInfo_admitted.php">Bio Data</a></li>
              <li><a class="nav-link scrollto" href="portal_academicInfo.php">Academic Records</a></li>
              <li><a class="nav-link scrollto" href="other_information.php">Other Information</a></li>
            
            <!--   <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a> -->
                <ul>
               <!--    <li><a class="nav-link scrollto" href="portal_academicInfo.php">Academic Record</a></li> -->
                   <!--
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li> -->
                </ul>
                <!--
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li> -->
            </ul>
          </li>


     <!--     <li><a class="nav-link scrollto" href="basicInfo_admitted.php">BioData</a></li> 
          <li><a class="nav-link scrollto" href="portal_academicInfo.php">Academic Record</a></li> 
          <li><a class="nav-link scrollto" href="other_information.php">Other Information</a></li>-->
          <li><a class="nav-link scrollto" href="courseregistration.php">Course Registration</a></li>
                     

		<!--
		<?php
		//	if(searchRecord("spgs_basicinfo","regno",$_SESSION['spgs_auth'][1])!=0 && searchRecord("spgs_basicinfo","regno",$_SESSION['spgs_auth'][1])!=0){
		//		echo '<li><a class="nav-link scrollto" href="spgs_slip.php" target="_blank">Print Slip</a></li>';
		
	//	if(searchRecord("course_reg","matricno",$_SESSION['spgs_auth'][1])!=0 && searchRecord("course_reg","matricno",$_SESSION['spgs_auth'][1])!=0){
	//			echo '<li><a class="nav-link scrollto" href="spgs_coursereg_slip.php" target="_blank">Print Course Reg Slip</a></li>';
		//	}
		//	?>
		-->
		<?php
		$ret=getRecs("Screened_Candidates_2022","regno",$user);
    	$admrec=getRecs("Screened_Candidates_2022","regno",$user);
    	$level=$admrec['level'];
    	$coursereg=getRecs("course_reg","matricno",$user);
    	$dept=$admrec['dept'];
    	$session=$admrec['session'];
        $semester=$admrec['semester'];
		
		
			if(checkIfExist($user,$semester,$level,$session,$coursereg)==1){
				echo '<li><a class="nav-link scrollto" href="course_reg_Reg.php" target="_blank">Print Course Reg Slip</a></li>';
			}
		?>
	<!--	//check result -->
		
		<?php
		
		if(searchRecord("resulttable","matricno",$_SESSION['spgs_auth'][1])!=0 && searchRecord("resulttable ","matricno",$_SESSION['spgs_auth'][1])!=0){
				echo '<li><a class="nav-link scrollto" href="resultChecker.php" target="_blank">Check Result</a></li>';
		}
			?>
		
		<!--- result check -->
          <li><a class="nav-link scrollto" href="portal_logout.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->