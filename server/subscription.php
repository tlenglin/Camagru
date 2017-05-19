<?php
	require_once(__DIR__ . '/../config/database.php');
	require_once(__DIR__ . '/../lib/formCheck.php');
	require_once(__DIR__ . '/../lib/sendMail.php');
	require_once(__DIR__ . '/../lib/redirect.php');

	session_start();

	$_SESSION['errors'] = 0;

	if (!isset($_POST['login']) || !checkLogin($_POST['login'])) {
		$_SESSION['errors']++;
	} else {
		$_SESSION['login'] = $_POST['login'];
	}

	if (!isset($_POST['password']) || !isset($_POST['password-check']) || !checkPasswdMatches($_POST['password'], $_POST['password-check'])) {
		$_SESSION['errors']++;
	} else {
		$_SESSION['password'] = $_POST['password'];
	}

	if (!isset($_POST['email']) || !checkMail($_POST['email'])) {
		$_SESSION['errors']++;
	} else {
		$_SESSION['email'] = $_POST['email'];
	}

	if ($_SESSION['errors'] === 0 && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password-check']) && isset($_POST['email'])) {
		unset($_SESSION['errors']);
		$stmt = $db->prepare('INSERT INTO users (login, password, email, registred, is_admin) VALUES (:login, :password, :email, 0, 0)');
		$stmt->bindParam(':login', $_POST['login']);
		$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
		$stmt->bindParam(':email', $_POST['email']);
		$stmt->execute();
		sendSubscriptionMail($_POST['login'], $_POST['email']);
		redirect('/success', 0);
	} else {
		redirect('/', 0);
	}
 ?>
