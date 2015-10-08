<?php 
if($_SERVER['HTTP_HOST'] == "localhost"){
	
	$private = "C:/wamp2/www/private/";
}else{
	
	$private = "/home/jstockwin/private/";
}
// Require https
include_once $private.'psl-config.php';
include_once $private.'db_connect.php';
include_once $private.'functions.php';
include_once $private.'register.inc.php';
sec_session_start();
$secure = SECURE;
if ($secure == true){
if ($_SERVER['HTTPS'] != "on") {
	
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
}

?>


<head>
	<link rel="stylesheet" type="text/css" media="all" href="/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
	<meta name="theme-color" content="#2f68a1">
	<title>Students4Students</title>
	
	<!-- Font Imports -->
	<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	
	<!-- JS -->
	<script type="text/JavaScript" src = "/js/functions.js"> </script>
	<script type="text/JavaScript" src="/js/sha512.js"></script> 
	<script type="text/JavaScript" src="/js/forms.js"></script> 

	
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"> </script>
	
	<!-- Google Analytics -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		ga('create', 'UA-63874178-1', 'auto');
		ga('send', 'pageview');
		
	</script>
	
	<!-- Smooth Scrolling Script -->
	<script>
		$(function() {
			$('a[href*=#]:not([href=#])').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						$('html,body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				}
			});
		});
	</script>
	<div class="webnav" id="webnav"> 
		<img id="hamburger" src="/images/hamburger.svg" onclick="expandmobnav()">
		<a href="/index.php"><img src="/images/logo.jpg" style="max-width: 40px;"></a>
		<div id="navtitle">
			
			<a href="/index.php" id="headertitle">Students4Students</a>
			<a href="/index.php" id="headertitlemob">S4S</a>
		</div>
		<nav id="navcontent">
			<ul class="menulist">
				<li><a href="/index.php">Home</a></li>
				<?php if (login_check($mysqli) !== false) : ?>
				<!-- User is logged in -->
				<li class="dropdownitem">
					<label>Tutors</label>
					<ul class="dropdownlist">
						<li><a href="/tutorarea.php?dir=/">Tutor Area</a></li>
						<li><a href="/myaccount.php">My Account</a></li>
						<?php if (login_check($mysqli) == "admin") : ?>
						<li><a href="/adminconsole.php">Admin Console</a></li>
						<?php endif; ?>
						<li><a href="/logout.php">Log Out</a></li>
					</ul>
				<li>
				<?php else : ?>
				<!-- User is not logged in -->
				<li><a href="/login.php">Log in</a></li>
				<?php endif; ?>
				<li class="dropdownitem">
					<label>About Us</label>
					
					<ul class="dropdownlist">
						<li><a href="/about-what-we-do.php">What we do</a></li>
						
						<li><a href="/about-our-journey.php">Our Journey</a></li>
						
						<li><a href="/about-the-committee.php">Meet the Committee</a></li>
						
						<li><a href="/about-the-trustees.php">Meet the Trustees</a></li>
						
					</ul>
					
				</li>
				
				<li class="dropdownitem">
					<label>Get Involved</label>
					
					<ul class="dropdownlist">
						<li><a href="/get-involved-tutors.php">For Tutors</a></li>
						
						<li><a href="/get-involved-schools.php">For Schools</a></li>
					</ul>
				</li>
				<li><a href="/blog/page1.php">Blog</a></li>
				<li><a href="/contact-us.php">Contact Us</a></li>
							
			</ul>
		</nav>
	</div>
	
	
	
	<div class="mobnav" id="mobnav"> 
		<div id="mobnavtitle">
			
		</div>
		<nav id="mobnavcontent">
			<ul class="mobmenulist">
				<li><a href="/index.php">Home</a></li>
				<?php if (login_check($mysqli) !== false) : ?>
				<!-- User is logged in -->
				<li class="mobdropdownitem">
					<label for="tutors">Tutors +</label>
					<input id="tutors" type="checkbox" style="display: none">
					<ul class="mobdropdownlist">
						
						<li><a href="/tutorarea.php?dir=/">Tutor Area</a></li>
						<li><a href="/myaccount.php">My Account</a></li>
						<?php if (login_check($mysqli) == "admin") : ?>
						<li><a href="/adminconsole.php">Admin Console</a></li>
						<?php endif; ?>
						<li><a href="/logout.php">Log Out</a></li>
					</ul>
				<li>
				<?php else : ?>
				<!-- User is not logged in -->
				<li><a href="/login.php">Log in</a></li>
				<?php endif; ?>
				<li class="mobdropdownitem">
					<label for="about-us">About Us +</label>
					<input id="about-us" type="checkbox" style="display: none">
					<ul class="mobdropdownlist">
						<li><a href="/about-what-we-do.php">- What we do</a></li>
						
						<li><a href="/about-our-journey.php">- Our Journey</a></li>
						
						<li><a href="/about-the-committee.php">- Meet the Committee</a></li>
						
						<li><a href="/about-the-trustees.php">- Meet the Trustees</a></li>
						
					</ul>
					
				</li>
				
				<li class="mobdropdownitem">
					<label for="get-involved">Get Involved +</label>
					<input id="get-involved" type="checkbox" style="display: none">
					<ul class="mobdropdownlist">
						<li><a href="/get-involved-tutors.php">- For Tutors</a></li>
						
						<li><a href="/get-involved-schools.php">- For Schools</a></li>
					</ul>
				</li>
				<li><a href="/blog/page1.php">Blog</a></li>
				<li><a href="/contact-us.php">Contact Us</a></li>

				
				
				
				
			</ul>
		</nav>
	</div>
	
</head>

<!DOCTYPE html>
<html style="height: 100%">
<body onload="stretch_footer()" onresize="stretch_footer()">
	
	<div id="hidemobnav" onclick="expandmobnav()"></div>