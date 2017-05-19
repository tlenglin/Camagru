<?php
	require_once(__DIR__ . '/../config/database.php');
	require_once(__DIR__ . '/../lib/imageLib.php');

	ini_set('memory_limit', '-1');

	session_start();

	$data = json_decode(file_get_contents('php://input'));
	$base64 = explode(',', $data->img)[1]; //remove the content-type data:image/jpeg;base64,
	$img = imagecreatefromstring(base64_decode($base64)); //create img

	// if logo
	if ($data->logo->name !== '') {
		$logo = imagecreatefrompng(__DIR__ . '/../public/img/' . $data->logo->name . '.png');
		imageMerge($img, $logo, intval($data->logo->x) - 7, intval($data->logo->y) - 105, $data->size->width, $data->size->height);
		imagedestroy($logo);
	}

	//if $data->filter is normal or NULL
	$data->filter = (isset($data->filter)) ? $data->filter : '';

	ob_start();
	imagejpeg($img); //display image to browser
	$imageData = ob_get_contents();
	ob_end_clean();
	$base64 = 'data:image/jpeg;base64,' . base64_encode($imageData);
	echo $base64;
	imagedestroy($img); //free memory

	$stmt = $db->prepare('SELECT id FROM users WHERE login = ?');
	$stmt->bindParam(1, $_SESSION['login']);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$id = $result['id'];
	$stmt = $db->prepare('INSERT INTO img (base_64, user_id, filter) VALUES (:base64, :user_id, :filter)');
	$stmt->bindParam(':base64', $base64);
	$stmt->bindParam(':user_id', intval($id));
	$stmt->bindParam(':filter', $data->filter);
	$stmt->execute();
 ?>
