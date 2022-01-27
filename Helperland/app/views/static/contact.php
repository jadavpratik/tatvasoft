<?= component('header'); ?>

<!-- --------------------------------------------------- -->
					<!-- CONTACT_MAIN -->
<!-- --------------------------------------------------- -->

<!-- CONTACT_PAGE_BANNER -->
<div class="banner">
	<img src="<?= assets('assets/img/banner/contact.png'); ?>" alt="">
</div>

<main>

	<!-- --------------------------------------------------- -->
						<!-- CONTACT_US -->
	<!-- --------------------------------------------------- -->
	<div class="contact">
		
		<!-- SECTION_1_TITLE -->
		<div class="title_with_icon">
			<p>Contact us</p>
			<div>
				<div><img src="<?= assets('assets/img/global/separator.png'); ?>" alt=""></div>
			</div>
		</div>

		<div class="contact_card_container">
			<div class="contact_card">
				<div><img src="<?= assets('assets/img/static/contact/section_1/location.png'); ?>" alt="" ></div>
				<div><p>1111 Lorem ipsum text 100,</p><p>Lorem ipsum AB</p></div>
			</div>
			<div class="contact_card">
				<div><img src="<?= assets('assets/img/static/contact/section_1/phone.png'); ?>" alt="" ></div>
				<div><p>+49 (40) 123 56 7890</p><p>+49 (40) 987 56 0000</p></div>
			</div>
			<div class="contact_card">
				<div><img src="<?= assets('assets/img/static/contact/section_1/envelope.png'); ?>" alt="" ></div>
				<div><p>info@helperland.com</p></div>
			</div>
		</div><!-- END_SECTION_1_CARD_CONTAINER -->

	</div><!-- END_CONTACT_US -->
	
	<hr class="contact_hr">

	<!-- --------------------------------------------------- -->
						<!-- GET_IN_TOUCH -->
	<!-- --------------------------------------------------- -->
	<div class="get_in_touch">
		<p class="get_in_touch_title">Get in touch with us</p>
		<form action="">
			<div>
				<input class="input" type="text" placeholder="First Name">
				<input class="input" type="text" placeholder="Last Name">
			</div>
			<div>
				<div class="phone_number">
					<label for="">+46</label>
					<input type="text" placeholder="Phone Number">
				</div>
				<input class="input" type="text" placeholder="Email Address">
			</div>
			<div>
				<select class="select" name="" id="">
					<option value="">Suject</option>
				</select>
			</div>
			<div>
				<textarea class="textarea" name="" placeholder="Message"></textarea>
			</div>
			<button class="form_btn">Submit</button>
		</form>
	</div><!-- END_GET_IN_TOUCH -->

	<!-- MAP -->
	<div class="map">
		<img src="<?= assets('assets/img/static/contact/section_2/map.png'); ?>" alt="">
	</div>

<main>

<?= component('footer') ?>