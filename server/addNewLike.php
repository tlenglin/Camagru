<?php
	require_once(__DIR__ . '/../config/database.php');

	session_start();

	$img_id = file_get_contents('php://input');

	//How many likes on the picture
	global $db;
	$stmt = $db->prepare('SELECT likes FROM img WHERE id = ?');
	$stmt->bindParam(1, $img_id);
	$stmt->execute();
	$image = $stmt->fetch(PDO::FETCH_ASSOC);
	$likes = $image['likes'];

	//check if user already like
	if (isset($_SESSION['likes']) && isset($_SESSION['likes'][$img_id]) && $_SESSION['likes'][$img_id]) {
		$_SESSION['likes'] = [$img_id => false];
		$likes--;
	} else {
		$_SESSION['likes'] = [$img_id => true];
		$likes++;
	}

	$stmt = $db->prepare('UPDATE img SET likes = ? WHERE id = ?');
	$stmt->bindParam(1, $likes);
	$stmt->bindParam(2, $img_id);
	$stmt->execute();

	echo $likes;
 ?>
