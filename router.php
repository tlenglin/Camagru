<html>
	<?php
	require_once(__DIR__ . '/client/includes/header.php');
	require_once(__DIR__ . '/lib/router.php');
	?>
	<body>
		<?php
		require_once(__DIR__ . '/client/includes/sign_off.php');
		require_once(__DIR__ . '/client/includes/browser.php');

		require_once(__DIR__ . '/server/render.php');

		getURI('/', RenderHome);
		getURI('/index.php', RenderHome);
		getURI('/gallery.php', RenderGallery);
		getURI('/montage.php', RenderMontage);
		getURI('/user.php', RenderUser);

		require_once(__DIR__ . '/client/includes/footer.php');
		?>
	</body>
</html>
