<?php
	session_start();
	require_once(__DIR__ . '/../../lib/requireAuth.php');
	requireAuth();

	$page = 'app';

	require_once(__DIR__ . '/../../config/database.php');
	require_once(__DIR__ . '/../../lib/imageLib.php');
	require_once(__DIR__ . '/../../lib/function.php');

	//retrieve 4 last pics
	$id_login = retrieveID($_SESSION['login']);
	global $db;
	$stmt = $db->prepare('SELECT id, base_64 FROM img WHERE user_id = ? ORDER BY dates desc LIMIT 4');
	$stmt->bindParam(1, $id_login);
	$stmt->execute();
	$results = $stmt->fetchall(PDO::FETCH_ASSOC);

	require_once(__DIR__ . '/../includes/nav.php');

 ?>

<div class='main app'>
	<div class='top-app'>
		<div id='top-left-app' class='webcam'>
			<!-- if camera available -->
			<video id='camera' width="100%" autoplay></video>
			<!-- else -->
			<img class='hidden' id='top-left-img' src='' alt='top-left-img' />
		</div>
		<div id='top-right-app' class='preview'>
			<!-- hidden -->
			<canvas class='hidden' id='canvas' width='' height=''></canvas>
			<!-- div for image -->
			<div id='logo' style='position:absolute;width:200px;height:200px;z-index:100;top:65px;left:7px;background:url("");background-size:cover;'>
			</div>
		</div>
	</div>
	<div class='bottom-app'>
		<div id='bottom-left-app' class='tabs'>
			<ul id='tab-header' style='list-style-type:none'>
				<li id='tab-obj'>
					<h3 style='font-size:30px'>Object</h3>
					<div id='objects'>
						<ul class='objects'>
							<li><img class='object action Troll' src='./public/img/troll.png' style='width:100px;height:100px;'/></li>
							<li><img class='object action nyancat' src='./public/img/nyancat.png' style='width:100px;height:100px;'/></li>
							<li><img class='object action My-Little-Pony' src='./public/img/My-Little-Pony.png' style='width:100px;height:100px;'/></li>
							<li><img class='object action Thug-life' src='./public/img/Thug-life.png' style='width:100px;height:100px;'/></li>
							<button type='button' class='btn disabled' id='snap' disabled>Take snapshot</button>
						</ul>
					</div>
				</li>
				<li id='tab-filters'>
					<div class="container">
						<h3 style='font-size:30px'>Current filter is: None</h3>
						<button id='filter_button'>Click here to change video filter</button>
					</div>
				</li>
				<li id='tab-upload' class='hidden'>Image Upload
					<div id='no-camera' class='hidden'>
						<input type='file' name='fileToUpload' id='fileToUpload' />
					</div>
				</li>
			</ul>
			<img class='hidden return-img' id='return-img' src='' alt='return-img' />
		</div>
		<div id='bottom-right-app' class='last-taken' style='list-style-type:none'>
			<?php
				if (isset($results)) {
					?> <ul class='last-taken'>
						<li><h3 style='font-size:30px'>Last 4 photos taken: </h3><?php
						foreach ($results as $img) { ?>
							<div class='gallery-single-small' id='<?php echo $img['id']; ?>'>
								<a href='single/<?php echo $img['id']; ?>'>
									<img class='<?php echo filter($img['id']); ?>'  style='width:100%;height:auto' src='<?php echo $img['base_64']; ?>' alt='img-<?php echo $img['id']; ?>'/>
								</a>
							</div>
				<?php }
				} ?>
					</li>
				</ul>
		</div>
	</div>
</div>
<script type='text/javascript' src='./public/js/action.js'></script>
<script type='text/javascript' src='./public/js/app.js'></script>
