<!-- LOGIN -->
<div class="model">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- LOGIN -->
    <div class="popup_main d_none" id="login_popup">
        <p class="popup_title">Login</p>
        <form class="login_popup_form">
            <div class="form_group">
                <div class="input_icon">
                    <input class="input" type="text" placeholder="Email" name="login_email">
                    <label for=""><i class="fas fa-user"></i></label>
                </div>
                <div class="validation_message d_none">
                    <p>Validation Message!!!</p>
                </div>
            </div>
            <div class="form_group">
                <div class="input_icon">
                    <input class="input" type="password" placeholder="Password" name="login_password">
                    <label for=""><i class="fas fa-lock"></i></label>
                </div>
                <div class="validation_message d_none">
                    <p>Validation Message!!!</p>
                </div>
            </div>
            <div>
                <input type="checkbox">
                <label class="label" for="">Remember Me</label>
            </div>
            <div>
                <button class="popup_btn">Login</button>
            </div>
        </form>
        <div class="login_popup_footer">
            <a href="#" onclick="open_model('forgot_password')">Forgot Password?</a>
            <p>Don't Have an Account? <a href="<?= url('/customer/signup') ?>">Create an Account</a></p>
        </div><!-- END_LOGIN_POPUP_FOOTER -->
    </div><!-- END_LOGIN_POPUP -->
</div><!-- END_MODEL -->

<script>

    $('.login_popup_form').submit((e)=>{
        e.preventDefault();
        let validation = true;
        const validationArr = [login_password_validation(),
                            login_email_validation()];

        for(let i=0; i<validationArr.length; i++){
            if(validationArr[i]==false){
                validation = false;
                break;
            }	
        }

        if(validation){
            $.ajax({
                url : `${proxy_url}/login`,
                method : 'POST',
                data : $('.login_popup_form').serialize(),
                success : function(res){
                    if(res!==undefined && res!==""){
                        try{
                            const result = JSON.parse(res);
                            Swal.fire({
                                title : `${result.role}`,
                                text : result.message,
                                icon : 'success'
                            }).then((res)=>{
                                if(res.isConfirmed){
                                    $('.login_popup_form').trigger('reset');
                                }
                            });
                        }
                        catch(e){
                            console.log('Invalid Json Response');
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
                                icon : 'error'
                            });
                        }
                    }
                }
            });
        }
    });
</script>