<?php
	require_once(__DIR__ . '/../lib/redirect.php');

	session_start();

	if (isset($_SESSION['login'])) {
		foreach ($_SESSION as $k => $v) {
			unset($_SESSION[$k]);
		}
		session_destroy();
	}
	redirect('/', 0);
 ?>
