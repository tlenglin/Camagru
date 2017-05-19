<?php
	require_once(__DIR__ . '/../config/database.php');

	$index = intval(file_get_contents('php://input'));
	//echo $index;
	$stmt = $db->prepare('SELECT count(*) as nb FROM img');
	$stmt->execute();
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($index <= $res['nb']) {
		$stmt = $db->prepare("SELECT id, filter, base_64, likes, comments_nb FROM img ORDER BY dates desc LIMIT 1 OFFSET $index");
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$result['nb'] = $res['nb'];
		echo json_encode($result);
	}
 ?>
