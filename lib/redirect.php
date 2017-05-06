<?php

function redirect($url, $delay)
{
	echo '<META HTTP-EQUIV="Refresh" Content="' . $delay . '; URL=' . $url . '" />';
}

?>
