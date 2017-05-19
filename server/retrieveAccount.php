<?php
	require_once(__DIR__ . '/../config/database.php');
	require_once(__DIR__ . '/../lib/renderTemplate.php');
	require_once(__DIR__ . '/../lib/sendMail.php');
	require_once(__DIR__ . '/../lib/formCheck.php');
	require_once(__DIR__ . '/../lib/redirect.php');

	if (isset($_POST['email'])) {
		global $db;

		if (checkMail($_POST['email']) || !preg_match("/^[\w.-]+@[\w.-]+$/", $_POST['email'])) {
			renderTemplate(__DIR__ . '/../client/includes/error.php');
		} else {
			$stmt = $db->prepare('SELECT login, email FROM users WHERE email = ?');
			$stmt->bindParam(1, $_POST['email']);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			sendRecoverMail($result['login'], $result['email']);
			redirect('/', 0);
		}
	}
 ?>
