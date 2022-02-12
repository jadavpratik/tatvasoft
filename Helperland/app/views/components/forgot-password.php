<!-- FORGOT_PASSWORD -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- FORGOT_PASSOWORD -->
    <div class="popup_main d_none" id="forgot_password_popup">
        <p class="popup_title">Forgot Password</p>
        <form class="forgot_password_popup_form" action="">
            <div class="form_group">
                <input class="input" type="text" placeholder="Email" name="forgot_password_email">
                <div class="validation_message d_none">
                    <p>Validation Message!!!</p>
                </div>
            </div>
            <button class="popup_btn">Send</button>
            <a href="#" onclick="open_model('login')">Login Now</a>
        </form>
    </div>
</div>


<script type="text/javascript">
    $('.forgot_password_popup_form').submit((e)=>{
        e.preventDefault();
        if(forgot_password_email_validation()){
            $.ajax({
                url : `${proxy_url}/forgot-password`,
                method : 'POST',
                data : $('.forgot_password_popup_form').serialize(),
                success : function(res){
                    if(res!==undefined && res!==""){
                        try{
                            const result = JSON.parse(res);
                            Swal.fire({
                                title : `OTP = ${result.otp}`,
                                text : result.message,
                                icon : 'info'
                            }).then((res)=>{
                                if(res.isConfirmed){
                                    $('.forgot_password_popup_form').trigger('reset');
                                    close_model();
                                    open_model('otp');
                                }
                            });
                        }   
                        catch(e){
                            console.log('Invalid JSON Response!!!');
                            Swal.fire({
                                title : 'Server Error',
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
                                title : error.message,
                                icon : 'error',
                            });
                        }
                    }
                }
            });
        }
    });
</script>