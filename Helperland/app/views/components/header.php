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
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- SET-PROXY-URL -->
	<script>
		const proxy_url = `http://localhost/tatvasoft/Helperland`;
		// const proxy_url = `http://localhost:8000`;
	</script>
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
		$active_link = ['contact' => 'contact', 
						'prices' => 'prices', 
						'gaurantee' => 'gaurantee', 
						'blog'=> 'blog'];
		switch(page_url()){
			case '/':
				$home_header_id = 'home_navbar';
				$home_header_logo_style = 'width:175px; height:130px;';
				$home_focus_btn = 'transparent';
				$home_footer_style = 'background-color:transparent;height:130px';
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
			case '/gaurantee':
				$active_link['gaurantee'] = 'navbar_focus_btn transparent';
				break;
		}
	?>

	<nav class="navbar" id="<?= $home_header_id; ?>" style="<?= $home_footer_style; ?>">

		<!-- LOGO -->
		<div class="logo" style="<?= $home_header_logo_style; ?>">
			<a href="<?= url('/'); ?>"><img src="<?= assets('assets/img/global/logo.png') ?>" alt=""></a>
		</div>

		<!-- NAV_BTN_RESPONSIVE -->
		<button class="sidenav_btn"><i class="fas fa-bars"></i></button>
		
		<!-- NAV_MENU -->
		<div class="nav_menu">
			<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="<?= url('/book-now'); ?>">Book a Cleaner</a>
			<a class="<?= $active_link['prices']; ?>" href="<?= url('/prices'); ?>">Prices</a>
			<a class="<?= $active_link['gaurantee']; ?>" href="<?= url('/gaurantee'); ?>">Our Gaurantee</a>
			<a class="<?= $active_link['blog']; ?>" href="<?= url('/blog'); ?>">Blog</a>
			<a class="<?= $active_link['contact']; ?>" href="<?= url('/contact'); ?>">Contact Us</a>
			<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="#" onclick="open_model('login')">Login</a>
			<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="<?= url('/service-provider/signup'); ?>">Become a Helper</a>
		</div><!-- END NAV_MENU -->
	</nav><!-- END NAVBAR -->



	<!-- --------------------------------------------------- -->
						<!-- SIDE_NAVBAR -->
	<!-- --------------------------------------------------- -->
	<aside class="sidenav">

		<?php if(session('logged')==true){ ?>
			<!-- FOR_LOGGED_USER -->
			<div class="sidenav_header">
				<p>Warm Welcome</p>
				<p class="sidenav_logged_username">Kavan Patel</p>
			</div>
			<hr>
		<?php } ?>

		<div class="sidenav_main">
			<!-- GUEST_USER -->
			<a href="<?= url('/book_now'); ?>">Book Now</a>
			<a href="<?= url('/prices'); ?>">Prices & Services</a>
			<a href="<?= url('/gurantee'); ?>">Gurantee</a>
			<a href="<?= url('/blog'); ?>">Blog</a>
			<a href="<?= url('/contact'); ?>">Contact</a>
			<a href="<?= url('/customer/signup'); ?>">Register</a>
			<a href="<?= url('/service-provider/signup'); ?>">Become a Helper!</a>


			<?php if(session('logged')==true){ ?>

				<!-- CUSTOMER -->
				<?php if(session('role')=='customer'){ ?>
					<a href="">Overview</a>
					<a href="">Completed Service Orders</a>
					<a href="">Calander view</a>
					<a href="">My Favorites</a>
					<a href="">Bills</a>
				<?php } ?>

				<!-- SERVICE_PROVIDER -->
				<?php if(session('role')=='service_provider'){ ?>
					<a href="">Overview</a>
					<a href="">New Inquiries</a>
					<a href="">Accepted Requests</a>
					<a href="">Calander view</a>
					<a href="">Completed Service Orders</a>
					<a href="">My Reviews</a>
					<a href="">Block Customer</a>
					<a href="">Bills</a>
				<?php } ?>

				<!-- COMMAN_LINKS FOR LOGGED_USER -->
				<a href="">My Setting</a>
				<a href="">Logout</a>

			<?php } ?>

		</div>
		<hr>
		<?php if(session('logged')==true){ ?>
			<!-- COMMAN_LINKS FOR LOGGED_USER -->
			<div class="sidenav_comman_links">
				BOOK NOW FOR CUSTOMER
				<a href="">Book Now</a>
				<a href="">Prices & Services</a>
				<a href="">Gurantee</a>
				<a href="">Blog</a>
				<a href="">Contact</a>
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

