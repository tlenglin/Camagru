<?php
	require_once(__DIR__ . '/routes.php');

	function redirect($url, $delay) {
		$requestData = array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1); // getting the name of the root
		echo '<META HTTP-EQUIV="Refresh" Content="' . $delay . '; URL=/' . $requestData[1] . $url . '" />';
	}
 ?>
