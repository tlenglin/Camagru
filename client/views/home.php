<?php
require_once(__DIR__ . '/../includes/nav.php');
?>

<div class='home'>
	<div class='right home-right'>
		<div class='form'>
			<!-- Subsription form -->
			<form id='subscription' method='post' action='./server/subscription.php'>
				<h4 class='text_form' >Sign up</h4>
				<input id='signup-email' type='email' name='email' value='' placeholder='Email' autocomplete='off' required/>
				<input id='signup-login' type='text' name='login' value='' placeholder='Login (3 - 32)' autocomplete='off' required/>
				<input id='signup-passwd' type='password' name='password' value='' placeholder='Password (4 - 50)' autocomplete='off' required/>
				<input id='signup-check-password' type='password' name='password-check' value='' placeholder='Type your password again' autocomplete='off' required/>
				<button id='signup-button' type='submit' name='subscribe'>Sign up</button>
			</form>

			<!-- Connection form -->
			<form id='connection' method='post' action='./server/login.php'>
				<h4 class='text_form'>Sign-in</h4>
				<input id='login-login' type='text' name='login' value='' placeholder='Login' autocomplete='off' required/>
				<input id='login-passwd' type='password' name='password' value='' placeholder='Password' autocomplete='off' required/>
				<span ><a id='forgot' href='forgot'>Forgot your account?</a></span>
				<button id='login-button' type='submit' name='connect'>Log in</button>
			</form>

		</div>
	</div>
</div>
<script type='text/javascript' src='./public/js/home.js'></script>
