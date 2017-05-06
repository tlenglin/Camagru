<?php

function getRootURI()
{
	return (implode('/', array_splice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/');
}

function getRequestURI($rootURI)
{
	return (substr($_SERVER['REQUEST_URI'], strlen($rootURI)));
}

function getURI($path, callable $callback)
{
	$requestURI = getRequestURI(getRootURI());
	if ($path === '/' . $requestURI)
		$callback();
}

?>
