<!-- --------------------------------------------------- -->
			<!-- OTP -->
<!-- --------------------------------------------------- -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
	<!-- POPUP-MAIN -->
	<div class="popup_main d_none" id="otp_popup">
		<p class="popup_title">OTP</p>
		<form class="otp_popup_form">
			<div class="form_group">
				<input class="input" type="text" placeholder="OTP" name="otp">				
			</div>
			<button class="popup_btn">SUBMIT</button>
		</form>
	</div>
</div>

<script type="text/javascript">
    $('.otp_popup_form').submit((e)=>{
        e.preventDefault();
        $.ajax({
            url : `${proxy_url}/check-otp`,
            method : 'POST',
            data : $('.otp_popup_form').serialize(),
            success : function(res){
                if(res!==undefined && res!==""){
                    try{
                        const result = JSON.parse(res);
                        $('.otp_popup_form').trigger('reset');
                        close_model();
                        open_model('set_new_password');
                        // Swal.fire({
                        //     title : 'OTP MATCHED',
                        //     text : result.message,
                        //     icon : 'success'
                        // }).then((res)=>{
                        //     if(res.isConfirmed){
                        //     }
                        // });
                    }
                    catch(e){
                        console.log('Invalid JSON Response!!!');
                        Swal.fire({
                            title : 'SERVER ERROR',
                            text : 'Invalid JSON Response!!!',
                            icon : 'error'
                        });
                    }
                }
            },
            error : function(obj){
                if(obj!==undefined){
                    const {responseText, status} = obj;
                    const error = JSON.parse(responseText);
                    if(status==401){
                        Swal.fire({
                            text : error.message,
                            icon : 'error',
                        });
                    }
                }
            }
        })
    });
</script>