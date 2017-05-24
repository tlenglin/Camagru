<?php

	$DB_DSN = 'mysql:host=sql11.freemysqlhosting.net;dbname=sql11176229;charset=utf8';
	$DB_USER = 'sql11176229';
	$DB_PASSWORD = 'H9mxs3pvDR';

	try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo 'Error connecting to the Database: ' . $e->getMessage();
		exit;
	}
 ?>
