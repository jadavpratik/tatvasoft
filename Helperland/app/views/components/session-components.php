<?php if(session('openLoginForm')){ ?>
	<!-- **********OPEN_LOGIN_FORM********** -->
	<script> open_model('login'); </script>
	<?php unset($_SESSION['openLoginForm']); ?>
<?php } ?>

<?php if(session('openForgotPasswordForm')){ ?>
	<!-- **********OPEN_FORGOT_PASSWORD********** -->
	<script> open_model('forgot_password'); </script>
	<?php unset($_SESSION['openForgotPasswordForm']); ?>
<?php } ?>

<?php if(session('logout')){ ?>
	<!-- **********LOGOUT********** -->
	<script> Swal.fire({ title : `Logout Successfully`, icon : 'success' }); </script>
	<?php unset($_SESSION['logout']); ?>
<?php } ?>

