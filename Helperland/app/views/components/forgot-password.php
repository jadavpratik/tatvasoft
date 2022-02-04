<!-- FORGOT_PASSWORD -->
<div class="model d_none">
    <!-- MODEL_CLOSE -->
    <button class="model_close_btn">&times;</button>
    <!-- FORGOT_PASSOWORD -->
    <div class="popup_main d_none" id="forgot_password_popup">
        <p class="popup_title">Forgot Password</p>
        <form class="forgot_password_popup_form" action="">
            <div class="form_group">
                <input class="input" type="text" placeholder="Email" name="email">
                <div class="validation_message d_none">
                    <p>Error</p>
                </div>
            </div>
            <button class="popup_btn">Send</button>
            <a href="#" onclick="open_model('login')">Login Now</a>
        </form>
    </div>
</div>
