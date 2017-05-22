<?php
	require_once(__DIR__ . '/../../lib/requireAuth.php');
	requireAuth();

	//retrieve id in the URL
	require_once(__DIR__ . '/../../lib/routes.php');
	$requestData = getRequestData(getRequestURI(getRootURI()));
	$id = $requestData[1];

	require_once(__DIR__ . '/../../config/database.php');

	require_once(__DIR__ . '/../../lib/function.php');

	session_start();

	//retrieve img from the active user
	global $db;
	//all info about img
	$stmt = $db->prepare('SELECT * FROM img WHERE id = ?');
	$stmt->bindParam(1, $id);
	$stmt->execute();
	$img = $stmt->fetch(PDO::FETCH_ASSOC);
	$user_id = $img['user_id'];
	//login who take the picture
	$stmt = $db->prepare('SELECT login, id FROM users WHERE id = ?');
	$stmt->bindParam(1, $user_id);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	//comments on the picture
	$stmt = $db->prepare('SELECT * FROM comments WHERE img_id = ?');
	$stmt->bindParam(1, $id);
	$stmt->execute();
	$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//for each comments retrieve the login
	foreach ($comments as $comment) {
		$stmt = $db->prepare('SELECT login FROM users WHERE id = ?');
		$stmt->bindParam(1, $comment['user_id']);
		$stmt->execute();
		$user_comment[] = $stmt->fetch();
	}

	require_once(__DIR__ . '/../includes/nav.php');

 ?>

<div class='gallery'>
	<div class='image' id='<?php echo $img['id']?>'>
		<img class='<?php echo $img['filter']; ?>' src='<?php echo $img['base_64']; ?>' alt='img-<?php echo $img['id'];?>'/>
		<h3> &copy; <?php echo $user['login']; ?> </h3>
		<ul>
			<li class='likes-nb'>Likes : <?php echo $img['likes']; ?></li>
			<li class='likes-nb'>Comments : <?php echo $img['comments_nb']; ?></li>
		</ul>
	</div>
	<div class='comments'>
		<?php if ($comments) {
			foreach ($comments as $k => $comment) {
				//print content of each comment.
				$date = explode(' ', $comment['dates']);
				$tmp = explode('-', $date[0]);
				$tmphms = explode(':', $date[1]);
				$comments[$k]['dates'] = "$tmp[2]/$tmp[1]/$tmp[0] at $tmphms[0]:$tmphms[1]";
		 	?>
			<ul>
				<li class='author'><a href='mailto:<?php echo retrieveEmail($user_comment[$k][0]); ?>'><?php echo $user_comment[$k][0]; ?></a></li>
				<li class='date'><?php echo $comments[$k]['dates']; ?></li>
				<li class='content'><?php echo $comment['content']; ?></li>
			</ul>
	<?php	}
		}?>
		<form method='POST' action='../server/addNewComment.php'>
			<textarea rows='4' name='content' value='' placeholder='Your comment...' required></textarea>
			<input class='hidden' name='img_id' value='<?php echo $id ?>'/>
			<input class='hidden' name='user_id' value='<?php echo retrieveID($_SESSION['login']); ?>'/>
			<input class='hidden' name='user_email' value='<?php echo retrieveEmail($_SESSION['login']); ?>'/>
			<button type='submit' name='ok' id='submit-com'>Submit</button>
		</form>
	</div>
</div>
