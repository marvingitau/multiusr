<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KMRC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="assets/icons/clg7-favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/OwlCarousel2-2.3.4/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/vendor/OwlCarousel2-2.3.4/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://jobs.kmrc.co.ke/assets/landing-page/css/styles.css">
    <link rel="stylesheet" href="assest/css/responsive.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light px-5">
        <a class="navbar-brand" href="#"><img class="img-fluid logo" src="https://jobs.kmrc.co.ke/assets/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">What we do <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://kmrc.co.ke/corporate-profile/">Who we are</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="https://kmrc.co.ke/careers/">Careers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bordered" href="https://kmrc.co.ke/contact-us">Lets talk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="header" style="background: url('https://jobs.kmrc.co.ke/assets/landing-page/images/1.jpg');">
        <div class="header-text">
            <h3 class="text-dark">Love your work and life</h3>
            {{-- <a href="https://jobs.kmrc.co.ke/job"  class="btn">View job opening</a> --}}
            <a href="{{ route('job')}}"  class="btn">View job opening</a>

        </div>
    </section>
    <section>
        <img src="https://jobs.kmrc.co.ke/assets/landing-page/images/2.jpg" class="img-fluid"> 
    </section>

    <section class="container-fluid withcards" style="background: url('https://jobs.kmrc.co.ke/assets/landing-page/images/office.jpg');">
        <div class="row">
            <div class="col-md-4">
                <div class="card red">
                    <div class="card-body">
                        <div class="card-img"><i class="fas fa-home"></i></div>
                        <h5 class="card-title">Work where you live</h5>
                        <p class="card-text">Put your suitcase away and make weeknight plans again. At Slalom, you can
                            work
                            with companies in the city you livein and love.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card red">
                    <div class="card-body">
                        <div class="card-img"><i class="fas fa-eye"></i></div>
                        <h5 class="card-title">Work where you live</h5>
                        <p class="card-text">Put your suitcase away and make weeknight plans again. At Slalom, you can
                            work
                            with companies in the city you livein and love.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card red">
                    <div class="card-body">
                        <div class="card-img"><i class="fas fa-users"></i></div>
                        <h5 class="card-title">Work where you live</h5>
                        <p class="card-text">Put your suitcase away and make weeknight plans again. At Slalom, you can
                            work
                            with companies in the city you livein and love.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card grey">
                    <div class="card-body">
                        <div class="card-img"><i class="fas fa-eye"></i></div>
                        <h5 class="card-title">Work where you live</h5>
                        <p class="card-text">Put your suitcase away and make weeknight plans again. At Slalom, you can
                            work
                            with companies in the city you livein and love.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card grey">
                    <div class="card-body">
                        <div class="card-img"><i class="fas fa-eye"></i></div>
                        <h5 class="card-title">Work where you live</h5>
                        <p class="card-text">Put your suitcase away and make weeknight plans again. At Slalom, you can
                            work
                            with companies in the city you livein and love.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card grey">
                    <div class="card-body">
                        <div class="card-img"><i class="fas fa-eye"></i></div>
                        <h5 class="card-title">Work where you live</h5>
                        <p class="card-text">Put your suitcase away and make weeknight plans again. At Slalom, you can
                            work
                            with companies in the city you livein and love.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="intouch">
        <div class="row">
            <div class="col-md-3">
                <img class="img-fluid envelop" src="https://jobs.kmrc.co.ke/assets/envelope1.png">
            </div>
            <div class="col-md-6">
                <h2>Get in touch</h2>
                <p>Would you like to find out more about what we offer?</p>
            </div>
            <div class="col-md-3 d-flex align-self-center">
                <a href="https://kmrc.co.ke/contact-us" class="btn">CONTACT US</a>
            </div>
        </div>
    </section>
    
    <footer id="colophon" class="site-footer py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h5>About</h5>
					<div id="menu-location-menu-2" class="menu-footer-container"><ul id="footer-menu" class="list-unstyled"><li id="menu-item-270" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5 current_page_item menu-item-270"><a href="https://kmrc.co.ke/" aria-current="page">Home</a></li>
<li id="menu-item-274" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-274"><a href="https://kmrc.co.ke/corporate-profile/">Corporate Profile</a></li>
<li id="menu-item-275" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-275"><a href="https://kmrc.co.ke/eligibility-criteria/">Eligibility Criteria</a></li>
<li id="menu-item-276" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-276"><a href="https://kmrc.co.ke/governance/">Governance</a></li>
<li id="menu-item-273" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-273"><a href="https://kmrc.co.ke/contact-us/">Contact Us</a></li>
</ul></div>				</div>
				<div class="col-md-3">
					<h5>Our Products</h5>
					<ul class="m-0 p-0 list-unstyled text-capitalize">
															<li><a href="https://kmrc.co.ke/our_services/market-housing-loans/">Market housing loans</a></li>
																	<li><a href="https://kmrc.co.ke/our_services/affordable-housing-loans/">Affordable housing loans</a></li>
													</ul>
				</div>
				<div class="col-md-2">
					<h5>be social</h5>
					<ul class="m-0 p-0 list-unstyled text-capitalize social">
						<li><a href=""><i class="fa fa-facebook-f" aria-hidden="true"></i>Facebook</a></li>
						<li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i>Instagram</a></li>
						<li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
						<li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i>Linkedin</a></li>
						<li><a href=""><i class="fa fa-youtube" aria-hidden="true"></i>Youtube</a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<h5>address</h5>

					<ul class="m-0 p-0 list-unstyled footer-address">
						<li><i class="fa fa-clock-o" aria-hidden="true"></i> <span>7th Floor, Reinsurance Plaza,
Taifa Road <br>P.O Box 15494 – 00100 Nairobi</span></li>
						<li><i class="fa fa-envelope" aria-hidden="true"></i> <span>info@kmrc.co.ke</span></li>
						<li><i class="fa fa-phone" aria-hidden="true"></i> <span>+254 20 238 9235</span></li>
					</ul>
				</div>
			</div>
		</div>
	<div></div></footer>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/OwlCarousel2-2.3.4/owl.carousel.min.js"></script>
<script src="assets/js/main.js"></script>

</html>