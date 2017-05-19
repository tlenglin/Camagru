<?php
	require_once(__DIR__ . '/../config/database.php');
	require_once(__DIR__ . '/../lib/redirect.php');
	require_once(__DIR__ . '/../lib/function.php');
	require_once(__DIR__ . '/../lib/sendMail.php');

	$content = htmlentities($_POST['content']); //convert special caracters for html inclusion
	$img_id = $_POST['img_id'];
	$user_id = $_POST['user_id'];
	$user_email = $_POST['user_email'];

	global $db;
	//insert comment
	$stmt = $db->prepare('INSERT INTO comments (img_id, user_id, user_email, dates, content) VALUES (:img_id, :user_id, :user_email, :dates, :content)');
	$stmt->bindParam(':img_id', $img_id);
	$stmt->bindParam(':user_id', $user_id);
	$stmt->bindParam(':user_email', $user_email);
	$stmt->bindParam(':dates', $dates);
	$stmt->bindParam(':content', $content);
	$stmt->execute();

	//increment comment_nb
	$stmt = $db->prepare('SELECT comments_nb FROM img WHERE id = ?');
	$stmt->bindParam(1, $img_id);
	$stmt->execute();
	$comment = $stmt->fetch(PDO::FETCH_ASSOC);
	$comment['comments_nb']++;
	$stmt = $db->prepare('UPDATE img SET comments_nb = ? WHERE id = ?');
	$stmt->bindParam(1, $comment['comments_nb']);
	$stmt->bindParam(2, $img_id);
	$stmt->execute();

	//inform user
	$stmt = $db->prepare('SELECT user_id FROM img WHERE id = ?');
	$stmt->bindParam(1, $img_id);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	// if the user is different from poster
	if ($result['user_id'] != $user_id) {
		$login = retrieveLoginAndMail($result['user_id'])['login'];
		$email = retrieveLoginAndMail($result['user_id'])['email'];
		sendInformativeMail($login, $email);
	}
	redirect('/single/' . $img_id, 0);
?>
