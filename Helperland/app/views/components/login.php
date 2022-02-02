<!-- LOGIN -->
<div class="model d_none">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- LOGIN -->
    <div class="popup_main d_none" id="login_popup">
        <p class="popup_title">Login</p>
        <form class="login_popup_form" action="">
            <div class="input_icon">
                <input class="input" type="text" placeholder="Email">
                <label for=""><i class="fas fa-user"></i></label>
            </div>
            <div class="input_icon">
                <input class="input" type="password" placeholder="Password">
                <label for=""><i class="fas fa-lock"></i></label>
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
            <p>Don't Have an Account? <a href="/customer/Registration.html">Create an Account</a></p>
        </div><!-- END_LOGIN_POPUP_FOOTER -->
    </div><!-- END_LOGIN_POPUP -->
</div><!-- END_MODEL -->
