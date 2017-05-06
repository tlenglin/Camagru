<?php
	require_once(__DIR__ . '/database.php');

	$user = $db->query('CREATE TABLE IF NOT EXISTS users
		(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(255) NOT NULL,
		pwd VARCHAR(256),
		mail VARCHAR(255) NOT NULL,
		is_admin BOOLEAN NOT NULL DEFAULT 0)'
	);
 ?>
