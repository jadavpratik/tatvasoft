<!-- --------------------------------------------------- -->
			<!-- SET_NEW_PASSWORD -->
<!-- --------------------------------------------------- -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
	<!-- SET_NEW_PASSOWORD -->
	<div class="popup_main d_none" id="set_new_password_popup">
		<p class="popup_title">SET NEW PASSWORD</p>
		<form class="set_new_password_popup">
			<div class="form_group">
				<label class="label" for="">New Password</label>
				<input class="input" type="password" name="password">
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>
			<div class="form_group">
				<label class="label" for="">Confirm Password</label>
				<input class="input" type="password" name="cpassword">					
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>
			<button class="popup_btn">Save</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	$('.set_new_password_popup').submit((e)=>{
		e.preventDefault();
		$.ajax({
			url : `${proxy_url}/set-new-password`,
			method : 'POST',
			data : $('.set_new_password_popup').serialize(),
			success : function(res){
				const result = JSON.parse(res);
                Swal.fire({
                    title : 'Good Job',
                    text : result.message,
                    icon : 'success'
                }).then((res)=>{
                	if(res.isConfirmed){
                		close_model();
                	}
                })
			},
			error : function(obj){
                const {responseText, status} = obj;
                const error = JSON.parse(responseText);
				Swal.fire({
					text:error.message,
					icon:'error',
				})
			}
		});
	});
</script>