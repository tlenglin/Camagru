<?php
	require_once(__DIR__ . '/../config/database.php');

	function retrieveEmail($login) {
		global $db;

		$stmt = $db->prepare('SELECT email FROM users WHERE login = ?');
		$stmt->bindParam(1, $login);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		$email = $user['email'];
		return $email;
	}

	function retrieveID($login) {
		global $db;

		$stmt = $db->prepare('SELECT id FROM users WHERE login = ?');
		$stmt->bindParam(1, $login);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = $user['id'];
		return $id;
	}

	function retrieveLoginAndMail($id) {
		global $db;

		$stmt = $db->prepare('SELECT login, email FROM users WHERE id = ?');
		$stmt->bindParam(1, $id);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		return $user;
	}
 ?>
