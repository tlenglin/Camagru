<?php
	require_once(__DIR__ . '/../config/database.php');
	session_start();
	$data = json_decode(file_get_contents('php://input'));
	//echo var_dump($data);
	$base64 = explode(',', $data->img)[1]; //remove the content-type data:image/jpeg;base64,
	$img = imagecreatefromstring(base64_decode($base64)); //create img
	ob_start();
	imagejpeg($img); //display image to browser
	$imageData = ob_get_contents();
	ob_end_clean();
	$base64 = 'data:image/jpeg;base64,' . base64_encode($imageData);
	echo $base64;
	imagedestroy($img); //free memory
	$stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
	$stmt->bindParam(1, $_SESSION['username']);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$id = $result['id'];
	$stmt = $db->prepare('INSERT INTO img (base_64, user_id) VALUES (:base64, :user_id)');
	$stmt->bindParam(':base64', $base64);
	$stmt->bindParam(':user_id', intval($id));
	$stmt->execute();
 ?>
