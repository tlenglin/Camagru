<?php
	//Get route path before client request uri === '/camagru/'
	function getRootURI() {
		return (implode('/', array_splice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/');
	}

	//Deduce client request uri by removing root path string from full server request uri === index.php
	function getRequestURI($rootURI) {
		return (substr($_SERVER['REQUEST_URI'], strlen($rootURI)));
	}

	//return an array from client request uri
	function getRequestData($requestURI) {
		return (explode('/', $requestURI));
	}


	function getURI($path, callable $callback) {
		$requestURI = getRequestURI(getRootURI());

		if ($path === '/' . $requestURI) {
			$callback();
		}
	}
 ?>
