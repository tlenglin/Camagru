<?php
	require_once(__DIR__ . '/../lib/sign_up.php');
	require_once(__DIR__ . '/../lib/redirect.php');

	session_start();

	$error = 0;

	if (check_username_exist($_POST['username']) == 1 && checkpwd($_POST['pwd'], $_POST['username']))
	{
		$_SESSION['username'] = $_POST['username'];
		redirect('../montage.php', 0);
	}
	else
	{
		#var_dump($_POST['username']);
		#var_dump($_POST['pwd']);
		redirect('../index.php', 0);
	}


?>
