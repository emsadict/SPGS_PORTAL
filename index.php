<!DOCTYPE html>
<html lang="en">
<head>
<style>
#more {display: none;}
.flex-container { display:flex; background-color:DodgerBlue; width:350px; }
.flex-container > div { background-color:#f1f1f1; margin:10px; padding:20px; font-size:30px; }
.countdown-container { display:flex; flex-wrap:wrap; }
#timehead{ font-size:2rem; font-weight:bold; margin-top:1.5rem; text-align:center; }
.big-text{ font-weight:bold; font-size:5rem; line-height:1; margin:0 2rem; }
.countdown-el{ text-align:center; }
.countdown-el span{ text-align:2rem; }
.bodytimer{ background-color:red; background-size:cover; background-position:center center; display:flex; flex-direction:column; align-items:center; justify-items:center; min-height:20vh; font-family:"poppins", sans-serif; margin:0; }
.card-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center; /* Optional: center the cards */
  margin-top: 20px;
}

.card {
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  width: 300px;
  box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.card img {
  width: 100%;
  height: auto;
  border-bottom: 1px solid #eee;
}

.card-body {
  padding: 15px;
  text-align: center;
}

.card-body h5 {
  margin: 10px 0;
  font-size: 18px;
}

.card-body p {
  font-size: 14px;
  color: #555;
}

.btn {
  display: inline-block;
  margin-top: 10px;
  padding: 8px 12px;
  background-color: #0073aa;
  color: #fff;
  text-decoration: none;
  border-radius: 4px;
}
.btn:hover {
  background-color: #005f8d;
}
</style>
<?php include('fun.inc.php'); ?>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>SCHOOL OF POSTGRADUATE STUDIES::University of Medical Sciences, Ondo</title>
<meta content="" name="description">
<meta content="" name="keywords">

<link href="assets/img/favicon.ico" rel="icon">
<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <div class="logo me-auto">
        <h1><a href="index.php"><img src="assets/img/unimed_banner_pgschool.png" /></a></h1>
      </div>
      <?php require('nav.inc.php'); ?>
    </div>
  </header>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
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
  </section>

  <main id="main">
    <div class="p-3 mb-2 bg-primary text-white">
      <center><h2>Applications are invited from qualified candidates for admission into the Postgraduate (Doctorate) Programme of the University of Medical Sciences, Ondo in the 2025/2026 Academic Session.</h2></center>
      <center><a class="btn btn-outline-light" href="https://spgs.unimed.edu.ng/applynow.php" target="_BLANK" style="text-align:center;">VISIT ADVERT PAGE</a></center><br>

      <div class="bodytimer">
        <h2 id="timehead">APPLICATION AVAILABLE FOR POSTGRADUATE DIPLOMA, MASTERS,  AND DOCTORATE PROGRAMMES FOR 2025/2026 ACADEMIC SESSION WILL SOON BE PLACED</h2>
      </div>
    </div>
<section id="" class="about">
    <div class="container" data-aos="fade-up">
        
              
                  <?php
                  $api_url = 'https://spgs.unimed.edu.ng/blog/wp-json/wp/v2/posts?_embed';
                  $response = file_get_contents($api_url);
$posts = json_decode($response, true);

echo "<div class='card-container'>";
foreach ($posts as $post) {
    $title = $post['title']['rendered'];
    $link = $post['link'];
    $content = strip_tags($post['content']['rendered']);
    $words = implode(' ', array_slice(explode(' ', $content), 0, 20)) . '...';

    // Get featured image if available
    $image_url = '';
    if (isset($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
        $image_url = $post['_embedded']['wp:featuredmedia'][0]['source_url'];
    }

    echo "<div class='card'>";
    if ($image_url) {
        echo "<img src='$image_url' alt='Post Image' style='width:70%; height:auto; border-radius:8px;'>";
    }
    echo "<div class='card-body'>";
    echo "<h5>$title</h5>";
    echo "<p>$words</p>";
    echo "<a href='$link' class='btn' target='_blank'>Read More</a>";
    echo "</div></div>";
}
echo "</div>";
?>
               
              </div>
           
    
    
</section>
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="row no-gutters">
          <divclass="section-title" style="padding-bottom:0;margin-bottom:0;padding-top:20px;">
            <center>
              <br><br>
            
              <br><br>
            </center>

            <center>
              <div class="flex-container">
                <div class="card" style="width:320px;">
                  <img class="card-img-top" src="pg_docs/unimed_acs_137.jpg" alt="Card image"><div class="card-body">
                    <h5 class="card-title">Prof.  W</h5>
                    <h6 class="card-text">FMCPH,MBBS,M.Sc,DOH&S,FFPHM,MD</h6>
                    <h6 class="card-text">Dean, UNIMED Postgraduate School</h6>
                  </div>
                </div>
              </div>
            </center>
          </div>

          <div>
            <div>
              <div class="section-title" style="padding-bottom:0;margin-bottom:0;padding-top:20px;">
                <h2>UNIMED ADVANTAGE</h2>
              </div>

              <div class="col-lg-6 d-flex flex-column justify-content-center about-content" style="padding-top:0;margin-top:0;">
                <div data-aos="fade-up" data-aos-delay="100">
                  <ol class="openapp" style="list-style-type:none;padding-left:0;">
                    <li><span class="adv">&rarr;</span>Standalone and highly resourceful School of Public health</li>
                    <li><span class="adv">&rarr;</span>Uninterrupted Academic Calendar</li>
                    <li><span class="adv">&rarr;</span>Blended Learning System</li>
                    <li><span class="adv">&rarr;</span>2 Weeks didatic physical contact on approved leave</li>
                    <li><span class="adv">&rarr;</span>Opportunity for specialization</li>
                    <li><span class="adv">&rarr;</span>Multidisciplinary research and community services</li>
                    <li><span class="adv">&rarr;</span>PGD for science, allied and related BSc and HND graduates</li>
                    <li><span class="adv">&rarr;</span>Teachers as educators</li>
                    <li><span class="adv">&rarr;</span>Critical thinking and participatory problem solving teaching approach, and not just the traditional teaching methods</li>
                  </ol>
                </div>
              </div>

              <div class="col-lg-6 d-flex flex-column justify-content-center about-content" style="padding-top:0;margin-top:0;">
                <div data-aos="fade-up" data-aos-delay="100">
                  <ol class="openapp" style="list-style-type:none;padding-left:0;">
                    <li><span class="adv">&rarr;</span>Capstone based reports, projects, practicum and postings where applicable</li>
                    <li><span class="adv">&rarr;</span>Workplace tailored practicum</li>
                    <li><span class="adv">&rarr;</span>Adequate and timely Supportive supervision</li>
                    <li><span class="adv">&rarr;</span>Affordable school fees</li>
                    <li><span class="adv">&rarr;</span>Public Health skills center</li>
                    <li><span class="adv">&rarr;</span>Centralized and accessible teaching centers</li>
                    <li><span class="adv">&rarr;</span>Adequate library and internet facilities with tailored access</li>
                    <li><span class="adv">&rarr;</span>International certification</li>
                    <li><span class="adv">&rarr;</span>Opportunity for internal and external collaborations and partnership, conferences, workshops</li>
                  </ol>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php require('footer.inc.php'); ?>

  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>