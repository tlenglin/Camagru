<?php
	require_once(__DIR__ . '/../config/database.php');
	require_once(__DIR__ . '/../lib/formCheck.php');
	require_once(__DIR__ . '/../lib/function.php');
	require_once(__DIR__ . '/../lib/redirect.php');

	session_start();

	if (isset($_POST['login']) && isset($_POST['password'])) {
		if (isUserExist($_POST['login']) && mailRegistredDone($_POST['login'])) {
			if (passwdCheck($_POST['password'], $_POST['login'])) {
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['email'] = retrieveEmail($_POST['login']);
				$_SESSION['is_connected'] = true;
				redirect('/app', 0);
				die();
			}
		}
	}
	redirect('/', 0);
?>
