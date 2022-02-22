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
				<input class="input" type="password" name="set_new_password">
				<div class="validation_message d_none">
					<p>Validation Message!!!</p>
				</div>
			</div>
			<div class="form_group">
				<label class="label" for="">Confirm Password</label>
				<input class="input" type="password" name="set_new_cpassword">					
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

		let validation = true;

		let validationArr = [set_new_password_validation(),
							 set_new_cpassword_validation()];

		for(let i=0; i<validationArr.length; i++){
			if(validationArr[i]==false){
				validation = false;
				break;
			}
		}

		if(validation){
			const data = JSON.stringify({
				set_new_password : $('[name="set_new_password"]').val(),
				set_new_cpassword : $('[name="set_new_cpassword"]').val()
			})
			$.ajax({
				url : `${proxy_url}/set-new-password`,
				method : 'PUT',
				contentType : 'application/json',
				data : data,
				success : function(res){
					if(res!=undefined && res!=""){
						try{
							const result = JSON.parse(res);
							Swal.fire({
								title : 'Good Job',
								text : result.message,
								icon : 'success'
							}).then((res)=>{
								if(res.isConfirmed){
									close_model();
								}
							});
						}
						catch(e){
							console.log('Invalid Json Response!');
							Swal.fire({
								title : 'SERVER ERROR',
								text : 'Invalid JSON Response!!!',
								icon : 'error'
							});
						}
					}
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
		}
	});
</script>