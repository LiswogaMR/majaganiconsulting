<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MAJAGANI CONSULTING (PTY) LTD</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
   <link href="assets/img/logo.png" rel="icon">
 <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
 
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">MAJAGANI CONSULTING (PTY) LTD</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html#hero" class="active">Home</a></li>
          <li><a href="index.php#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="browse_jobs.php">Career</a>
    </div>
  </header>

  <main class="main">
	<!-- Login Section -->
	<section id="index-page" class="index-page header" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: url('assets/img/hero-bg-light.webp') no-repeat center center/cover;">

		<!-- Login Form Container -->
		<div class="container" style="max-width: 500px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" data-aos="fade-up">

			<!-- Section Title -->
			<div class="section-title text-center">
				<h2 style="color: #333;">Log In</h2>
			</div><!-- End Section Title -->

			<form action="functions/functions.php" method="post" >
				<div class="row gy-4">

				<!-- Username Field -->
				<div class="col-md-12">
					<input type="text" name="email" id="email" class="form-control" placeholder="Email" required="" style="height: 45px; padding: 10px;">
				</div>

				<!-- Password Field -->
				<div class="col-md-12">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" style="height: 45px; padding: 10px;">
				</div>

				<!-- Submit Button -->
				<div class="col-md-12 text-center mt-3">
					<input type="hidden" name="actionType" value="login">
					<button type="submit" class="btn btn-primary" style="width: 100%; height: 45px; background-color: #4e54c8; border: none; color: #fff; font-size: 16px; border-radius: 5px;">Log In</button>
				</div>

				</div>
			</form>



		</div><!-- End Login Form Container -->

	</section><!-- /Login Section -->


	  <!-- Contact Section -->
	  <section id="contact" class="contact section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Contact</h2>
  <p>Reach Out to Us Today Lets Collaborate on Your Next Big Idea.</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="row gy-4">

	<div class="col-lg-6">
	  <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
		<i class="bi bi-geo-alt"></i>
		<h3>Address</h3>
		<p>42 Diana Siegel Street, The Reeds Ext. 02 Centurion 0157</p>
	  </div>
	</div><!-- End Info Item -->

	<div class="col-lg-3 col-md-6">
	  <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
		<i class="bi bi-telephone"></i>
		<h3>Call Us</h3>
		<p>+2767 200 6752/ +2782 589 9782</p>
	  </div>
	</div><!-- End Info Item -->

	<div class="col-lg-3 col-md-6">
	  <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
		<i class="bi bi-envelope"></i>
		<h3>Email Us</h3>
		<p>info@majaganiconsulting.co.za</p>
	  </div>
	</div><!-- End Info Item -->

  </div>

  <div class="row gy-4 mt-1">
	<div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
	  <iframe width="600" height="400" src="https://www.openstreetmap.org/export/embed.html?bbox=28.154482841491703%2C-25.85644301433756%2C28.211131095886234%2C-25.822067046318075&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/>
	  <small>
		<a href="https://www.openstreetmap.org/#map=15/-25.83926/28.18281">View Larger Map</a>
	  </small>
  </div>
  
	
	<div class="col-lg-6">
	  <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
		<div class="row gy-4">

		  <div class="col-md-6">
			<input type="text" name="name" class="form-control" placeholder="Your Name" required="">
		  </div>

		  <div class="col-md-6 ">
			<input type="email" class="form-control" name="email" placeholder="Your Email" required="">
		  </div>

		  <div class="col-md-12">
			<input type="text" class="form-control" name="subject" placeholder="Subject" required="">
		  </div>

		  <div class="col-md-12">
			<textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
		  </div>

		  <div class="col-md-12 text-center">
			<div class="loading">Loading</div>
			 <div class="error-message"></div>
			<div class="sent-message">Your message has been sent. Thank you!</div>

			<button type="submit">Send Message</button>
		  </div>

		</div>
	  </form>
	</div><!-- End Contact Form -->

  </div>

</div>

</section><!-- /Contact Section -->

  </main>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

