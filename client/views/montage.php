<?php
session_start();
require_once(__DIR__ . '/../../config/database.php');

global $db;

$stmt = $db->prepare("SELECT base_64 FROM img ORDER BY dates DESC LIMIT 4");
$stmt->bindParam(1, $_SESSION['username']);
$stmt->execute();
$results = $stmt->fetchall(PDO::FETCH_ASSOC);

?>

<div class='main app'>
	<div class='top-app'>
		<div id='top-left-app' class='webcam'>
			<!-- if camera available -->
			<video id='camera' width="45%" autoplay></video>
			<!-- else -->
			<img class='hidden' id='top-left-img' src='' alt='top-left-img' />
		</div>
		<div class="container">
		<h3>Current filter is: None</h3>
		<button id='filter_button'>Click here to change video filter</button>
		<div id='objects'>
						<ul class='objects'>
							<li><img class='object action 42' src='./public/img/42.png' /></li>
							<button type='button' class='btn disabled' id='snap' disabled>Take snapshot</button>
						</ul>
</div>
		<div style="clear:both"></div>
		</div>
		<button type='button' class='btn disabled' id='snap'>Take snapshot</button>
		<div id='top-right-app' class='preview'>
			<!-- hidden -->
			<canvas class='hidden' id='canvas' width='' height=''></canvas>
			<!-- else if uploaded image -->
			<img class='hidden' id='return-img' src='' alt='return-img' />
		</div>
	</div>
	<li id='tab-upload' class='hidden'>Image Upload</li>
	<div id='no-camera' class='hidden'>
		<input type='file' name='fileToUpload' id='fileToUpload' />
	</div>
	<ul>
		<?php
		foreach ($results as $result)
		{ ?>
			<div>
				<img src='<?php echo $result['base_64']; ?>' width='20%'>
			</div>
		<?php
		} ?>
	</ul>
</div>

<script type='text/javascript' src='./public/js/montage.js'></script>
