<?php
	session_start();
	require_once(__DIR__ . '/../includes/nav.php');
?>

<div class='success'>
	<h2>SUCCESS !</h2>
	<h3>Congratulations <?php echo $_SESSION['login']; ?>.</h3>
	<p>Your registration is complete !</p>
	<p>Take a look at your mail <em><?php echo $_SESSION['email']; ?></em> to validate your account.</p>
</div>
