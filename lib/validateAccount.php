<?php
	require_once(__DIR__ . '/../config/database.php');
	require_once(__DIR__ . '/redirect.php');
	require_once(__DIR__ . '/renderTemplate.php');

	function validateAccount($login, $passHash) {
		global $db;

		$stmt = $db->prepare('SELECT password FROM users WHERE login = ?');
		$stmt->bindParam(1, $login);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		//check if the passwordhash match (care to '/' in the url)
		if (explode('/', $result['password'])[0] === explode('/', $passHash)[0]) {
			return true;
		} else {
			return false;
		}
	}

	function addRegistredUser($login, $passHash) {
		global $db;

		if (validateAccount($login, $passHash)) {
			$stmt = $db->prepare('UPDATE users SET registred = 1 WHERE login = ?');
			$stmt->bindParam(1, $login);
			$stmt->execute();
			redirect('/', 0);
		} else {
			renderTemplate(__DIR__ . '/../client/includes/error.php');
		}
	}

	function changePassword($login, $passHash) {
		if (validateAccount($login, $passHash)) {
			renderTemplate(__DIR__ . '/../client/views/changePassword.php');
		} else {
			renderTemplate(__DIR__ . '/../client/includes/error.php');
		}
	}
 ?>
