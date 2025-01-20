<?php

  session_start();

 include_once("fun.inc.php");
 if(!isset($_SESSION['spgs_auth'])){

    header("location: portal_login.php");

    

  }elseif(searchRecord("Screened_Candidates_2022","regno",$_SESSION['spgs_auth'][1])==0 || searchRecord("Screened_Candidates_2022","regno",$_SESSION['spgs_auth'][1])==0){

      echo ("<script LANGUAGE='JavaScript'>

    window.alert('You have to complete your screening');

    window.location.href='basicInfo_admitted.php';

    </script>");

    header("location: portal_login.php");

    

  //  header("location: $_SERVER[HTTP_REFERER]");

  }else{

    $spgs_auth=$_SESSION['spgs_auth'];

    $user=$spgs_auth[1]; }
 


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ACADEMIC RECORD - SCHOOL OF POSTGRADUATE::University of Medical Sciences, Ondo</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mamba - v4.7.0
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="index.php"><img src="assets/img/unimed_banner_pgschool.png" /></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <?php require('adm_nav_portal.inc.php'); ?>
    </div>
  </header><!-- End Header -->


  <main id="main">
   

 <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h3>POST GRADUATE STUDENTS CARRYOVER COURSE REGISTRATION PORTAL</h3>
        </div>

          <center>
        <div class="row" align="center" style="text-align: center;">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300" align="center">
<form action="carry_over_practice.php" target="_BLANK" method="post" name="formcheck" onsubmit="return formCheck(this);" role="form" class="php-email-form">
      <?php
        if(isset($message)){
          echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">
              '.$message.'
              </div>';
        }
        if(isset($_REQUEST['message'])){
          echo '<div class="form-group" style="text-align: center; font-weight: bold; font-style: italic; color: #F00;">
              '.$_REQUEST['message'].'
              </div>';
        }
      ?>
              <div class="row text-center">
                <div class="col-lg-12 form-group">
          <label for="session">Session</label>
                  <select class="form-control" required name="session" id="session">
                      <option value="">--SELECT--</option>
                      <option value="2021/2022">2021/2022</option>
                      <option value="2022/2023">2022/2023</option>
                      
                 <!--     <option selected>'.$prog.'</option> -->
                  </select>
                </div>
              </div>
        <div class="row text-center">
                <div class="col-lg-12 form-group">
          <label for="level">Level/Programme</label>
                  <select class="form-control" required name="level" id="level">
                      <option value="">--SELECT--</option>
                      <option value="700">700</option>
                      <option value="800">800</option>
                      <option value="Mphil">Mphil</option>
                      <option value="Mphil/PhD">Mphil/PhD</option>
                      <option value="900">900</option>
              <!--       <option selected>'.$prog.'</option> -->
            </select>
                </div>
              </div>

         <div class="col-lg-12 form-group">
          <label for="semester">Semester</label>
          <select class="form-control" required name="semester" id="semester">
            <option value="">--SELECT--</option>
            <option value="FIRST">FIRST</option>
            <option value="SECOND">SECOND</option>
    <!--        <option selected>'.$prog.'</option>  -->
          </select>

</br>
              <div class="text-center"><button type="submit" name="checkresult" onclick="return confirm('Kindly review your record, Are you sure you want to Submit?')">SUBMIT</button>
              </div>
            </form>
          </div>

        </div>

      </div></center>
    </section><!-- End Contact Us Section -->




    </main>
 

            <?php

            include_once("footer.inc.php");

            ?>


    

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



</body>

</html>
