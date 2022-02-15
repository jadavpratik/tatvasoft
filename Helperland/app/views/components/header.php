<?php
	// RETURN CURRENT PAGE_TITLE...
	function title(){
		global $page_url;
		$title = 'Index';
		switch($page_url){
			case '/' :
				$title = 'Home'; 
				break;
			case '/faqs' :
				$title = 'FAQs'; 
				break;
			case '/prices' :
				$title = 'Prices'; 
				break;
			case '/contact' :
				$title = 'Contact'; 
				break;
			case '/service-provider/signup' :
				$title = 'Service Provider Signup'; 
				break;
			case '/customer/signup' :
				$title = 'Customer Signup'; 
				break;
			case '/book-now' :
				$title = 'Book Now'; 
				break;
			case '/guarantee' :
				$title = 'Our Gurantee'; 
				break;
		}
		echo $title;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= title(); ?></title>
	<!-- FAVICON -->
	<link rel="icon" href="<?= assets('assets/img/favicon/favicon.png'); ?>" sizes="16x16" type="image/png">
	<!-- FONT-AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AOS -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">	
	<!-- CSS -->
	<link rel="stylesheet" href="<?= assets('assets/css/index.css'); ?>">

	<!-- SET-PROXY-URL -->
	<script> const proxy_url = `<?= BASE_URL; ?>`; </script>
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

	<!-- --------------------------------------------------- -->
						<!-- FOR_BACKLIGHT_CONTAIN -->
	<!-- --------------------------------------------------- -->
	<div class="backlight_container"></div>

	<!-- --------------------------------------------------- -->
						<!-- NAVBAR -->
	<!-- --------------------------------------------------- -->

	<?php 
		$home_header_id = '';
		$home_header_style = '';
		$home_header_logo_style = '';
		$home_focus_btn = '';
		$active_link = ['contact' => '', 
						'prices' => '', 
						'guarantee' => '', 
						'blog'=> ''];
		switch(page_url()){
			case '/':
				$home_header_id = 'home_navbar';
				$home_header_style = 'background-color:transparent;height:130px';
				$home_header_logo_style = 'width:175px; height:130px;';
				$home_focus_btn = 'transparent';			
				break;
			case '/service-provider/signup':
				$home_header_id = 'home_navbar';
				$home_header_style = 'background-color:transparent;height:130px';
				$home_header_logo_style = 'width:175px; height:130px;';
				$home_focus_btn = 'transparent';			
				break;			
			case '/prices':
				$active_link['prices'] = 'navbar_focus_btn transparent';
				break;
			case '/contact':
				$active_link['contact'] = 'navbar_focus_btn transparent';
				break;
			case '/blog':
				$active_link['blog'] = 'navbar_focus_btn transparent';
				break;
			case '/guarantee':
				$active_link['guarantee'] = 'navbar_focus_btn transparent';
				break;
		}
	?>

	<nav class="navbar" id="<?= $home_header_id; ?>" style="<?= $home_header_style; ?>">

		<!-- LOGO -->
		<div class="logo" style="<?= $home_header_logo_style; ?>">
			<a href="<?= url('/'); ?>"><img src="<?= assets('assets/img/global/logo.png') ?>" alt=""></a>
		</div>

		<!-- NAV_BTN_RESPONSIVE -->
		<button class="sidenav_btn"><i class="fas fa-bars"></i></button>
		
		<!-- NAV_MENU -->
		<div class="nav_menu">
			<?php 
				$userRole = session('userRole');
			?>
			<?php if($userRole!='service-provider' && $userRole!='admin' ){ ?>
				<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="<?= url('/book-now'); ?>">Book a Cleaner</a>
			<?php } ?>
			<a class="<?= $active_link['prices']; ?>" href="<?= url('/prices'); ?>">Prices</a>
			<a class="<?= $active_link['guarantee']; ?>" href="<?= url('/guarantee'); ?>">Our Guarantee</a>
			<a class="<?= $active_link['blog']; ?>" href="<?= url('/blog'); ?>">Blog</a>
			<a class="<?= $active_link['contact']; ?>" href="<?= url('/contact'); ?>">Contact Us</a>
			<?php if(session('isLogged')){ ?>
				<div class="dropdown border_left border_right">
					<button class="dropdown_btn">
						<!-- <span class="badge">10</span> -->
						<img src="<?= assets('assets/img/global/notification.png'); ?>" alt="">
					</button>
					<div class="dropdown_menu d_none">
						<!-- <div class="drowpdown_notification_container">
							<div class="drowpdown_notification">
								<p>Cancellation! You have canceled the order, Service ID: 8503</p>
								<p>30/12/2021 11:43</p>    
							</div>
							<div class="drowpdown_notification">
								<p>Cancellation! You have canceled the order, Service ID: 8503</p>
								<p>30/12/2021 11:43</p>    
							</div>
							<div class="drowpdown_notification">
								<p>Cancellation! You have canceled the order, Service ID: 8503</p>
								<p>30/12/2021 11:43</p>    
							</div>
							<div class="drowpdown_notification">
								<p>Cancellation! You have canceled the order, Service ID: 8503</p>
								<p>30/12/2021 11:43</p>    
							</div>
							<a href="#">Show All</a>
						</div> -->
					</div>
				</div>
				<div class="dropdown">
					<button class="dropdown_btn" style="display:flex;justify-content:space-between">
						<img src="<?= assets('assets/img/global/user.png'); ?>" alt="">
						<img style="margin-left:10px;" src="<?= assets('assets/img/buttons/angle/angle_down_white.png'); ?>" alt="">
					</button>
					<div class="dropdown_menu d_none">
						<div>
							<p>Welcome</p>
							<p><?= session('userName'); ?></p>
						</div>
						<hr>
						<a href="">To Overview</a>
						<a href="#" class="table_tab_btn">My Setting</a>
						<a href="<?= url('/logout') ?>">Logout</a>
					</div>
				</div>
			<?php 
				}
			 	else{ 
			?>
				<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="#" onclick="open_model('login')">Login</a>
				<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="<?= url('/service-provider/signup'); ?>">Become a Helper</a>
			<?php } ?>
		</div><!-- END NAV_MENU -->
	</nav><!-- END NAVBAR -->



	<!-- --------------------------------------------------- -->
						<!-- SIDE_NAVBAR -->
	<!-- --------------------------------------------------- -->
	<aside class="sidenav">

		<?php if(session('isLogged')==true){ ?>
			<!-- FOR_LOGGED_USER -->
			<div class="sidenav_header">
				<p>Warm Welcome</p>
				<p class="sidenav_logged_username"><?= session('userName'); ?></p>
			</div>
			<hr>
		<?php } ?>

		<div class="sidenav_main">
			<!-- GUEST_USER -->
			<a href="<?= url('/book-now'); ?>">Book Now</a>
			<a href="<?= url('/prices'); ?>">Prices & Services</a>
			<a href="<?= url('/guarantee'); ?>">Guarantee</a>
			<a href="<?= url('/blog'); ?>">Blog</a>
			<a href="<?= url('/contact'); ?>">Contact</a>
			<a href="#" onclick="open_model('login')">Login</a>
			<a href="<?= url('/service-provider/signup'); ?>">Become a Helper!</a>


			<?php if(session('isLogged')==true){ ?>

				<!-- CUSTOMER -->
				<?php if(session('userRole')=='customer'){ ?>
					<a href="#">Overview</a>
					<a href="#">Completed Service Orders</a>
					<a href="#">Calander view</a>
					<a href="#">My Favorites</a>
					<a href="#">Bills</a>
				<?php } ?>

				<!-- SERVICE_PROVIDER -->
				<?php if(session('userRole')=='service_provider'){ ?>
					<a href="#">Overview</a>
					<a href="#">New Inquiries</a>
					<a href="#">Accepted Requests</a>
					<a href="#">Calander view</a>
					<a href="#">Completed Service Orders</a>
					<a href="#">My Reviews</a>
					<a href="#">Block Customer</a>
					<a href="#">Bills</a>
				<?php } ?>

				<!-- COMMAN_LINKS FOR LOGGED_USER -->
				<a href="<?= url('/my-setting'); ?>">My Setting</a>
				<a href="<?= url('/logout'); ?>">Logout</a>

			<?php } ?>

		</div>
		<hr>
		<?php if(session('isLogged')==true){ ?>
			<!-- COMMAN_LINKS FOR LOGGED_USER -->
			<div class="sidenav_comman_links">
				<!-- BOOK NOW FOR CUSTOMER -->
				<a href="<?= url('/book-now'); ?>">Book Now</a>
				<a href="<?= url('/prices'); ?>">Prices & Services</a>
				<a href="<?= url('/guarantee'); ?>">Guarantee</a>
				<a href="<?= url('/blog'); ?>">Blog</a>
				<a href="<?= url('/contact'); ?>">Contact</a>
			</div>
			<hr>
		<?php } ?>

		<div class="sidenav_footer">
			<a href="#"><i class="fab fa-facebook-f"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
		</div>

	</aside>


	<!-- --------------------------------------------------- -->
				<!-- POPUP_MODEL -->
	<!-- --------------------------------------------------- -->
	<?= component('login'); ?>
	<?= component('forgot-password'); ?>
	<?= component('otp'); ?>
	<?= component('set-new-password'); ?>
	<?= component('included-services'); ?>
