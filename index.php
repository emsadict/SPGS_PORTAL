
<!DOCTYPE html>
<html lang="en">

<head>
<style>
#more {display: none;}


.flex-container {
  display: flex;
  background-color: DodgerBlue;
 
  width:350px;
}

.flex-container > div 
{
  
  background-color: #f1f1f1;
  margin: 10px;
  padding: 20px;
  font-size: 30px;
  
}

.countdown-container {
  display: flex;
  flex-wrap: wrap;
}



#timehead{
  font-size: 2rem;
  font-weight: bold;
  margin-top: 1.5rem;
  align-content: center;
  text-align: center;
  
}
.countdown-container {
  display: flex;
  flex-wrap: wrap;
}
.big-text{
  font-weight: bold;
  font-size: 5rem;
  line-height: 1;
  margin: 0 2rem;
}
.countdown-el{
  text-align: center;

}
.countdown-el span{
  text-align: 2rem;

}

.bodytimer{
  background-color: red;
  background-size: cover;
  background-position: center center;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-items: center; 
  min-height: 20vh;
  font-family: "poppins", sans-serif;
  margin: 0;
}
 


 
</style>


  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SCHOOL OF POSTGRADUATE STUDIES::University of Medical Sciences, Ondo</title>
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

      <?php require('nav.inc.php'); ?>

    </div>
   
    
    
    
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url('assets/img/slide/slide-1.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Welcome to <span> POSTGRADUATE SCHOOL</span></h2>
                <p class="animate__animated animate__fadeInUp">University of Medical Sciences, Ondo City, Ondo State</p>
                <a class="btn btn-primary" href="https://www.unimed.edu.ng/portal/payment_spgs_app.php">APPLY HERE</a>
                <a class="btn btn-success" href="https://spgs.unimed.edu.ng/portal_login.php">STUDENT LOGIN</a>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url('assets/img/slide/slide-2.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Welcome to <span>POSTGRADUATE SCHOOL</span></h2>
                <p class="animate__animated animate__fadeInUp">University of Medical Sciences, Ondo City, Ondo State</p>
                <a class="btn btn-primary" href="https://www.unimed.edu.ng/portal/payment_spgs_app.php">APPLY HERE</a>
                <a class="btn btn-success" href="https://spgs.unimed.edu.ng/portal_login.php">STUDENT LOGIN</a>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url('assets/img/slide/slide-3.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Welcome to <span>POSTGRADUATE SCHOOL</span></h2>
                <p class="animate__animated animate__fadeInUp">University of Medical Sciences, Ondo City, Ondo State</p>
                <a class="btn btn-primary" href="https://www.unimed.edu.ng/portal/payment_spgs_app.php">APPLY HERE</a>
                <a class="btn btn-success" href="https://spgs.unimed.edu.ng/portal_login.php">STUDENT LOGIN</a>
              </div>
            </div> 
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->
 
  <main id="main">
      <div class="p-3 mb-2 bg-primary text-white" > <center> <h2>Applications are invited from qualified candidates for admission into the Postgraduate (Doctorate) Programme of the University of Medical Sciences, Ondo in the 2023/2024 Academic Session.</h2></center>
      
    <!--  <center> <a class="btn btn-outline-light" href="https://spgs.unimed.edu.ng/programmes.php" target="_BLANK" style="text-align:center;" >VISIT ADVERT PAGE</a></center></br> -->
     <center> <a class="btn btn-outline-light" href="https://spgs.unimed.edu.ng/nursing_sports_advert.php" target="_BLANK" style="text-align:center;" >VISIT ADVERT PAGE</a></center></br>
      
      
       <!-- ======= TIMER SECTION ======= -->
     
       <div class="bodytimer">
<h2 id="timehead">APPLICATION AVAILABLE FOR NURSING(PGDNE, MSc, AND PhD), SPORTS AND EXERCISE MEDICINE(PGD AND MSC) AND SPORTS AND EXERCISE SCIENCE(PGD AND MSC)<BR/> AND DOCTORATE PROGRAMMES</h2>

</div>


</div>
    <!-- ======= About Us Section ======= -->
    
    
<section id="about" class="about">
<div class="container" data-aos="fade-up">
<div class="row no-gutters">
<div class="section-title" style="padding-bottom: 0px; margin-bottom: 0px; padding-top: 20px;"> 
<center>

<div class="flex-container ">
  <div>
  <div class="card"  style="320px  " >
  <img class="card-img-top" src="pg_docs/ViceChancellor.jpg" alt="Card image">
  <div class="card-body" >
    <h5 class="card-title">Adesegun Olayiwola FATUSI</h5>
    <h6 class="card-text">B.Sc, MBChB, MPH, FWACP.</h6>
     <h6 class="card-text">Vice Chancellor</h6>
 <!--   <a href="#" class="btn btn-primary">See Profile</a> -->
 </div>
 </div>        
    </div>
   
<br /> <br />

<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}

</script>


 <br /> <br />
</center>
  <h2>The Vice Chancellor's Speech</h2>
  <p style="display:block ">
                  In December 2014, a new star – University of Medical Sciences (UNIMED), Ondo – appeared in the firmament of the Nigerian tertiary education system! Proudly Nigeria’s first specialized Medical and Health Sciences University, UNIMED has, indeed, been blazing the trail and redefining the landscape of medical and health sciences education.  
                  With our eyes firmly fixed on our mission of providing “integrated education and research of exceptional quality in all health-related sciences, UNIMED has become the university with the largest collection of medical and health-related courses and fast approaching our dream as a “one-stop” institution for all medical and health sciences training programmes- the first ever in Nigeria.  
                  The 2021 ranking of the National Universities Commission validates the courageous vision and efforts of the institution as the third-highest ranked specialized university in Nigeria and the best ranked of the growing number of specialized medical and health sciences universities. 
                  Truly, we can beat our chest as the “The First and the Best”.<span id="dots">...</span><span id="more">

Yet we are not at our destination and we will not rest on our oars till we achieve the great vision of our founding fathers “to be a thriving medical and health sciences University, locally, national and internationally recognized for excellence and innovation. 
“One of the next dimensions of our development agenda is the full realization of quality postgraduate education. 
As Stefan Collini posits in his book, “What are Universities for?, the University is a “knowledge and human-resource industry” that specializes in two kinds of product – high-quality multi-skilled units of human capacity” and “commercially relevant, cutting-edge new knowledge in user-friendly packages of printed materials”.  
We recognize the primacy of postgraduate education in expanding the frontiers of knowledge and advancing human development, and we are intentional about the type of postgraduate education we intend to run. 
We intend that our programme will serve as an intellectual hub for cultivating innovative ideas, advancing basic and applied, and shaping evidence-based policies geared at positively transforming our nation and world. 
Thus, as an institution, postgraduate education provides us with a great platform to increasingly accomplish ouragenda of “Touching lives, and making impacts”, as our University anthem states.
Thus, our desire is not to produce people with higher “paper degrees” and theoretical knowledge. 
Rather, through our postgraduate education, we aim to expand our horizon in the production of highly skilled and creatively-minded health scientists and health professionals with the ability to significantly contribute to national and global development through sound, credible, and ethical research and scientific endeavours.

Dating back to the days of the pioneer Vice-Chancellor, Prof Friday Okonofua FAS, FAAS, who established the Postgraduate School, UNIMED has held the dream of establishing postgraduate programmes dear to its heart. 
Building on the foundation inherited, we have invested significantly towards ensuring a sound implementation framework for postgraduate education and fashioning out the programmes. 
I am glad that these efforts are now yielding the desired fruits.  Our School of Public Health, the first full-fledged School of Public Health in Nigeria, kicked the ball rolling with the commencement of its postgraduate diploma programme in 2021.  Our first set of students for Masters of Public Health commenced lectures in May 2022. 
Students in our various M.Sc. and doctorate programmes will soon be joining them, shortly. 
Our Institute of Advanced Clinical Science Education has also virtually completed the development of the curricula for the PhD degree in several fields of Medicine and Dentistry, which are aimed at addressing the yawning gap in Nigeria’s medical education field.
I am confident that our postgraduate programmes will all be operated in line with our overarching philosophy of “excellence or nothing”.
No doubt, our postgraduate programmes will bear the classical mark of the “UNIMED advantage”: providing high-quality education that responds positively to the global dynamics of the 21st Century educational and development landscape, and operates in a steady environment of uninterrupted academic sessions, thereby ensuring timely graduation of high-impact graduates.<br />
<strong>Professor Adesegun O. Fatusi</strong><br />
Vice-Chancellor</span></p><br />
<button onclick="myFunction()" id="myBtn" class="btn btn-primary">Read more</button>

 </p>
 <br />
 <center>
 <div class="flex-container">
 
<div class="card"  style="width:320px; " >
<img class="card-img-top" src="pg_docs/unimed_acs_137.jpg" alt="Card image">
<div class="card-body" >
    <h5 class="card-title">Prof.  Asuzu Michael Chiemeli </h5>
    <h6 class="card-text">FMCPH,MBBS,M.Sc,DOH&S,FFPHM,MD</h6>
     <h6 class="card-text">Dean, UNIMED Postgraduate School</h6> 
 <!--   <a href="#" class="btn btn-primary">See Profile</a> -->
 </div>
 </div> 

 </div>
 </center>
 
</div>       
			<div class="section-title" style="padding-bottom: 0px; margin-bottom: 0px; padding-top: 20px;">
              <h2>UNIMED ADVANTAGE</h2>
      </div>

    <div class="col-lg-6 d-flex flex-column justify-content-center about-content" style="padding-top: 0px; margin-top: 0px;">
    <d iv data-aos="fade-up" data-aos-delay="100">
				<ol class="openapp" style="list-style-type: none; padding-left: 0px;">
					<li><span class="adv">&rarr;</span>Standalone and highly resourceful School of Public health</a></li>
			  	<li><span class="adv">&rarr;</span>Uninterrupted Academic Calendar</a></li>
		  		<li><span class="adv">&rarr;</span>Blended Learning System</a></li>
	  			<li><span class="adv">&rarr;</span>2 Weeks didatic physical contact on approved leave</a></li>
					<li><span class="adv">&rarr;</span>Opportunity for specialization</a></li>
					<li><span class="adv">&rarr;</span>Multidisciplinary research and community services</a></li>
					<li><span class="adv">&rarr;</span>PGD for science, allied and related BSc and HND graduates</a></li>
					<li><span class="adv">&rarr;</span>Teachers as educators</a></li>
					<li><span class="adv">&rarr;</span>Critical thinking and participatory problem solving teaching approach, and not just the traditional  teaching methods</a></li>
				</ol>
    </div>
    </div>
		<div class="col-lg-6 d-flex flex-column justify-content-center about-content" style="padding-top: 0px; margin-top: 0px;">
    <div data-aos="fade-up" data-aos-delay="100">
      <ol class="openapp" style="list-style-type: none; padding-left: 0px;">
			 <li><span class="adv">&rarr;</span>Capstone based reports, projects, practicum and postings where applicable</a></li>
			 <li><span class="adv">&rarr;</span>Workplace tailored practicum</a></li>
			 <li><span class="adv">&rarr;</span>Adequate and timely Supportive supervision</a></li>
			 <li><span class="adv">&rarr;</span>Affordable school fees</a></li>
			 <li><span class="adv">&rarr;</span>Public Health skills center</a></li>
			 <li><span class="adv">&rarr;</span>Centralized and accessible teaching centers</a></li>
			 <li><span class="adv">&rarr;</span>Adequate library and internet facilities with tailored access</a></li>
			 <li><span class="adv">&rarr;</span>International certification</a></li>
			 <li><span class="adv">&rarr;</span>Opportunity for internal and external  collaborations and partnership, conferences, workshops</a></li>
			</ol>
    </div>
    </div>


    </div>
    </div>
  </section><!-- End About Us Section -->
   
  </main><!-- End #main -->

  <?php require('footer.inc.php'); ?>

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