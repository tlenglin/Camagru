<?php
	require_once(__DIR__ . '/../config/database.php');

	function imageMerge($img, $logo, $x, $y, $width_img, $height_img) {
		$cut = imagecreatetruecolor($width_img, $height_img);
		imagecopy($cut, $img, 0, 0, $x, $y, $width_img, $height_img);
		imagecopy($cut, $logo, 0, 0, 0, 0, 200, 200);
		imagecopymerge($img, $cut, $x, $y, 0, 0, $width_img, $height_img, 100);
	}

	function filter($id) {
		global $db;

		$stmt = $db->prepare('SELECT filter FROM img WHERE id = ?');
		$stmt->bindParam(1, $id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['filter'];
	}
 ?>
