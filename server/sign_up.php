<?php
	require_once(__DIR__ . '/../lib/sign_up.php');
	require_once(__DIR__ . '/../lib/redirect.php');

	session_start();

	$error = 0;

	if (check_valid_username($_POST['username']) == 0 || check_username_exist($_POST['username']) == 1)
	{
		$error += 1;
	}
	else
		$_SESSION['username'] = $_POST['username'];

	if (check_valid_mail($_POST['mail']) == 0)
	{
		$error += 2;
	}
	else
		$_SESSION['mail'] = $_POST['mail'];

	if (check_valid_pwd($_POST['pwd']) == 0 || $_POST['pwd'] != $_POST['verify_pwd'])
	{
		$error += 4;
	}
	else
		$_SESSION['pwd'] = pwd_encryption($_POST['pwd']);

	if ($error > 0)
	{
		redirect('../index.php', 0);
		#var_dump($error);
		exit ;
	}

	$stmt = $db->prepare("INSERT INTO users (username, mail, pwd) VALUES (:username, :mail, :pwd)");
	$stmt->bindParam(':username', $_SESSION['username']);
	$stmt->bindParam(':mail', $_SESSION['mail']);
	$stmt->bindParam(':pwd', $_SESSION['pwd']);
	$stmt->execute();
	send_confirmation_mail($_SESSION['mail'], $_SESSION['pwd']);
	redirect('../montage.php', 0);
?>
