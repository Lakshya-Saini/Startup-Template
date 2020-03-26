<?php
	
	//error_reporting(0);
	
	require 'PHPMailer-5.2.4/class.phpmailer.php';

	$msg = "";

	if(isset($_POST['send']))
	{

		$connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');	

		$name = $connect->real_escape_string($_POST['name']);
		$email = $connect->real_escape_string($_POST['email']);
		$subject = $connect->real_escape_string($_POST['subject']);
		$message = $connect->real_escape_string($_POST['message']);

		if(($name) == "" || ($email) == "" || ($subject) == "" || ($message) == "")
		{
			$msg = "All Fields are required.";
		}

		$result = mysqli_query($connect, "SELECT * FROM users_table WHERE email = '$email'");	
		if(mysqli_num_rows($result) > 0)
		{

			$mail = new PHPMailer;
			$mail->IsSMTP();  
            $mail->Host = 'smtp.gmail.com';
            $mail->Port='587';
            $mail->SMTPAuth = true; 
            $mail->Username = 'info.flexcreo@gmail.com';
            $mail->Password = 'lakshya@ls';
            $mail->SMTPSecure = 'tls';
	   		$mail->setFrom($_POST['email'],$_POST['name']);
	   		$mail->addReplyTo($_POST['email'],$_POST['name']);
	   		$mail->addAddress('info.flexcreo@gmail.com', 'FlexCreo');
	   		$mail->Subject = $subject;
	   		$mail->isHTML(false);
	   		$mail->Body = "$message";

	   		if (!$mail->send())
	   		{
	   			$msg = "There is some error. Please try again later.";
	   		}
	   		else
	   		{
	   			header('Location: index.php');
	   		}
	   	}
	   	else
	   	{
	   		$msg = 'You are not a registered user. Click <a href="register.php">here</a> to register. ';
	   	}		

	}	

?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="FlexCreo is a freelancing website where you can give your web related projects and you can improve your online presence even better. We will add some extraordinary features to your website that will add value to your business.">
	<meta name="keywords" content="freelance,projects,website,freelancing,flexcreo,web projects,dashboard,freelancing websites,freelance websites">
	<title>FlexCreo</title>
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
	<link href="css/index.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Scroller -->

	<script type="text/javascript">
		$(window).on('scroll', function(){
			if($(window).scrollTop()){
				$('nav').addClass('black');
			}
			else{
				$('nav').removeClass('black');
			}
		})
	</script>

	

