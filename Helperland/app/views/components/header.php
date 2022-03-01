<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- TITLE -->
	<?php component('title'); ?>
	<title><?= title(); ?></title>
	<!-- FAVICON -->
	<link rel="icon" href="<?= assets('assets/img/favicon/favicon.png'); ?>" sizes="16x16" type="image/png">
	<!-- FONT-AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AOS -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" href="<?= assets('assets/css/index.css'); ?>">
    <!-- DATATABLE -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script> 
		// 	BASE URL FOR GUIDE AJAX REQUEST...
		let BASE_URL = `<?= BASE_URL; ?>`; 

		// STORE THE GLOBAL DATA...
		let state = {};

		// CONVERT FORM TO JSON DATA...
		function form_to_json(arr){
			let json = {};
			const temp = JSON.parse(JSON.stringify(arr));
            for(i of temp){
                if(i.name=='language'){
                    json[i.name] = parseInt(i.value);
				}
				else{
                    json[i.name] = i.value;
				}
            };            
			return json;
		}
	</script>
</head>
<body>

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
				<!--SIDE_NAVBAR, POPUP_MODEL (HIDDEN) -->
	<!-- --------------------------------------------------- -->
	<?= component('sidenav'); ?>
	<?= component('login'); ?>
	<?= component('forgot-password'); ?>
	<?= component('otp'); ?>
	<?= component('set-new-password'); ?>
	<?= component('included-services'); ?>
	<?= component('add-address'); ?>
	<?= component('edit-address'); ?>


