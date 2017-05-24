<?php
	require_once(__DIR__ . '/../../lib/routes.php');

	$rootURI = getRootURI();
	$requestData = getRequestData(getRequestURI($rootURI));
 ?>

<div class='success error'>
	<h2>Something's wrong here.</h2>
	<p>
		<a href="<?php echo requestData[0]; ?>">Go back to home page</a>
	</p>
</div>
