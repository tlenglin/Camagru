<?php
	require_once(__DIR__ . '/../../lib/routes.php');
 ?>

<!DOCTYPE html>
<html>
	<?php
		require_once(__DIR__ . '/head.php');
	?>
	<body>
		<div class='registred success'>
			<h2>You need to be registred.</h2>
			<p>
				<a href="<?php echo getRootURI(); ?>">Go back to home page</a>
			</p>
		</div>
		<?php
			//footer
			require_once(__DIR__ . '/footer.php');
		 ?>
	</body>
</html>
