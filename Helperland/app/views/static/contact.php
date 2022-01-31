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
		<form id="contactUs">
			<div>
				<input class="input" type="text" placeholder="First Name" name="FirstName">
				<input class="input" type="text" placeholder="Last Name" name="LastName">
			</div>
			<div>
				<div class="phone_number">
					<label for="">+46</label>
					<input type="text" placeholder="Phone Number" name="PhoneNumber">
				</div>
				<input class="input" type="text" placeholder="Email Address" name="Email">
			</div>
			<div>
				<select class="select" name="Subject">
					<option value="general">General</option>
					<option value="inquiry">Inquiry</option>
					<option value="renewal">Renewal</option>
					<option value="revocation">Revocation</option>
				</select>
			</div>
			<div>
				<textarea class="textarea" name="Message" placeholder="Message"></textarea>
			</div>
			<div>
				<label class="label" for="attachment">Attachment</label>
				<div>
					<label for="attachment">Upload</label>
					<input type="file" id="attachment" name="Attachment">
				</div>
			</div>
			<div>
				<input type="checkbox" name="TermCheckBox">
				<p>Our current ones apply <a href="#">privacy policy</a> i hereby agree that my data entered into the contact form will be stored electronically and processed and used for the used for the purpose of establishing contact. the consent can be withdrawn at any time pursuant to art. 7(3) GDPR by informal notification (eg. by e-mail).</p>
			</div>
			<button class="form_btn" disabled>Submit</button>
		</form>
	</div><!-- END_GET_IN_TOUCH -->

	<script>
		$('.form_btn').click(function(e){
			e.preventDefault();
			const data = new FormData($('#contactUs')[0]);
			$.ajax({
				url : '/contact',
				type : 'POST',
				data : data,
		        processData : false,
		        contentType : false,
		        success : function(result, status, xhr){
		        	console.log(result);
		        },
		        error : function(xhr, status, error){
		        	console.log(status);
		        },
			})
		});


		$('[name="TermCheckBox"]').click(()=>{
			if($('[name="TermCheckBox"]').prop('checked')==true){
				$('.form_btn').prop('disabled', false);
			}
			else{
				$('.form_btn').prop('disabled', true);
			}
		});
	</script>

	<!-- MAP -->
	<div class="map">
		<img src="<?= assets('assets/img/static/contact/section_2/map.png'); ?>" alt="">
	</div>

<main>

<?= component('footer') ?>