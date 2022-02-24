	<!-- OPEN LOGIN FORM -->
	<?php if(session('openLoginForm')){ ?>
		<script> open_model('login'); </script>
		<?php unset($_SESSION['openLoginForm']); ?>
	<?php } ?>

	<!-- OPEN FORGOT-PASSWORD -->
	<?php if(session('openForgotPasswordForm')){ ?>
		<script> open_model('forgot_password'); </script>
		<?php unset($_SESSION['openForgotPasswordForm']); ?>
	<?php } ?>

	<!-- LOGOUT -->
	<?php if(session('logout')){ ?>
		<script> Swal.fire({ title : `Logout Successfully`, icon : 'success' }); </script>
		<?php unset($_SESSION['logout']); ?>
	<?php } ?>

