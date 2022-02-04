<?= component('header'); ?>

<!-- CUSTOMER-SIGNUP-FORM -->
<div class="customer_signup">

    <div class="title_with_icon">
		<p>Create an Account</p>
		<div>
			<div><img src="<?= assets('assets/img/global/separator.png'); ?>" alt=""></div>
		</div>
	</div>
	<form id="customer_signup">
        <div>
			<div class="form_group">
				<input class="input" type="text" placeholder="First Name" name="firstname">
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>
			<div class="form_group">
				<input class="input" type="text" placeholder="Last Name" name="lastname">
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>
		</div>
        <div>
			<div class="form_group">
				<input class="input" type="text" placeholder="Email Address" name="email">
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>
			<div class="form_group">
				<div class="phone_number">
					<label for="">+46</label>
					<input type="text" placeholder="Phone Number" name="phone">
				</div>	
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>				
		</div>
        <div>
			<div class="form_group">
				<input class="input" type="password" placeholder="Password" name="password">
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>
			<div class="form_group">
				<input class="input" type="password" placeholder="Confirm Password" name="cpassword">
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>
        </div>
        <div>
            <input type="checkbox" name="TermCheckBox">
            <label for="">I have read the <a href="">privacy policy</a></label>
        </div>
        <div>
			<input type="hidden" name="role" value="customer">
            <button class="form_btn" disabled>Register</button>
        </div>
        <div>
            <p>Already Register? <a href="#" onclick="open_model('login');">Login Now</a></p>
        </div>
    </form>
</div>

<!-- ---------------------------------------------------------- -->
			<!-- SCRIPT FOR REGISTRATION... -->
<!-- ---------------------------------------------------------- -->
<script>

	$('[name="TermCheckBox"]').click(()=>{
		if($('[name="TermCheckBox"]').prop('checked')){
			$('.form_btn').prop('disabled', false);
		}
		else{
			$('.form_btn').prop('disabled', true);
		}
	});

	$('#customer_signup').submit((e)=>{
		e.preventDefault();
		$.ajax({
			url : `${proxy_url}/signup`,
			method : 'POST',
			data : $('#customer_signup').serialize(),
			success : function(res){
				if(res!==undefined && res!==""){
					const result = JSON.parse(res);
					Swal.fire({
						title : 'Good job!',
						text : result.message,
						icon : 'success'
					});
				}
			},
			error : function(obj){
				if(obj!==undefined){
					const {responseText, status} = obj;
					const error = JSON.parse(responseText);
					if(status==409){
						Swal.fire({
							text : error.message,
							icon : 'warning'
						});
					}
					else if(status==400){
						Swal.fire({
							text : error.message,
							icon : 'error'
						});
					}
				}
			}
		});
	});

</script>

<?= component('footer'); ?>
