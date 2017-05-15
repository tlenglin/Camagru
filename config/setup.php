<?php
	require_once(__DIR__ . '/database.php');

	$user = $db->query('CREATE TABLE IF NOT EXISTS users
		(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(255) NOT NULL,
		pwd VARCHAR(256),
		mail VARCHAR(255) NOT NULL,
		is_admin BOOLEAN NOT NULL DEFAULT 0)'
	);

	$img = $db->query('CREATE TABLE IF NOT EXISTS img
		(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		base_64 MEDIUMTEXT CHARACTER SET ascii NOT NULL,
		user_id INT UNSIGNED NOT NULL,
		filter VARCHAR(128) NOT NULL,
		likes INT NOT NULL DEFAULT 0,
		dates TIMESTAMP NOT NULL DEFAULT now(),
		comments_nb INT NOT NULL DEFAULT 0)'
	);

 ?>
