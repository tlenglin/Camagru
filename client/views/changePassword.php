<?php
	require_once(__DIR__ . '/../../lib/routes.php');

	$requestData = getRequestData(getRequestURI(getRootURI()));
	$login = $requestData[1];
	$passHash = $requestData[2];
?>

<div class='success forgot'>
	<div class='default'>
		<h3>Hi <?php echo $login; ?> here you can change your password</h3>
		<form class='change-password' method='POST' action='../../server/changePassword.php'>
			<input type='password' name='password' value='' placeholder='Type your new password' required/>
			<input type='password' name='password-check' value='' placeholder='Verify your password' required/>
			<input class='hidden' type='text' name='login' value='<?php echo $login; ?>' />
			<input class='hidden' type='text' name='old-password' value='<?php echo $passHash; ?>' />
			<button id='submit-pass' type='submit' name='button' value='ok'>Submit</button>
		</form>
	</div>
</div>