</head>
<body>

	<!-- Preloader -->

	<!-- Navigation -->
	<nav class="fixed-top">
		<div class="brand">
			<a class="scroll" href="#top-section">FLEX<strong>CREO</strong></a>
		</div>
		<div class="nav-items">
			<ul>
				<li><a class="scroll" href="#top-section">Home</a></li>
				<li><a class="scroll" href="#service-section">Services</a></li>
				<li><a class="scroll" href="#projects-section">Projects</a></li>
				<li><a class="scroll" href="#pricing-secion">Pricing</a></li>
				<li><a class="scroll" href="#about-section">About</a></li>
				<li><a class="scroll" href="#contact-section">Contact</a></li>
			</ul>
		</div>
		<div class="toggle">
			<i class="one"></i>
			<i class="two"></i>
			<i class="three"></i>
		</div>
	</nav>
	<div class="menu">
		<ul>
			<li><a class="scroll" href="#top-section">Home</a></li>
			<li><a class="scroll" href="#service-section">Services</a></li>
			<li><a class="scroll" href="#projects-section">Projects</a></li>
			<li><a class="scroll" href="#pricing-secion">Pricing</a></li>
			<li><a class="scroll" href="#about-section">About</a></li>
			<li><a class="scroll" href="#contact-section">Contact</a></li>
		</ul>
	</div>

	<!--- Hero Image -->
	<div class="container-fluid main-slider slider" id="top-section">
		<div class="col-md-12">
			<div class="row main">
		    	<div class="col-md-7 main-slider-text">
		            <h1 class="text-left mt-4 wow animated fadeInUp">Stop blending in & start leaving your mark on the web</h1>
		            <p class="text-left wow animated fadeInUp">
		            	Here you will get the most fresh, innovative and successful designs for your website which will add value to your business.
		            </p>
		            <div class="top-big-link text-left wow animated fadeInUp">
		            	<a class="btn btn-primary btn-link-1 shadow-none" href="login.php">Get Started &rarr;</a>
		            </div>
		        </div>
		        <div class="col-md-5 main-slider-image">
		            <img src="images/laptop-image.png" alt="laptop image" draggable="false" class="img-fluid d-block" style="max-width: 100%; height: auto;">
		        </div>
			</div>
		</div>
	</div>

	<!-- Upper Arrow Icon -->
	<div class="upper-arrow">
		<a href="#top-section" class="scroll"><i class="fas fa-angle-up"></i></a>
	</div>

	<!-- Features -->
	<div class="container-fluid container-1" id="service-section">
		<div class="col-md-12">
			<h1 class="text-center">Awesome Features</h1>
		</div>
		<div class="col-md-12">
			<p class="text-center">You will get everything you need in your website.</p>
		</div>
		<div class="container container-2 mt-0">
			<div class="row">
				<div class="col-md-4 mt-4 ml-auto mr-auto text-center p-2 box-1 wow animated fadeInUp">
					<i class="fa fa-rocket mb-3" style="font-size: 40px; color: #EB004E;"></i>
					<h4 class="text-center">Trendy Design</h4>
					<p class="text-center">Yes it is according to latest industry trends.</p>
				</div>
				<div class="col-md-4 mt-4 ml-auto mr-auto text-center p-2 box-1 wow animated fadeInUp">
					<i class="material-icons mb-3" style="font-size: 40px; color: #EB004E;">desktop_mac</i>
					<h4 class="text-center text-inverse">Responsive Layout</h4>
					<p class="text-center text-inverse">Pixel perfect to all tablet/mobile devices.</p>
				</div>
				<div class="col-md-4 mt-4 ml-auto mr-auto text-center p-2 box-1 wow animated fadeInUp">
					<i class="material-icons mb-3" style="font-size: 40px; color: #EB004E;">photo_library</i>
					<h4 class="text-center text-inverse">Parallax Effects</h4>
					<p class="text-center text-inverse">Great looking parallax background effects.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 mt-4 ml-auto mr-auto text-center p-2 box-1 wow animated fadeInUp">
					<i class="fa fa-eye mb-3" style="font-size: 40px; color: #EB004E;"></i>
					<h4 class="text-center text-inverse">Retina Ready</h4>
					<p class="text-center text-inverse">Yes, it has the sharp graphics for all devices.</p>
				</div>
				<div class="col-md-4 mt-4 ml-auto mr-auto text-center p-2 box-1 wow animated fadeInUp">
					<i class="fa fa-cubes mb-3" style="font-size: 40px; color: #EB004E;"></i>
					<h4 class="text-center text-inverse">Choose Color Styles</h4>
					<p class="text-center text-inverse">Your favorite color style according to your branding</p>
				</div>
				<div class="col-md-4 mt-4 ml-auto mr-auto text-center p-2 box-1 wow animated fadeInUp">
					<i class="fa fa-edit mb-3" style="font-size: 40px; color: #EB004E;"></i>
					<h4 class="text-center text-inverse">JS Animations</h4>
					<p class="text-center text-inverse">JS animations to make website much more attractive!</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Different Explanation -->
	<div class="container-fluid diff-exp mb-5">
		<div class="row">
			<div class="col-md-4 ml-5 img-box">
				<div class="hovereffect">
					<img src="images/tablet-image.png" alt="tablet-image" draggable="false" class="img-fluid">
				</div>
			</div>
			<div class="col-md-7 mt-auto ml-2">
				<h5>Information about us</h5>
				<h1 class="mt-3 mb-4">Why <strong>We're Different</strong></h1>
				<p class="text-justify-all">
					There are many reasons why our service is better than the rest, but here you can learn about
					why we’re different. We make trendy website designs that are responsive, retina ready and has
					parallax and javascript effects. We make websites according to client's demand and their 
					requirements. The Client can easily add Project with our unique and customized dashboard where 
					they can view the project progress. 
				</p>
				<div class="top-big-link">
	                <a class="btn btn-primary btn-link-1 scroll shadow-none" href="#how-section">Learn More</a>
	            </div>
			</div>
		</div>
	</div>

	<!-- How it Works -->
	<div class="container-fluid how-it-works-section" id="how-section">
		<div class="col-md-6 ml-auto mr-auto how-it-works">
			<h2 class="text-center">How It Works</h2>
			<hr class="mx-auto" style="width: 25%; height: 1%; background-color: #EB004E;">
			<p class="text-center">
				There are countless reasons why our service is better than the rest, but here you can learn about how it actually works
			</p>	
		</div>
		<div class="container mb-5">
			<div class="row container-3">
				<div class="col-md-4 text-center user wow animated fadeInUp">
					<i class="fa fa-user"></i>
					<h2>Sign Up for free</h2>
					<p>
						Create your free account in a matter of minutes with our patented awesome sign up process.
					</p>
				</div>
				<div class="col-md-4 text-center file wow animated fadeInUp" style="animation-delay: 0.2s;">
					<i class="fa fa-file"></i>
					<h2>Tell us about your project</h2>
					<p>
						Give a small information of your project in Project Section and we will create it as soon as possible.
					</p>
				</div>
				<div class="col-md-4 text-center child wow animated fadeInUp" style="animation-delay: 0.4s;">
					<i class="fa fa-child"></i>
					<h2>Sit back and Relax</h2>
					<p>
						Sit back, relax and pop a cold one because your life just got a whole lot easier by using Salient.
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Projects Heading Container -->
	<div class="container-fluid project mb-5" id="projects-section">
		<div class="col-md-9 mx-auto project-content">
			<h1 class="wow animated fadeInDown">MY PROJECTS</h1>
			<p>
				We love what we do, check out some of our latest projects
			</p>
			<hr class="mx-auto" style="margin-top: 40px; width: 40%; height: 1%; background-color: #eee; opacity: 0.3;">
		</div>
	</div>

	<!-- Projects -->
	<div class="container-fluid my-project">
		<div class="col-md-12">
			<div class="row mb-4" style="animation-delay: 0.4s;">
				<div class="col-md-4 img-1 box">
					<div class="image-box">
						<img class="img-responsive"draggable="false" alt="project-image" src="images/My_Project_1.png" style="min-height: 100%; max-height: 100%; min-width: 100%; max-width: 100%;">
					</div>
					<div class="details">
						<h2>Your Way<br>
							<span><a href="https://beastdesigner.github.io" target="_blank">View Project</a></span>
						</h2>
					</div>
				</div>

				<div class="col-md-4 img-2 box">
					<div class="image-box">
						<img class="img-responsive"draggable="false" alt="project-image" src="images/My_Project_2.png" style="min-height: 100%; max-height: 100%; min-width: 100%; max-width: 100%;">
					</div>
					<div class="details">
						<h2>BizFlex<br>
							<span><a href="https://flexcreo.github.io" target="_blank">View Project</a></span>
						</h2>
					</div>
				</div>

				<div class="col-md-4 img-3 box">
					<div class="image-box">
						<img class="img-responsive"draggable="false" alt="project-image" src="images/My_Project_3.jpg" style="min-height: 100%; max-height: 100%; min-width: 100%; max-width: 100%;">
					</div>
					<div class="details">
						<h2>Fascho<br>
							<span><a href="https://faschodesigner.github.io" target="_blank">View Project</a></span>
						</h2>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pricing -->
	<div class="container-fluid pricing" id="pricing-secion">
		<div  class="col-md-11 mx-auto">
			<div class="header">
				<h3 class="text-center">Plans & Pricing Table</h3>
				<p class="text-center">Select the plan that's right for your business</p>
				<hr class="mx-auto" style="margin-top: 25px; width: 10%; height: 1%; background-color: #EB004E; opacity: 1;">
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="price-table">
						<div class="price-head">
							<h4>Basic</h4>
							<h2>6000 INR</h2>
						</div>
						<div class="price-content">
							<ul>
								<li>Designing</li>
								<li>Frontend</li>
								<li>Responsive</li>
								<li>1 Modification</li>
								<li>Team Support</li>
							</ul>
						</div>
						<div class="price-button">
							<a href="dashboard.php">Buy Plan</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="price-table">
						<div class="price-head">
							<h4>Advance</h4>
							<h2>20000 INR</h2>
						</div>
						<div class="price-content">
							<ul>
								<li>Frontend | Backend</li>
								<li>Responsive</li>
								<li>Logo Design</li>
								<li>Content Writing</li>
								<li>5 Modifications</li>
								<li>Team Support</li>
							</ul>
						</div>
						<div class="price-button">
							<a href="dashboard.php">Buy Plan</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="price-table">
						<div class="price-head">
							<h4>Premium</h4>
							<h2>12000 INR</h2>
						</div>
						<div class="price-content">
							<ul>
								<li>Frontend | Backend</li>
								<li>Responsive</li>
								<li>Logo Design</li>
								<li>3 Modifications</li>
								<li>Team Support</li>
							</ul>
						</div>
						<div class="price-button">
							<a href="dashboard.php">Buy Plan</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Get Started Button -->
	<div class="container-fluid get-started">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 get-started-text">
					<h4>Have you noticed</h4>
					<h2>Small Details create the big picture</h2>
					<p>Stop blending in, take a deep breadth and join us today.</p>
				</div>
				<div class="col-md-6 get-started-button">
					<div class="top-big-link wow animated fadeInDown">
	                	<a class="btn btn-primary" href="login.php">Get Started</a>
	            	</div>
				</div>
			</div>
		</div>
	</div>

	<!-- About Me -->
	<div class="container-fluid about mb-5" id="about-section">
		<div class="col-md-12">
			<div class="about-header">
				<h2 class="text-center">About Me</h2>
				<hr class="mx-auto" style="margin-top: 8px; width: 6%; height: 1%; background-color: #EB004E; opacity: 1;">
			</div>
			<div class="col-md-12 about-part">
				<div class="row">
					<div class="col-md-4">
						<div class="img-hovereffect">
							<img class="img-fluid" src="images/me1.png" alt="my-image" draggable="false">
						</div>
					</div>
					<div class="col-md-8 about-content">
						<h2>I'm Lakshya Saini and I'm a Freelance Web Designer and Developer.</h2>
						<p>
							I am a certified website-designer and developer who specialises in making websites that are 
							accessible to everyone, easy to use and effective. I try to make them beautiful and memorable. 
							I would like to design and build an attractive, simple website for you that adds value 
							to your business.
						</p>
						<p>
							Each site I develop is based on the latest trend design and is SEO friendly. To find about more what I can do, you can check my projects.
						</p>
						<div class="top-big-link wow animated fadeInUp">
	                		<a class="btn btn-primary scroll shadow-none" href="#projects-section">View Projects</a>
	            		</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->
	<div class="container-fluid contact" id="contact-section">
		<div class="col-md-12">
			<div class="col-md-9 mx-auto contact-header">
				<h3 class="wow animated fadeInDown">Contact Me</h3>
				<h1>Reach out for a new project or just say hello</h1>
			</div>
			<div class="col-md-12 mx-auto">
				<div class="row">
					<div class="col-md-4 contact-info">
						<h1>Connect with <strong>FlexCreo.</strong></h1>
						<p>There are simpler ways for you to get in touch with us and get answered your questions.</p>
						<p>Phagwara, Punjab (India)</p>
						<p>+91 8729045425</p>
						<p>info.flexcreo@gmail.com</p>
					</div>
					<div class="col-md-8">
						<div class="contact-form">
							<h3 class="d-inline">Send Message</h3>
							<h5 class='d-inline' style="float: right; color: #EB004E; font-family: 'Montserrat', sans-serif; font-size: 17px !important; font-weight: 300;">
	                        	<?php 
	                           		if($msg != '') {
	                              		echo '*' . $msg . '<br><br>';
	                           		} 
	                        	?>
	                     	</h5> 
							<form method="post" action='#contact-section'>
								<input type="text" name="name" id="name" placeholder="Your Name">
								<input type="email" name="email" id="email" placeholder="Your Email">
								<input type="text" name="subject" id="subject" placeholder="Your Subject">
								<textarea name="message" id="message" placeholder="Your Message"></textarea>
								<input type="submit" id="send" name="send" value="Send">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<div class="container-fluid footer">
		<div class="col-9 mx-auto">
			<h3 class="text-center wow animated fadeInDown">FlexCreo</h3>
			<div class="t-and-c">
				<a href="privacy.php" target="_blank" class="mx-auto">Terms and Conditions</a>
			</div>
			<p class="text-center">Copyright &copy; 2018 FlexCreo</p>
		</div>
	</div>

	<!-- Scripts -->

	<script>
		$(document).ready(function(){
			var scrollLink = $('.scroll');

			scrollLink.click(function(e){
				e.preventDefault();
				$('body,html').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});

			$(document).on('click', '.nav-items ul li', function(){
					$(this).siblings().removeClass('active').addClass('active')
			});

			$(window).scroll(function(){
				var scrollBarLocation = $(this).scrollTop();

				scrollLink.each(function(){
					var sectionOffset = $(this.hash).offset().top-1;

					if(sectionOffset <= scrollBarLocation){
						$(this).parent().addClass('active');
						$(this).parent().siblings().removeClass('active');
					}
				});
			});

		});
	</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" type="text/javascript"></script>
<script type="text/javascript">
 	new WOW().init();
</script>

<script type="text/javascript">
	$('.toggle').click(function(){
		$(this).toggleClass('on');
		$('.menu').toggleClass('active');
		$('.brand').toggleClass('show');
		$('.upper-arrow').toggleClass('visible');
	})
</script>

</body>
</html>