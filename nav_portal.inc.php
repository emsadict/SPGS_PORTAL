<nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="basicInfo.php">BioData</a></li>
          <li><a class="nav-link scrollto" href="academicInfo.php">Academic Record</a></li>
			<?php
			if(searchRecord("spgs_acad_rec","regno",$_SESSION['spgs_auth'][1])!=0 && searchRecord("spgs_acad_rec","regno",$_SESSION['spgs_auth'][1])!=0){
				echo '<li><a class="nav-link scrollto" href="spgs_slip.php" target="_blank">Print Slip</a></li>';
			}
			?>
          <li><a class="nav-link scrollto" href="portal_logout.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->