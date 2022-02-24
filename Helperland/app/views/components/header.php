<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- TITLE -->
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
		// PROXY URL AS BASE URL GUIDE THE FRONT AJAX REQUEST...
		let proxy_url = `<?= BASE_URL; ?>`; 
		// STORE THE GLOBAL DATA...
		let state = {};
	</script>
</head>
<body>

	<!-- INCLUDE REQUIRED PHP SCRIPT [NOT-HTML] -->
	<?= component('title'); ?>
	<?= component('header-active-links'); ?>
	<?= component('session-components'); ?>

	<!-- --------------------------------------------------- -->
						<!-- FOR_BACKLIGHT_CONTAIN -->
	<!-- --------------------------------------------------- -->
	<div class="backlight_container"></div>

	<!-- --------------------------------------------------- -->
						<!-- NAVBAR -->
	<!-- --------------------------------------------------- -->

	<nav class="navbar" id="<?= $home_header_id; ?>" style="<?= $home_header_style; ?>">

		<!-- LOGO -->
		<div class="logo" style="<?= $home_header_logo_style; ?>">
			<a href="<?= url('/'); ?>"><img src="<?= assets('assets/img/global/logo.png') ?>" alt=""></a>
		</div>

		<!-- NAV_BTN_RESPONSIVE -->
		<button class="sidenav_btn"><i class="fas fa-bars"></i></button>
		
		<!-- NAV_MENU -->
		<div class="nav_menu">
			<!-- USERROLE BY SESSION -->
			<?php $userRole = session('userRole'); ?>

			<?php if($userRole!='service-provider' && $userRole!='admin' ){ ?>
				<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="<?= url('/book-now'); ?>">Book a Cleaner</a>
			<?php } ?>
			<a class="<?= $active_link['prices']; ?>" href="<?= url('/prices'); ?>">Prices</a>
			<a class="<?= $active_link['guarantee']; ?>" href="<?= url('/guarantee'); ?>">Our Guarantee</a>
			<a class="<?= $active_link['blog']; ?>" href="javascript:void(0);">Blog</a>
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
							<a href="javascript:void(0);">Show All</a>
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
						<a href="javascript:void(0);" class="table_tab_btn">My Setting</a>
						<a href="<?= url('/logout') ?>">Logout</a>
					</div>
				</div>
			<?php 
				}
			 	else{ 
			?>
				<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="javascript:void(0);" onclick="open_model('login')">Login</a>
				<a class="navbar_focus_btn <?= $home_focus_btn; ?>" href="<?= url('/service-provider/signup'); ?>">Become a Helper</a>
			<?php } ?>
		</div><!-- END NAV_MENU -->
	</nav><!-- END NAVBAR -->


	<!-- --------------------------------------------------- -->
						<!-- SIDE_NAVBAR -->
	<!-- --------------------------------------------------- -->
	<?= component('sidenav'); ?>

	<!-- --------------------------------------------------- -->
				<!--HIDDEN POPUP_MODEL -->
	<!-- --------------------------------------------------- -->
	<?= component('login'); ?>
	<?= component('forgot-password'); ?>
	<?= component('otp'); ?>
	<?= component('set-new-password'); ?>
	<?= component('included-services'); ?>
