<?php
	require_once(__DIR__ . '/../config/database.php');

	$img_id = file_get_contents('php://input');

	global $db;
	$stmt = $db->prepare('DELETE FROM img WHERE id = ?');
	$stmt->bindParam(1, $img_id);
	$stmt->execute();
?>
