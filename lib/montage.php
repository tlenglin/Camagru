<?php

function imgMerge($img, $logo, $x, $y, $w_img, $h_img)
{
	$new = imagecreatetruecolor($w_img, $h_img);
	imagecopy($new, $img, 0, 0, $x, $y, $w_img, $h_img);
	imagecopy($new, $logo, 0, 0, 0, 0, 200, 200);
	imagecopymerge($img, $new, $x, $y, 0, 0, $w_img, $h_img, 100);
}

?>
