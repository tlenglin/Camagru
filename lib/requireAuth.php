<?php
	require_once(__DIR__ . '/redirect.php');

	function requireAuth() {
		session_start();
		if (!$_SESSION['is_connected']) {
			redirect('/registred', 0);
			exit();
		}
	}
?>
