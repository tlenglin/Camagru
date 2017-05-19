<?php
	require_once(__DIR__ . '/../config/database.php');
	require_once(__DIR__ . '/../lib/redirect.php');
	require_once(__DIR__ . '/../lib/formCheck.php');
	require_once(__DIR__ . '/../lib/renderTemplate.php');

	global $db;
	if (isset($_POST['password']) && isset($_POST['password-check']) && isset($_POST['login']) && isset($_POST['old-password'])) {
		if (isUserExist($_POST['login']) && checkPasswdMatches($_POST['password'], $_POST['password-check'])) {
			$stmt = $db->prepare('SELECT password FROM users WHERE login = ?');
			$stmt->bindParam(1, $_POST['login']);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			if (explode('/', $result['password'])[0] === explode('/', $_POST['old-password'])[0]) {
				$stmt = $db->prepare('UPDATE users SET password = ? WHERE login = ?');
				$stmt->bindParam(1, password_hash($_POST['password'],PASSWORD_DEFAULT));
				$stmt->bindParam(2, $_POST['login']);
				$stmt->execute();
				redirect('/', 0);
			} else {
				renderTemplate(__DIR__ . '/../client/includes/error.php');
			}
		} else {
			renderTemplate(__DIR__ . '/../client/includes/error.php');
		}
	} else {
		renderTemplate(__DIR__ . '/../client/includes/error.php');
	}
?>
