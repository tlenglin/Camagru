<?php
	require_once(__DIR__ . '/../../lib/routes.php');

	session_start();
 ?>

<nav>
	<ul class='inline-block'>
		<?php
		if ($_SESSION['is_connected'] == 0)
		{?>
			<li id='home' class='menu text-right <?php echo ($page === 'home') ? 'active' : '';?>'><a href="<?php echo getRootURI(); ?>home">Home</a></li>
		<?php
		}?>
		<li id='gallery' class='menu text-right <?php echo ($page === 'gallery') ? 'active' : '';?>'><a href="<?php echo getRootURI(); ?>gallery">Gallery</a></li>
		<?php
		if ($_SESSION['is_connected'] == 1)
		{?>
		<li id='shoot' class='menu text-right <?php echo ($page === 'app') ? 'active' : '';?>'><a href="<?php echo getRootURI(); ?>app">Take Picture</a></li>
		<li id='user' class='menu text-right <?php echo ($page === 'user') ? 'active' : '';?>'><a href="<?php echo getRootURI(); ?>user"><?php echo $_SESSION['login']; ?></a></li>
		<li id='logout' class='menu text-right'><button id='btn-logout'><a id='logout' href="<?php echo getRootURI(); ?>server/logout.php">Logout</a></button></li>
		<?php
		}?>
	</ul>
</nav>
